<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
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
    </style>
</head>

<body>
    @yield('content')

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

</body>

</html>
