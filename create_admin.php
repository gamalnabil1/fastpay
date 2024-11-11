<?php
include('db_connection.php'); // تأكد من الاتصال بقاعدة البيانات

// تفاصيل حساب الأدمن
$email = "radyehap@gmail.com";
$password = "radyehap123@"; // استبدل بكلمة مرور الأدمن المطلوبة
$hashed_password = password_hash($password, PASSWORD_DEFAULT); // تشفير كلمة المرور

// إدخال بيانات الأدمن في قاعدة البيانات
$stmt = $conn->prepare("INSERT INTO users (email, password, status, is_admin) VALUES (?, ?, 'active', 1)");
$stmt->bind_param("ss", $email, $hashed_password);

if ($stmt->execute()) {
    echo "تم إنشاء حساب الأدمن بنجاح!";
} else {
    echo "خطأ في إنشاء حساب الأدمن: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
