<?php
session_start();
include 'db_connection.php';
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>موقع تقديم خدمات</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- مكتبة الأيقونات -->
<style>
       body {
            font-family: Arial, sans-serif;
            background-color: #121212;
            color: #e0e0e0;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #1f1f1f;
            color: #f5f5f5;
            padding: 20px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
        }

        nav button {
            background-color: #333;
            color: #f5f5f5;
            border: none;
            padding: 10px 20px;
            margin: 10px;
            cursor: pointer;
            transition: background-color 0.3s;
            border-radius: 5px;
        }

        nav button:hover {
            background-color: #555;
        }

        .services {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            margin: 20px;
            padding: 20px;
            background-color: #1c1c1c;
            border-radius: 10px;
        }

        .service {
            background-color: #282828;
            border-radius: 10px;
            overflow: hidden;
            margin: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s;
            width: 300px;
            max-width: 100%;
        }

        .service:hover {
            transform: scale(1.05);
        }

        .service img {
            width: 100%;
            height: auto;
            display: block;
        }

        .service-info {
            padding: 15px;
            text-align: left;
        }

        .price {
            font-weight: bold;
            color: #ff5722;
            margin-top: 5px;
        }

        .transactions {
            background-color: #1a1a1a;
            padding: 20px;
            margin: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
        }

        footer {
            background-color: #000;
            color: #f5f5f5;
            text-align: center;
            padding: 15px;
            position: fixed;
            bottom: 0;
            width: 100%;
            box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.5);
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        @media (max-width: 768px) {
            .services {
                flex-direction: column;
                align-items: center;
            }

            header {
                padding: 15px;
            }

            nav button {
                padding: 8px 16px;
            }

            footer {
                font-size: 14px;
            }
        }

        .transactions {
            background-color: #1c1c1c; /* خلفية داكنة */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            margin: 20px 0;
            color: #e0e0e0; /* لون النص */
        }

        h2 {
            text-align: center;
            color: #00ff00; /* لون العنوان */
            margin-bottom: 20px;
            font-size: 2em; /* حجم خط أكبر */
            border-bottom: 2px solid #00ff00; /* خط تحت العنوان */
            padding-bottom: 10px;
        }

        ul {
            list-style: none; /* إزالة النقاط من القائمة */
            padding: 0;
        }

        .transaction-item {
            background-color: #282828; /* خلفية العناصر */
            border-radius: 5px;
            padding: 15px;
            margin: 10px 0;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            transition: transform 0.2s;
        }

        .transaction-item:hover {
            transform: scale(1.02); /* تكبير طفيف عند التحويم */
        }

        .price {
            color: #ff5722; /* لون السعر */
            font-weight: bold;
        }

        .status {
            color: red; /* لون الحالة */
            font-weight: bold;
        }

        .no-transactions {
            text-align: center;
            color: #888; /* لون خفيف للرسالة */
            font-size: 1.2em;
        }

        /* تنسيق شريط البحث */
.search-bar {
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 10px;
}

.search-bar input[type="text"] {
    width: 200px;
    padding: 8px;
    border: none;
    border-radius: 20px;
    background-color: #333;
    color: #e0e0e0;
    margin-right: 10px;
    transition: background-color 0.3s;
}

.search-bar input[type="text"]::placeholder {
    color: #bbb;
}

.search-bar input[type="text"]:focus {
    outline: none;
    background-color: #555;
}

.search-bar button {
    background-color: #00bfa5;
    color: #fff;
    padding: 8px 12px;
    border: none;
    border-radius: 20px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.search-bar button:hover {
    background-color: #009688;
}

/* تنسيق أيقونة تسجيل الخروج */
.logout-icon {
    margin-left: 20px;
    color: #f5f5f5;
    font-size: 1.2em;
    cursor: pointer;
    text-decoration: none;
    transition: color 0.3s;
}

.logout-icon:hover {
    color: #ff5722;
}

    </style>

</head>
<body>
<header>
    <nav>
        <?php if (!isset($_SESSION['logged_in'])): ?>
            <button onclick="window.location.href='speedpay.html'">تسجيل الدخول</button>
            <button onclick="window.location.href='signup.html'">إنشاء حساب</button>
        <?php else: ?>
            <div class="search-bar">
                <form method="GET" action="">
                    <input type="text" name="search" placeholder="بحث عن خدمة..." required>
                    <button type="submit">بحث</button>
                </form>
                <a href="logout.php" title="تسجيل الخروج" class="logout-icon">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </div>
        <?php endif; ?>
    </nav>
</header>


<section class="services">
    <a href="pay.html">
        <div class="service">
            <img src="https://tse3.mm.bing.net/th?id=OIP.rOMUi2IKFRCqY19EDJ--oAAAAA&pid=Api&P=0&h=220" alt="خدمة 1">
            <div class="service-info">
                <p>زيادة تقييمات جوجل ماب</p>
                <p class="price">السعر: 0.75 دولار</p>
            </div>
        </div>
    </a>
</section>
<section class="transactions">
    <h2>أحدث معاملات</h2>
    <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
        <?php
        // جلب نتائج البحث إذا كان هناك بحث
        if (isset($_GET['search']) && !empty($_GET['search'])) {
            $searchQuery = '%' . $_GET['search'] . '%';
            $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id = ? AND service_name LIKE ? ORDER BY created_at DESC");
            $stmt->bind_param("is", $userId, $searchQuery);
        } else {
            // استرجاع كل المعاملات الخاصة بالمستخدم
            $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC");
            $stmt->bind_param("i", $userId);
        }
        
        $userId = $_SESSION['user_id'];
        $stmt->execute();
        $result = $stmt->get_result();

        $transactions = [];
        while ($row = $result->fetch_assoc()) {
            $transactions[] = $row;
        }

        $_SESSION['transactions'] = $transactions; // تخزين المعاملات في الجلسة
        $stmt->close();
        ?>

        <?php if (count($transactions) > 0): ?>
            <ul>
                <?php foreach ($transactions as $transaction): ?>
                    <li class="transaction-item">
                        <strong>اسم الخدمة:</strong> <?php echo htmlspecialchars($transaction['service_name']); ?> <br>
                        <strong>الكمية:</strong> <?php echo htmlspecialchars($transaction['quantity']); ?> <br>
                        <strong>السعر:</strong> <span class="price"><?php echo htmlspecialchars($transaction['total_price']); ?> دولار</span> <br>
                        <strong>الحالة:</strong> 
                        <span class="status <?php echo strtolower(str_replace(' ', '-', $transaction['status'])); ?>">
                            <?php echo htmlspecialchars($transaction['status']); ?>
                        </span>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p class="no-transactions">لا توجد معاملات جديدة في الوقت الحالي.</p>
        <?php endif; ?>
    <?php else: ?>
        <p class="no-transactions">لديك معاملات سابقة ولكن يجب عليك تسجيل الدخول لرؤيتها.</p>
    <?php endif; ?>
</section>

<footer>
    <p>جميع الحقوق محفوظة &copy; 2024</p>
</footer>
</body>
</html>
