<?php
session_start();

// تحقق من تسجيل الدخول
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: speedpay.html"); // توجيه إلى صفحة تسجيل الدخول إذا لم يكن مسجلاً
    exit();
}

include('db_connection.php'); // الاتصال بقاعدة البيانات

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // تحقق من وجود القيم المطلوبة
    if (isset($_POST['quantity']) && !empty($_POST['quantity']) && isset($_POST['speed']) && !empty($_POST['speed']) && isset($_POST['link']) && !empty($_POST['link'])) {
        $userId = $_SESSION['user_id']; // استخدم user_id من الجلسة
        $userEmail = $_SESSION['user_email']; // البريد الإلكتروني من الجلسة
        $quantity = (int)$_POST['quantity']; // تحويل الكمية إلى رقم صحيح
        $speed = $_POST['speed'];
        $link = $_POST['link'];

        // تحديد السعر بناءً على السرعة
        if ($speed === "fastest") {
            $pricePerReview = 1.0;
        } elseif ($speed === "normal") {
            $pricePerReview = 0.75;
        } else {
            $pricePerReview = 0.5;
        }

        $totalPrice = $quantity * $pricePerReview; // حساب السعر الكلي
        $status = 'Pending Approval'; // الحالة الابتدائية
        $serviceName = "زيادة تقييمات جوجل ماب"; // اسم الخدمة

        // إعداد الاستعلام لإدخال البيانات إلى قاعدة البيانات
        $stmt = $conn->prepare("INSERT INTO orders (user_id, service_name, quantity, total_price, status, link, speed, email) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

        if ($stmt) {
            $stmt->bind_param("isidsiss", $userId, $serviceName, $quantity, $totalPrice, $status, $link, $speed, $userEmail);

            if ($stmt->execute()) {
                header("Location: success.php"); // الانتقال إلى صفحة النجاح
                exit();
            } else {
                echo "خطأ في إدخال البيانات: " . $stmt->error; // عرض رسالة الخطأ
            }
            $stmt->close();
        } else {
            echo "تحضير الاستعلام فشل: " . $conn->error;
        }

        $conn->close();
    } else {
        echo "الرجاء تعبئة جميع الحقول المطلوبة.";
    }
}
?>
