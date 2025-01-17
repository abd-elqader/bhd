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


    <link href="https://unpkg.com/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{public_asset('Tenant/js/jqueryui/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{public_asset('Tenant/css/animated.css')}}">
    <link rel="stylesheet" href="{{public_asset('Tenant/css/stylesheet.css')}}">
    <link rel="stylesheet" href="{{public_asset('Tenant/css/newcss.css')}}">
    <link rel="stylesheet" href="{{public_asset('Tenant/css/navbar_footer.css')}}">
    <link rel="stylesheet" href="{{public_asset('Tenant/css/media.css')}}">
    
    
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
    <script src="{{public_asset('Tenant/js/jqueryui/jquery-ui.min.js')}}"></script>
    <script src="{{public_asset('Tenant/js/html5shiv.min.js')}}"></script>
    <script src="{{public_asset('Tenant/js/respond.min.js')}}"></script>
    <script src="{{public_asset('Tenant/js/newjavascript.js')}}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick-theme.min.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
    
    {!! setting('snapchat_services') !!}
    {!! setting('twitter_services') !!}
    {!! setting('facebbok_services') !!}
    {!! setting('google_services') !!}
    {!! setting('tiktok_services') !!}
    {!! setting('instagram_services') !!}

    <style>
        :root {
            --main--color: {{setting('color')}} !important;
        }
        .slick-track {
            margin:auto;
        }
        .slick-track {
            float: left;
        }
        .slick-next:before, .slick-prev:before {
            color: #000;
        }
        .slick-prev {
          left: -35px;
        }
        .slick-next {
          right: -35px;
        }
        .slick-prev:before {
          font-family: "Font Awesome 5 Free"; 
          font-weight: 900; 
          content: "\f104";
          font-size: 2rem;
        }
        .slick-next:before {
          font-family: "Font Awesome 5 Free"; 
          font-weight: 900; 
          content: "\f105";
          font-size: 2rem;
        }
        @if(lang('ar'))
            .breadcrumb-item.active {
                display: contents;
            }
            .breadcrumb-item{
                display: flex
            }
            .dropdown-menu.show {
                text-align: right;
            }
        @endif
        @media (max-width: 575.98px) {
            .list-unstyled .tiny_font {
                float: {{ lang('ar') ? 'right' : 'left' }};
                padding: 10px;
            }
        }
    </style>
</head>
