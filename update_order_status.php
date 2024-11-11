<?php
session_start();
include 'db_connection.php';

// التحقق من أن المستخدم هو الأدمن
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== 1) {
    header("Location: speedpay.html"); // تحويل غير الأدمن إلى صفحة الدخول
    exit();
}

// التحقق من استلام بيانات الطلب
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

    // تحديث حالة الطلب في قاعدة البيانات
    $stmt = $conn->prepare("UPDATE orders SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $order_id);

    if ($stmt->execute()) {
        header("Location: admin.php"); // إعادة توجيه إلى لوحة التحكم بعد التحديث
        exit();
    } else {
        echo "خطأ في تحديث حالة الطلب.";
    }
}
?>
