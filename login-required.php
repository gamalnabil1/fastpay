<?php
session_start(); // بدء الجلسة
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول مطلوب</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #121212;
            color: #e0e0e0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .message-box {
            text-align: center;
            background-color: #1c1c1c;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
            max-width: 400px;
            width: 100%;
        }
        h2 {
            color: #ff5722; /* لون العنوان */
            margin-bottom: 20px;
        }
        p {
            color: #f5f5f5; /* لون النص */
        }
    </style>
    <script>
        // إعادة التوجيه إلى صفحة تسجيل الدخول بعد 5 ثوانٍ
        setTimeout(function() {
            window.location.href = 'speedpay.html'; // تأكد من وجود صفحة تسجيل الدخول
        }, 5000);
    </script>
</head>
<body>
    <div class="message-box">
        <h2>⚠️ يجب أن تسجل الدخول أولاً!</h2>
        <p>يرجى تسجيل الدخول للقيام بهذه العملية. سيتم توجيهك إلى صفحة تسجيل الدخول خلال 5 ثوانٍ...</p>
    </div>
</body>
</html>
