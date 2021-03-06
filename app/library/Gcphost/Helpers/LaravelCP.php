<?php namespace Gcphost\Helpers;

use User, Confide,Activity,Input,Mail,Config,Event, Lava, DB;
use Illuminate\Filesystem\Filesystem;

class LaravelCP {
	static private $email;

	static public function merge($_merge_to, $user){
		DB::update('UPDATE user_profiles set user_id = ? where user_id = ?', array($_merge_to->id, $user->id));
		DB::update('UPDATE posts set user_id = ? where user_id = ?', array($_merge_to->id, $user->id));
		DB::update('UPDATE comments set user_id = ? where user_id = ?', array($_merge_to->id, $user->id));
		DB::update('UPDATE activity_log set user_id = ? where user_id = ?', array($_merge_to->id, $user->id));
		DB::table('assigned_roles')->where('user_id', '=', $user->id)->delete();

		Event::fire('controller.user.merge', array($user));

		return $user->delete();
	}



	static public function userChart(){
		$chart = Lava::DataTable('activeusers');
		$chart->addColumn('string', 'Active', 'active');
		$chart->addColumn('string', 'Inactive', 'inactive');

		$chart->addRow(array('Active',DB::table('users')->where('confirmed', '=', '1')->count()));
		$chart->addRow(array('In-active',DB::table('users')->where('confirmed', '!=', '1')->count()));

		Lava::PieChart('activeusers')->addOption(array('chartArea' => array('width'=>'98%', 'height'=>'98%')))->addOption(array('backgroundColor' => 'none'))->addOption(array('is3D' => 'true'))->addOption(array('legend' => 'none'));
	}	




	static public function runDeleteMass($r){
		if ($r != Confide::user()->id){
			$user = User::find($r);
			if(!empty($user)){
				Event::fire('controller.user.delete', array($user));
				$user->delete();
			} else return Api::to(array('error', '')) ? : Response::json(array('result'=>'error', 'error' =>  ''));
		}
	}

	static public function emailTemplates(){
		$path=Config::get('view.paths');
		$fileSystem = new Filesystem;
		$files=$fileSystem->allFiles($path[0].DIRECTORY_SEPARATOR.Theme::getTheme().DIRECTORY_SEPARATOR."emails");
		return $files;
	}

	static public function sendEmail($user, $template='emails.default'){
		//if (!View::exists($template))$template='emails.default';
		
		Event::fire('controller.user.email', array($user));

		self::$email=$user->email;

		try{
			$send=Mail::send(Theme::path(str_replace('.','/',$template)), array('body'=>Input::get('body'), 'user' => $user), function($message)
			{
				$message->to(self::$email)->subject(Input::get('subject'));

				$files=Input::file('email_attachment');
				if(count($files) > 1){
					foreach($files as $file) $message->attach($file->getRealPath(), array('as' => $file->getClientOriginalName(), 'mime' => $file->getMimeType()));
				} elseif(count($files) == 1) $message->attach($files->getRealPath(), array('as' => $files->getClientOriginalName(), 'mime' => $files->getMimeType()));

			});

			Activity::log(array(
				'contentID'   => $user->id,
				'contentType' => 'email',
				'description' => Input::get('subject'),
				'details'     => Input::get('body'),
				'updated'     => $user->id ? true : false,
			));

		} catch (Exception $e) {
			return false;
		}

		return $send;

	}

}
