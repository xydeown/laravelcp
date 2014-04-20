@extends('admin.layouts.modal')

@section('content')
	<ul class="nav nav-tabs">
		<li class="active"><a href="#tab-general" data-toggle="tab">{{{ Lang::get('core.general') }}}</a></li>
		<li><a href="#tab-meta-data" data-toggle="tab">{{{ Lang::get('admin/slugs.meta_data') }}}</a></li>
	</ul>

	@if ($message = Session::get('success'))
	<script type="text/javascript">
		if(parent.$('#blogs').html()){
			var oTable = parent.$('#blogs').dataTable();
			oTable.fnReloadAjax();
		}
	</script>
	@endif

	@if (isset($post))
		{{ Form::open(array('url' => URL::to('admin/slugs/' . $post->id . '/edit'), 'class' => 'form-horizontal')) }}
	@else
		{{ Form::open(array('class' => 'form-horizontal')) }}
	@endif

		<div class="tab-content">
			<div class="tab-pane active" id="tab-general">

				<div class="form-group {{{ $errors->has('title') ? 'error' : '' }}}">
                    <div class="col-md-12">
                        <label class="control-label" for="title">{{{ Lang::get('admin/slugs.post_title') }}}</label>
						<input class="form-control" type="text" name="title" id="title" value="{{{ Input::old('title', isset($post) ? $post->title : null) }}}" />
						{{{ $errors->first('title', '<span class="help-inline">:message</span>') }}}
					</div>
				</div>

				<div class="form-group {{{ $errors->has('content') ? 'error' : '' }}}">
					<div class="col-md-12">
                        <label class="control-label" for="content">{{{ Lang::get('core.content') }}}</label>
						<textarea class="form-control full-width wysiwyg" name="content" value="content" rows="10">{{{ Input::old('content', isset($post) ? $post->content : null) }}}</textarea>
						{{{ $errors->first('content', '<span class="help-inline">:message</span>') }}}
					</div>
				</div>

			</div>

			<div class="tab-pane" id="tab-meta-data">
				<div class="form-group {{{ $errors->has('meta-title') ? 'error' : '' }}}">
					<div class="col-md-12">
                        <label class="control-label" for="meta-title">{{{ Lang::get('admin/slugs.meta_title') }}}</label>
						<input class="form-control" type="text" name="meta-title" id="meta-title" value="{{{ Input::old('meta-title', isset($post) ? $post->meta_title : null) }}}" />
						{{{ $errors->first('meta-title', '<span class="help-inline">:message</span>') }}}
					</div>
				</div>

				<div class="form-group {{{ $errors->has('meta-description') ? 'error' : '' }}}">
					<div class="col-md-12 controls">
                        <label class="control-label" for="meta-description">{{{ Lang::get('admin/slugs.meta_description') }}}</label>
						<input class="form-control" type="text" name="meta-description" id="meta-description" value="{{{ Input::old('meta-description', isset($post) ? $post->meta_description : null) }}}" />
						{{{ $errors->first('meta-description', '<span class="help-inline">:message</span>') }}}
					</div>
				</div>

				<div class="form-group {{{ $errors->has('meta-keywords') ? 'error' : '' }}}">
					<div class="col-md-12">
                        <label class="control-label" for="meta-keywords">{{{ Lang::get('admin/slugs.meta_keywords') }}}</label>
						<input class="form-control" type="text" name="meta-keywords" id="meta-keywords" value="{{{ Input::old('meta-keywords', isset($post) ? $post->meta_keywords : null) }}}" />
						{{{ $errors->first('meta-keywords', '<span class="help-inline">:message</span>') }}}
					</div>
				</div>

			</div>
		</div>

		<div class="form-group">
			<div class="col-md-12">
				{{ Form::reset(Lang::get('button.cancel'), array('class' => 'btn btn-danger', 'onclick'=>'parent.bootbox.hideAll()')); }} 
				{{ Form::reset(Lang::get('button.reset'), array('class' => 'btn btn-default')); }} 
				{{ Form::submit(Lang::get('button.save'), array('class' => 'btn btn-success')); }} 
			</div>
		</div>
	{{ Form::close(); }}
@stop
@section('styles')
	<link rel="stylesheet" href="{{{ asset('assets/css/summernote.css') }}}"/>
	<link rel="stylesheet" href="{{{ asset('assets/css/summernote-bs3.css') }}}"/>
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
@stop
@section('scripts')
	<script src="//cdnjs.cloudflare.com/ajax/libs/summernote/0.5.0/summernote.min.js"></script>
	<script type="text/javascript">
	  $('.wysiwyg').summernote();
	</script>
@stop