<!doctype html>
<html lang="en">
<head>
    @section('head')
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    {{ HTML::style('css/hover.css'); }}
    {{ HTML::style('css/style.css'); }}
    @show
</head>
<body>
    <div class="navbar navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="{{ URL::route('home') }}" class="navbar-brand">Forum</a>
            </div>



            <div class="navbar-collapse collapse navbar-responsive-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="{{ URL::route('home') }}" class="hvr-fade">Home</a></li>
                    <li><a href="{{ URL::route('forum-home') }}" class="hvr-fade">Forums</a></li>
                </ul>
                <ul class="nav navbar-nav">
                    <li>
                        {{ Form::open(array('route' => 'forum-search', 'class' => 'form-inline')) }}
                        {{ Form::text('text', Input::old('text'), array('placeholder'=>'Search',  'class'=>'form-control-sm')); }}
                        {{ Form::select('type', array('1' => 'Tag', '2' => 'Question'), '1', array('class' => 'form-control-sm')) }}
                        {{ Form::submit('Search', array('class' => 'btn-sm btn-info')) }}
                        {{ Form::close() }}
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    @if(!Auth::check())
                        <li><a href="{{ URL::route('getCreate') }}" class="hvr-fade">Register</a></li>
                        <li><a href="{{ URL::route('getLogin') }}" class="hvr-fade">Login</a></li>
                    @else
                    	<li><a href="{{ URL::route('getProfile') }}">You are logged as: 
                    					<span class="username-topmenu">{{ Auth::user()->username }}</span></a></li>
                        <li><a href="{{ URL::route('getLogout') }}" class="hvr-fade">Logout</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
    {{ $errors->first('text'); }}

    @if(Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @elseif (Session::has('fail'))
        <div class="alert alert-danger">{{ Session::get('fail') }}</div>
    @endif

    <div class="container">@yield('content')</div>

    <footer class="footer navbar-fixed-bottom">
    	<div class="container">
    		<p>&#169; 2015 All Rights Reserved by Team Central Park</p>
		</div>
    </footer>

    @section('javascript')
        <script src="http://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <script>
            var mainURL = '<?= URL::to('/') ?>';
        </script>
        {{ HTML::script('js/app.js'); }}
    @show
</body>
</html>
