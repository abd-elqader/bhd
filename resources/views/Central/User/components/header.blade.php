<head>
    @hasSection ('pagetitle')
        <title>{{ ucfirst(tenant() ? tenant()->id : env('APP_NAME')) }} @yield('pagetitle')</title>
    @else
        <title>{{ ucfirst(tenant() ? tenant()->id : config('app.name', 'Laravel')) }}</title>
    @endif
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf_token" value="{{ csrf_token() }}" content="{{ csrf_token() }}"/>
    <meta name="csrf-token" value="{{ csrf_token() }}" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ public_asset(setting('logo')) }}" type="image/x-icon">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="description" content="{{strip_tags(setting('desc'))}}">
    <meta name="keywords" content="{!! strip_tags(setting('keywords'))!!}">
    <meta name="author" content="{{ strip_tags(setting('author')) }}">

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script defer src="https://emcan-group.com/bootstrap-5.1.3/js/bootstrap.min.js"></script>
    <script src="{{ public_asset('/Central/js/jqueryui/jquery-ui.min.js') }}"></script>
    <script src="{{ public_asset('/Central/js/html5shiv.min.js') }}"></script>
    <script src="{{ public_asset('/Central/js/respond.min.js') }}"></script>
    <script src="{{ public_asset('/Central/js/newjavascript.js') }}"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://emcan-group.com/bootstrap-5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ public_asset('/Central/js/jqueryui/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ public_asset('/Central/css/animated.css') }}">
    <link rel="stylesheet" href="{{ public_asset('/Central/css/stylesheet.css') }}">
    <link rel="stylesheet" href="{{ public_asset('/Central/css/newcss.css') }}">
    <link rel="stylesheet" href="{{ public_asset('/Central/css/navbar_footer.css') }}">
    <link rel="stylesheet" href="{{ public_asset('/Central/css/media.css') }}">
    @if (lang('ar'))
    <link href="{{ public_asset('/Central/css/ar.css') }}" rel="stylesheet">
    @else
    <link href="{{ public_asset('/Central/css/en.css') }}" rel="stylesheet">
    @endif
    @yield('css')
</head>
