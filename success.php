<?php
session_start();
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نجاح الطلب</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #121212;
            color: #e0e0e0;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            text-align: center;
        }

        header {
            background-color: #1f1f1f;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            margin-bottom: 20px;
        }

        h1 {
            font-size: 2.5em;
            color: #00ff00; /* لون مميز */
            margin: 0;
        }

        section {
            background-color: #1c1c1c;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            width: 80%;
            max-width: 600px;
        }

        p {
            font-size: 1.2em;
            margin: 15px 0;
        }

        button {
            background-color: #00ff00; /* لون زاهي */
            color: #121212;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 1em;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }

        button:hover {
            background-color: #33cc33; /* لون أخضر أغمق عند التحويم */
        }

        footer {
            margin-top: 20px;
            font-size: 0.8em;
            color: #888;
        }
    </style>
</head>
<body>
    <header>
        <h1>تمت عملية الشراء بنجاح!</h1>
    </header>
    <section>
        <p>شكرًا لك! سيتم مراجعة طلبك قريبًا.</p>
        <button onclick="window.location.href='index.php'">العودة إلى الصفحة الرئيسية</button>
    </section>
    <footer>
        <p>© 2024 جميع الحقوق محفوظة</p>
    </footer>
</body>
</html>
