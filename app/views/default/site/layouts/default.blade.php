 <!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>
			@section('title')
				{{{ Setting::get('site.name') }}}
			@show
		</title>
		<meta name="keywords" content="" />
		<meta name="author" content="" />
		<meta name="description" content="" />
		<meta name="csrf-token" content="{{{ csrf_token() }}}"/>

		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="//bootswatch.com/{{{ Setting::get('site.bootswatch') }}}/bootstrap.min.css" />
		<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
		<style type="text/css">
			#logo{background:url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACgAAAAoCAMAAAHMJ3jJAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyBpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYwIDYxLjEzNDc3NywgMjAxMC8wMi8xMi0xNzozMjowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNSBXaW5kb3dzIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOjM4M0QzMzg1RDg1ODExRTM5RkM1QjJCRUI2MjgzMjRFIiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOjM4M0QzMzg2RDg1ODExRTM5RkM1QjJCRUI2MjgzMjRFIj4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6MzgzRDMzODNEODU4MTFFMzlGQzVCMkJFQjYyODMyNEUiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6MzgzRDMzODREODU4MTFFMzlGQzVCMkJFQjYyODMyNEUiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz4YBCo7AAADAFBMVEX7aVf6Tjf6SjP6Mhn6Tzn7ZFD6SDH6UDv6TDb6TTf6Ri/6Tjj6SzT/9/b6STL6RC3/+vn6Uz37alf6Tzj//f37ZlP6SjT6Ri76RCz//v77V0L6RS36SzX6QSn6Qyz6VT/6UDn/+Pf8mo76RS7//Pz7eGj/8/L+3Nf6Qiv6W0f8o5f7gXH9r6b7bFn6Ujz7emn9vrb7gHD8jYD9r6X7dGP9uK/+5uP7dWT9xr/9tq39sKf8hnb6TDX7Y1D/8/H6Ry/+4t7/6+n7ZFH+7Or9vLP6QCn6RzD6RzH/8fD+5OD7fm77dmT6TTb7Z1T8mo36WkX8g3T9xLz/+fj6PSX7bVr6Xkr8jH7+z8r8iHn7bFr/9PP7bl3/+/v8mIv/5eL5Mhn9rqT8dGP+4t/8hnf9raP7VkH6YU36Qin8raL6WUP8iHj6VD77VT/9yMH8koT9xL39rqP/8e/7g3T9mIz/9fT+29X6V0P7b137alj9sKb6VkH/7+z7XUn9ysT9qZ78nZH8joH8jHz7c2H+4d3+3Nj+3dr9xLv+3tr6Nh36WUT+zMb//fz9oZX9oZb+8/L8iXv6QCf7lIf+ycT9wLj+wrv8hHX8hHb+5+T6Pyj6STP7a1n+8vD8i3z+v7f/4+D7iHr8lYj9o5j7eGb+5OH9x8D+x8D+x8L8rKL9rKL7e2v9q6H7cF77Uz3+0cv//Pv+49/6TTj8gnL+8O7/8O79tKv7blv9xb36SDL9xr77ZVL7STL8p536VD//8vD+ycP9l4r+6ef+1tH8gHD9sqj+3tn///79s6r6QCj8inv+zsb7eWj7eWn6OB76STH7dGL7dWP6RjD/+vr/9vT/9/X8eGj8emn/5uP8h3j6Pif8h3r7fW3+zcf6UTr7blz+2NP9urL9u7P6Ri37a1j+tq39qqD8pZr8ppv6VkD+8fD8moz/7+36XEj+0s37emr+z8n6PCT+19P7eWf9y8T6RS/7Yk39qZ/7X0r7WkX8nZD8kYT8joD6UTv7ZVH////6UDr////9EYT2AAABAHRSTlP///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////8AU/cHJQAAAxtJREFUeNpi+P8HCBj+/Nv09x/DHxbBJ+xAdmUZkP2P/d8/gABi0AdKrmL4x2727x/Dv3v/gGr+sf8Fsf+x/fsHEEAM1v9gAKj839+/Tn8dYMzff9dDmP+yLdhACv7D1QIEEMN/1j8Q8J/hH0IUiMPOnuGBMKXzlE4ai4GZU/7+Y3nzDcyUmC/r1MMDUfsbaAdU27/aXJgJ//h84EwIAAggJIvh4BQDK4QhzMY9UVgayQ9Aoa1cfgIiDte5/H8jBJmY//76/Ztr+n1XFoQgT7xA7+9/bpcXzkASZNG9IZklG9fG1omkHeRc64CNHCgWAYFESYwVN0xQCNOdwFA7hyH2HyCAGP7/3/kHGbCq/v/P4PUPi0o4kx3OMoQK/hb/Z+gvA3USK1SQX6Rm7S2DyWD//PsDERQWNO+SlNwtr8uBEGRZMe+S4yztv4//SiEEfz80/xv8W+/73w42hCD/X61Wzn//5P4+VeGDC7JL2/49/u83w19mJJUKGaUXi//ZvzqMbOY/bvmwo++r/nIJIdkOBBp///51tGH/hyLIvShg6msoGy7IoWOxpOk3muC/KyoiXOgq/7Gwsf3GEEQCvtgE/2NJYKv/AwQYMI5U/xEE//9j041dKcMjVIHfQKdyaXD8/vcb3ZF/kLksHFdN+NN4/76cEBqRyYEs8wdJ4R0Wd9dp665F2y7Q+vjcVMDF3k3mNzaFv5WN+t5x93v8/curBowBg11Ks/M5ObGZ6JMTq33w74GKYHF3WbG5fwUa/UJmsmMqVNh+89PP/X+dNXnA9vFb/n2TGFiwhhNTIV/yvgajv7wM4ChiYdrxd1L50hQ9TnZMq23klU5v+7tYig+oMl3n79639Xf5sHsmzC5wQ/jf9j0y/ySW/w0SmvNiCicjNs/8Flb24RRM+ns7UujH3+5Dcv/EebAGD0Sx3IkgXkVFXsVlYiz/cAU4JGkKuhxRV2/5cP7Cb/wK/7FpfrVKOLbyM/s/AgpZ/n0RFRVN5f6HrpAVI0X9/v37N4YgK0MRcenRi+G/PjHqvIEpHAhMWFn/4ASsrE0gNQDtiiIv4UoUuwAAAABJRU5ErkJggg==");float:left;width:40px;height:40px;margin-top:5px;margin-right:8px;margin-left:5px}

			body{ padding-top: 60px}
		@section('styles')
		@show
		@yield('styles')
		</style>

   <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{{ asset('assets/ico/apple-touch-icon-144-precomposed.png') }}}">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{{ asset('assets/ico/apple-touch-icon-114-precomposed.png') }}}">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{{ asset('assets/ico/apple-touch-icon-72-precomposed.png') }}}">
		<link rel="apple-touch-icon-precomposed" href="{{{ asset('assets/ico/apple-touch-icon-57-precomposed.png') }}}">
		<link rel="shortcut icon" href="{{{ asset('assets/ico/favicon.png') }}}">
	</head>

	<body>
		<div id="wrap">
		<div class="navbar navbar-default  navbar-fixed-top">
			 <div class="container">
                <div class="navbar-header">
                    <div id="logo"></div>
					<a href="{{{ URL::to('/') }}}" class="navbar-brand">{{{ Setting::get('site.name') }}}</a>
					<button type="button" class="fa fa-lg fa-bars hidden-sm hidden-md hidden-lg navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">{{{ Lang::get('core.toggle_nav') }}}</span>
					</button>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
						<li {{ (Request::is('/') ? ' class="active"' : '') }}><a href="{{{ URL::to('') }}}">{{{ Lang::get('site.home') }}}</a></li>
						<li {{ (Request::is('contact-us') ? ' class="active"' : '') }}><a href="{{{ URL::to('contact-us') }}}">{{{ Lang::get('site.contactus') }}}</a></li>
						@foreach (DB::select('SELECT title, slug FROM posts WHERE parent = 0 AND display_navigation = 1') as $row)
							<li {{ (Request::is($row->slug) ? ' class="active"' : '') }}>
								<a href="{{{ URL::to($row->slug) }}}">
										{{{ $row->title }}}
								</a>
							</li>
						@endforeach
					</ul>

                    <ul class="nav navbar-nav pull-right">
                        @if (Auth::check())
							@if (Auth::user()->hasRole('admin'))
							<li class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#">
									<span class="glyphicon"><img alt="{{{ Auth::user()->email }}}" src="{{ Gravatar::src(Auth::user()->email, 20) }}"></span>  &nbsp; {{{ Auth::user()->email }}}	<span class="caret"></span>
								</a>
								<ul class="dropdown-menu">
									<li><a href="{{{ URL::to('admin') }}}">{{{ Lang::get('site.admin_panel') }}}</a></li>
									<li class="divider"></li>
									<li><a href="{{{ URL::to('user/logout') }}}">{{{ Lang::get('core.logout') }}}</a></li>
								</ul>
							</li>
							@else
								<li><a href="{{{ URL::to('user/logout') }}}">{{{ Lang::get('core.logout') }}}</a></li>
							@endif
                        @else
							<li {{ (Request::is('user/login') ? ' class="active"' : '') }}><a href="{{{ URL::to('user/login') }}}">{{{ Lang::get('user/user.login') }}}</a></li>
							<li {{ (Request::is('user/create') ? ' class="active"' : '') }}><a href="{{{ URL::to('user/create') }}}">{{{ Lang::get('site.sign_up') }}}</a></li>
                        @endif
                    </ul>
				</div>
			</div>
		</div>

		<div class="container">
			@include(Theme::path('notifications'))

			@yield('content')
			<hr/>
		</div>

		<div id="push"></div>
		</div>


	    <div id="footer">
	      <div class="container">
	        <p class="muted credit">&copy; {{ date('Y') }} {{{ Setting::get('site.name') }}}</p>
	      </div>
	    </div>

	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.1.1/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.2.0/bootbox.min.js"></script>

	@yield('scripts')
</body>
</html>
