<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    @hasSection ('pagetitle')
        <title>{{ ucfirst(tenant() ? tenant()->id : env('APP_NAME')) }} @yield('pagetitle')</title>
    @else
        <title>{{ ucfirst(tenant() ? tenant()->id : config('app.name', 'Laravel')) }}</title>
    @endif
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf_token" value="{{ csrf_token() }}" content="{{ csrf_token() }}"/>
    <meta name="csrf-token" value="{{ csrf_token() }}" content="{{ csrf_token() }}">
    <meta name="user-theme" content="{{ auth()->user()->theme }}" />
    <link rel="icon" href="{{ public_asset(setting('logo')) }}" type="image/x-icon">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="description" content="{{strip_tags(setting('desc'))}}">
    <meta name="keywords" content="{!! strip_tags(setting('keywords'))!!}">
    <meta name="author" content="{{ strip_tags(setting('author')) }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
    {{-- services module style --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.5.3/css/bootstrap.min.css"
        integrity="sha384-JvExCACAZcHNJEc7156QaHXTnQL3hQBixvj5RV5buE7vgnNEzzskDtx9NQ4p6BJe" crossorigin="anonymous">

    <title>@yield('title')</title>
    <style>
        .card-title {
            padding-top: 20%;
        }

        .mt-3 {
            margin-top: 1rem !important;
            position: absolute;
            bottom: 5%;
            left: 40%;
        }

        .card-body {
            min-height: 250px;
            background: #f9f9f9cc;

        }

        .circular-image {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto 1rem;
            background-color: transparent;
            display: flex;
            align-items: center;
            justify-content: center;
            position: absolute;
        }

        .circular-image img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            size: cover;
        }

        input,
        textarea,
        input::placeholder {
            unicode-bidi: bidi-override;
            direction: RTL;
        }

        .table {
            direction: rtl
        }

        /* Extra small devices (phones, 600px and down) */
        @media only screen and (max-width: 600px) {
            .circular-image {
                top: -20%;
                left: 35%;
            }

            .row-cols-1>* {
                margin-bottom: 8%;
            }
        }

        /* Small devices (portrait tablets and large phones, 600px and up) */
        @media only screen and (min-width: 600px) {
            .circular-image {
                top: -20%;
                left: 35%;
            }

            .row-cols-md-2>* {
                margin-bottom: 8%;
            }
        }

        /* Large devices (laptops/desktops, 992px and up) */
        @media only screen and (min-width: 992px) {
            .circular-image {
                top: -25%;
                left: 30%;
            }
        }
    </style> --}}
    {{-- //////////////// --}}
    <style>
        @font-face {
          font-family: "LineIcons";
          src: url("/fonts/LineIcons.eot");
          src: url("/fonts/LineIcons.eot") format("embedded-opentype"),
            url("/fonts/LineIcons.woff2") format("woff2"),
            url("/fonts/LineIcons.woff") format("woff"),
            url("/fonts/LineIcons.ttf") format("truetype"),
            url("/fonts/LineIcons.svg") format("svg");
          font-weight: normal;
          font-style: normal;
        }
    </style>

    <link rel="stylesheet" href="{{ public_asset(env('APP_URL') .'/css/lineicons.css') }}" />
    <link href='https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap' rel="stylesheet">

    <link href="{{ public_asset(env('APP_URL') .'/css/dashboard.css') }}" rel="stylesheet">

    @yield('css')
    @if (lang('ar'))
    <link href="{{ public_asset(env('APP_URL') .'/css/ar.css') }}" rel="stylesheet">
    @else
    <link href="{{ public_asset(env('APP_URL') .'/css/en.css') }}" rel="stylesheet">
    @endif
    <link href="{{ auth()->user()->theme == 1 ? '' : public_asset(env('APP_URL') .'/css/dark.css') }}" rel="stylesheet" id="darkTheme">

    @trixassets
    @if(tenant())
        @php($PackageDetails = PackageDetails())
    @endif

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.css" integrity="sha512-ngQ4IGzHQ3s/Hh8kMyG4FC74wzitukRMIcTOoKT3EyzFZCILOPF0twiXOQn75eDINUfKBYmzYn2AA8DkAk8veQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .note-editable ul{
          list-style: disc !important;
          list-style-position: inside !important;
        }

        .note-editable ol {
          list-style: decimal !important;
          list-style-position: inside !important;
        }
        .note-dropdown-menu {
            max-height: 200px; /* Set your desired max height */
            overflow-y: auto;
        }
    </style>
</head>

<body class="{{ auth()->user()->theme == 1 ? '' : 'darkTheme' }}">
    <aside class="sidebar-nav-wrapper active">
        <div class="navbar-logo">
            <a href="{{ route('admin.home') }}">
                <img src="{{ setting('logo') ?? setting('logo') }}" alt="logo" style="max-height: 100px;max-width: 100%" />
            </a>
        </div>
        <nav class="sidebar-nav">
            @include('Mix.layouts.sidebar')
        </nav>
    </aside>
    <div class="overlay"></div>

    <main class="main-wrapper active">
        <header class="header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-2" style="z-index: 100">
                        <div class="header-left">
                            <div class="menu-toggle-btn mr-20">
                                <button id="menu-toggle" class="main-btn primary-btn btn-hover">
                                    <i class="lni lni-menu"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-7 d-flex justify-content-end align-items-center">
                        @if(isset($PackageDetails) )
                            <div class="countdown d-none d-md-block" @if(!str_contains(url()->full(), 'packages')) onclick="location.href='{{ route('admin.packages.index') }}'" @endif>
                                <div class="box">
                                    <span class="num" id="sec-box">00</span>
                                    <span class="text">{{ __("messages.seconds") }}</span>
                                </div>
                                <div class="box">
                                    <span class="num" id="min-box">00</span>
                                    <span class="text">{{ __("messages.minutes") }}</span>
                                </div>
                                <div class="box">
                                    <span class="num" id="hr-box">00</span>
                                    <span class="text">{{ __("messages.hours") }}</span>
                                </div>
                                <div class="box">
                                    <span class="num" id="day-box">00</span>
                                    <span class="text">{{ __("messages.days") }}</span>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-3">
                        <div class="header-right">
                            <div class=" profile-box ml-15">
                                <button class="bg-transparent border-0">
                                    <div class="profile-info">
                                        <div class="info">
                                            <i class="fa-solid toggle-theme {{ auth()->user()->theme == 1 ? 'fa-toggle-off' : 'fa-toggle-on' }} h1"></i>
                                        </div>
                                    </div>
                                </button>
                                <button class="dropdown-toggle bg-transparent border-0" type="button" id="profile" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="profile-info">
                                        <div class="info">
                                            <h6>{{ Auth::user()->name }}</h6>
                                        </div>
                                    </div>
                                    <i class="lni lni-chevron-down"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profile">
                                    <li>
                                        <form method="POST" action="{{ route('admin.logout') }}">
                                            @csrf
                                            <a href="{{ route('admin.logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"> <i class="lni lni-exit"></i> {{ __('website.logout') }}</a>
                                        </form>
                                    </li>
                                    @if (lang('en'))
                                        <li>
                                            <a href="{{ route('lang', 'ar') }}">
                                                <span class="icon text-center">
                                                    <img src="{{ public_asset(MainCurrancy() ? MainCurrancy()->image : DefaultCurrancy()->image) }}" style="width: 20px;" class="mx-2">
                                                </span>
                                                <span class="text">Arabic</span>
                                            </a>
                                        </li>
                                    @else
                                        <li>
                                            <a href="{{ route('lang', 'en') }}">
                                                <span class="icon text-center">
                                                    <img src="{{ public_asset('/language/en.png') }}" style="width: 20px;" class="mx-2">
                                                </span>
                                                <span class="text">English</span>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @if(tenant() && tenant()->id != 'demo')
                <div class="row d-flex justify-content-end align-items-center expired_date text-start btn" @if(!str_contains(url()->full(), 'packages')) onclick="location.href='{{ route('admin.packages.index') }}'" @endif>
                    @if(isset($PackageDetails))
                        @lang('dashboard.expired_date') {{date('d/m/y',strtotime($PackageDetails->end_date))  }}
                    @else
                        <span class="text-danger">
                            @lang('messages.Your package Date Expired Renew')
                        </span>
                    @endif
                </div>
                @endif
            </div>
        </header>

        <section class="section">
            <div class="container-fluid">
                <div class="title-wrapper pt-30">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="title mb-30">
                                <h2>@yield('pagetitle') @if(tenant()) {{ ucfirst(tenant()->id) }} @endif</h2>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-styles">
                    @yield('content')
                </div>
            </div>
        </section>

        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 order-last order-md-first">
                        <div class="copyright text-md-center">
                            <p class="text-sm">
                                @lang('messages.copyrights',['tenant'=>tenant() ? tenant()->id . ' ' : ''])
                                <a href="https://www.instagram.com/emcansolutions/" rel="nofollow" target="_blank">
                                    {{ __('messages.emcan') }}
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </main>


    @include('sweetalert::alert', ['cdn' => "https://unpkg.com/sweetalert2@9"])
    <script src="{{ public_asset(env('APP_URL') .'/js/dashboard.js') }}"></script>
    <script src="{{ public_asset(env('APP_URL') .'/js/main.js') }}?v=1.1"></script>

    {{-- datatables  --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">

    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script>

        function DeleteSelected(table,id = 0) {
            event.preventDefault();
            var ids = [];
            if(id > 0)
                ids.push(id);
            else{
                $('input:checkbox[class="DTcheckbox"]:checked').each(function() {
                    ids.push($(this).attr('value'));
                });
            }
            swal({title: "@lang('messages.delete')", text: "@lang('messages.deletewarning')", icon: "warning", buttons: true, dangerMode: true}).then((willchagestatus) => {
                if (willchagestatus) {
                    $.ajax({
                        type: "POST"
                        , url: "{{ route('RemoveIds') }}"
                        , data: {
                            _token: "{{ csrf_token() }}"
                            , ids: ids
                            , table: table
                        , }
                        , dataType: 'text'
                        , cache: false
                        , success: function(result) {
                            result = JSON.parse(result);
                            swal({title: "😀❤️ " + result.msg, icon: "success", buttons: true, dangerMode: true});
                            if(id > 0)
                                $(this).parent().parent().remove();
                            else{
                                $('#DataTable').DataTable().ajax.reload();
                                $('.DTcheckbox').prop('checked', false);
                                $('#ToggleSelectAll').attr('checked',false);
                                $('#DeleteSelected').attr('disabled',true);
                            }

                        }
                        , error: function(xhr, status, errorThrown) {
                            swal({title: "{{ __('messages.sorry_there_was_an_error') }}", icon: "warning", buttons: true, dangerMode: true});
                        }
                    });
                }
            });
        }
        function toggleswitch(id,table , column_name = 'status',checkbox = 'checkbox') {
            event.preventDefault();
            swal({text: "@lang('messages.changeStatus')", title: "@lang('messages.display')", icon: "warning", buttons: true, dangerMode: true}).then((willchagestatus) => {
                if (willchagestatus) {
                    $.ajax({
                        type: "POST"
                        , url: "{{ route('switch') }}"
                        , data: {
                            _token: "{{ csrf_token() }}"
                            , id: id
                            , column_name: column_name
                            , table: table
                        , }
                        , dataType: 'text'
                        , cache: false
                        , success: function(checked) {
                            swal({title: "😀❤️ {{ __('messages.updatedSuccessfully') }}", icon: "success", buttons: true, dangerMode: true});
                            checked = JSON.parse(checked);
                            $('#' + checkbox + id).prop('checked', checked == 1);
                        }
                        , error: function(xhr, status, errorThrown) {
                            swal({title: "{{ __('messages.sorry_there_was_an_error') }}", icon: "warning", buttons: true, dangerMode: true});
                        }
                    });
                }
            });
        }
    </script>
    @if(isset($PackageDetails))
        <script type="text/javascript">
            let dayBox = document.getElementById("day-box");
            let hrBox = document.getElementById("hr-box");
            let minBox = document.getElementById("min-box");
            let secBox = document.getElementById("sec-box");


            let endDate = new Date('{{ $PackageDetails->end_date }}');
            //Output value in milliseconds
            let endTime = endDate.getTime();

            function countdown() {
                let todayDate = new Date();
                //Output value in milliseconds
                let todayTime = todayDate.getTime();

                let remainingTime = endTime - todayTime;

                //60sec => 1000 milliseconds
                let oneMin = 60 * 1000;
                //1hr => 60 minutes
                let oneHr = 60 * oneMin;
                //1 day => 24 hours
                let oneDay = 24 * oneHr;

                //Function to format number if it is single digit
                let addZeroes = (num) => (num < 10 ? `0${num}` : num);

                //If end dat is before today date
                if (endTime < todayTime) {
                    clearInterval(i);
                    document.querySelector(".countdown").innerHTML = ``;
                    document.querySelector(".expired_date").innerHTML = `<p class="text-danger">@lang('dashboard.expired')</p>`;
                }
                //If end date is not before today date
                else {
                    //Calculating remaining days, hrs,mins ,secs
                    let daysLeft = Math.floor(remainingTime / oneDay);
                    let hrsLeft = Math.floor((remainingTime % oneDay) / oneHr);
                    let minsLeft = Math.floor((remainingTime % oneHr) / oneMin);
                    let secsLeft = Math.floor((remainingTime % oneMin) / 1000);

                    //Displaying Valurs
                    dayBox.textContent = addZeroes(daysLeft);
                    hrBox.textContent = addZeroes(hrsLeft);
                    minBox.textContent = addZeroes(minsLeft);
                    secBox.textContent = addZeroes(secsLeft);
                }
            }
            let i = setInterval(countdown, 1000);
            countdown();
        </script>

    @endif


    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.js" integrity="sha512-6F1RVfnxCprKJmfulcxxym1Dar5FsT/V2jiEUvABiaEiFWoQ8yHvqRM/Slf0qJKiwin6IDQucjXuolCfCKnaJQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>

        $(document).ready(function() {
            if ($('textarea.form-control:not(.mceNoEditor)').length > 0) {
                $('textarea.form-control:not(.mceNoEditor)').summernote({
                    tabsize: 2,
                    height: 300,
                });


            }
        });
    </script>
    {{-- services module --}}
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
    <script>
        // Validate image file type
        document.getElementById('serviceForm').addEventListener('submit', function(event) {
            const fileInput = document.getElementById('serviceImage');
            const filePath = fileInput.value;
            const allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;

            if (!allowedExtensions.exec(filePath)) {
                alert('يرجى تحميل ملف صورة فقط (jpg, jpeg, png, gif)');
                fileInput.value = '';
                event.preventDefault();
                return false;
            }
        });
    </script>
    {{-- //////////// --}}
    @yield('js')
</body>
</html>
