<?php
session_start();
include('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['logged_in'])) {
    $service_name = $_POST['service_name'];
    $price = $_POST['price'];
    $user_id = $_SESSION['user_id'];
    $purchase_date = date('Y-m-d H:i:s');

    $stmt = $conn->prepare("INSERT INTO transactions (user_id, service_name, purchase_date, price) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("issd", $user_id, $service_name, $purchase_date, $price);

    if ($stmt->execute()) {
        echo "تمت إضافة المعاملة بنجاح!";
    } else {
        echo "خطأ في إضافة المعاملة: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "يجب أن تكون مسجلاً للدخول لشراء الخدمة.";
}
?>
