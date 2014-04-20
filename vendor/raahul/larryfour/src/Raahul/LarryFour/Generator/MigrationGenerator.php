<?php namespace Raahul\LarryFour\Generator;

class MigrationGenerator
{
    /**
     * Stores the migration template for use throughout the lifetime of this instance,
     * which saves is from reading the template again and again from a file
     * @var string
     */
    private $template;


    /**
     * Load the migration template
     */
    public function __construct()
    {
        $this->template = file_get_contents(__DIR__ . '/templates/migration');
    }


    /**
     * Generate the migration file contents from the templates and the migration
     * object provided
     * @param  \Raahul\LarryFour\Migration $migration The migration object whose migration file has to be generated
     * @return string                          The migration file contents
     */
    public function generate(\Raahul\LarryFour\Migration $migration)
    {
        // Store the template locally
        $result = $this->template;

        // Add the table name
        $result = str_replace('{{tableName}}', $migration->tableName, $result);

        // Add the class name
        $result = $this->addClassName($result, $migration->tableName);

        // Populate the fields
        // First, the primary key
        $result = $this->addFieldLine($result,
            $this->getFieldLine(array(
                'name' => $migration->primaryKey,
                'type' => 'increments',
                'parameters' => array()
            ))
        );

        // Then, move on to all the other columns, which also includes the
        // relational columns that are autogenerated
        foreach ($migration->all() as $column)
        {
            $result = $this->addFieldLine($result, $this->getFieldLine($column));
        }

        // See if timestamps is present. If yes, add it in too.
        if ($migration->timestamps)
        {
            $result = $this->addFieldLine($result,
                $this->getFieldLine(array(
                    'name' => '', // Timestamps have no field names
                    'type' => 'timestamps',
                    'parameters' => array()
                ))
            );
        }

        // See if softDeletes is present. If yes, add it in too.
        if ($migration->softDeletes)
        {
            $result = $this->addFieldLine($result,
                $this->getFieldLine(array(
                    'name' => '', // softDeletes has no field name
                    'type' => 'softDeletes',
                    'parameters' => array()
                ))
            );
        }

        // Remove the final fields tag
        $result = $this->removeTrailingFieldsTag($result);

        // Return it
        return $result;
    }


    /**
     * Generates the php command for a single field line that goes into the
     * migration
     * @param  array  $fieldData An array of field information as generated by FieldParser
     * @return string            The string representing the PHP code for the field line
     */
    private function getFieldLine($fieldData)
    {
        // Handling for timestamps and softDeletes
        // They don't have field names, so we have to intercept it first. We simply return the
        // timestamps function or the softDeletes function without parameters
        if ( in_array($fieldData['type'], array('timestamps', 'softDeletes')) )
        {
            return "\$table->{$fieldData['type']}();";
        }

        // The beginning part of the definition of a field. A field may or may not have
        // additional parameters, so we need to test for both cases
        // For this purpose, we first render the following portion of the line:
        // $table->type('name'
        $result = '$table->'
            . $fieldData['type']
            . "('" . $fieldData['name'] . "'";


        // We then check for additional parameters to the field. If found, we add in
        // a comma first, and then implode the parameter list.
        // Now, all the parameters are generally numeric and hence unquoted, the only
        // exception being the enum type.
        if ($fieldData['parameters'])
        {
            // If the field is of enum type, we implode the parameters array while
            // surrounding each parameter with a double quote.
            // Also, we surround the entire parameter list as a PHP array to produce
            // an output like
            // $table->enum('field', array("val1", "val2", ...))
            if ($fieldData['type'] == 'enum')
            {
                // Add quotes around parameters for enum and put them in an array
                $result .= ', ' // Add a leading comma
                    . 'array("' // Mark the beginning of the array
                    . implode('", "', $fieldData['parameters']) // Implode all paramters with quotes
                    . '")'; // Close the last parameter quote and then the array
            }

            // If the field is not enum, then we simply implode it as separate parameters
            // to the function itself, and not an array, and we consider the parameters
            // to be numeric
            else
            {
                $result .= ', ' . implode(', ', $fieldData['parameters']);
            }
        }

        // Closing of the field definition function
        $result .= ')';


        // Here, we detect other modifiers and append it to the field definition
        // We do this by creating an array of modifiers, then looping through them
        // to check if they are set to true
        $modifiers = array('default', 'nullable', 'unsigned', 'primary', 'fulltext',
            'unique', 'index');
        foreach ($modifiers as $modifier)
        {
            // We check if the modifier is set and has a true value, because it is not
            // compulsory for these modifiers to be set, in which case they're assumed false.
            // However, they can also be set with a boolean value of false.
            if ( isset($fieldData[$modifier]) && ($fieldData[$modifier]) )
            {
                // We use chaining to add in the modifier
                // ->default(
                $result  .= '->' . $modifier . '(';

                // Only in the case of the default modifier, the function takes a parameter,
                // which is the default value. We surround this in quotes.
                if ($modifier == 'default')
                {
                    $result .= '"' . $fieldData['default'] . '"';
                }

                // We then close the parenthesis of the modifier function
                $result .= ')';
            }
        }

        // In the end, we have to terminate the line with a semicolon
        $result .= ';';


        // And return the result
        return $result;
    }


    /**
     * Replaces the className tag with the actual class name in the migration template
     * @param  string $migrationContent The contents of the migration file with className tag present
     * @param  string $tableName        The name of the table of this migration file
     * @return string                   The migration file content with class name replaced
     */
    private function addClassName($migrationContent, $tableName)
    {
        // Class name is the name of the table uppercased and without underscores
        $className = 'Create' . ucwords($tableName) . 'Table';
        $className = str_replace('_', '', $className);

        return str_replace('{{className}}', $className, $migrationContent);
    }


    /**
     * Adds a field line to the given migration content, taking into account
     * the indentation. This function preserves the fields tag for future additions.
     * @param  string $migrationContent The content of the migration file with fields tag present
     * @param  string $fieldLine        The line that has to be appended to the list of fields
     * @return string                   The migration file content with the field added
     */
    private function addFieldLine($migrationContent, $fieldLine)
    {
        return str_replace('{{fields}}', $fieldLine . "\n            {{fields}}", $migrationContent);
    }


    /**
     * Removes the trailing fields tag after all the field have been added
     * @param  string $migrationContent The content of the migration file with fields tag present
     * @return string                   The migration file content with the fields tag removed
     */
    private function removeTrailingFieldsTag($migrationContent)
    {
        return str_replace("\n            {{fields}}", '', $migrationContent);
    }
}