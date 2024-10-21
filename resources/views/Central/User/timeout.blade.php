<!-- resources/views/timeout.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تأخير التوجيه</title>
    <style>
        /* نمط المحمل */
        .loader {
            border: 16px solid #f3f3f3; /* رمادي فاتح */
            border-top: 16px solid #3498db; /* لون المحمل */
            border-radius: 50%;
            width: 120px;
            height: 120px;
            animation: spin 2s linear infinite;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .container {
            text-align: center;
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="loader"></div>
        <p>يتم توجيهك، يرجى الانتظار...</p>
    </div>

    <script>
        // تأخير 10 ثوانٍ ثم إعادة التوجيه إلى URL النهائي
        setTimeout(() => {
            // استرجاع URL النهائي من المعلمة
            let finalUrl = "{{ $finalUrl }}";
            if (finalUrl) {
                window.location.href = decodeURIComponent(finalUrl);
            }
        }, 20000); // تأخير 10 ثوانٍ
    </script>
</body>
</html>