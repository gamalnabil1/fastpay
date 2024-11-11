<?php
$servername = "sql305.infinityfree.com"; // اسم خادم قاعدة البيانات
$username = "if0_37494530";               // اسم المستخدم الذي أدخلته في InfinityFree
$password = "3Pgm5MbKoK2yfP6";                 // كلمة مرور قاعدة البيانات
$dbname = "if0_37494530_users";            // اسم قاعدة البيانات


// إنشاء الاتصال
$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال بقاعدة البيانات: " . $conn->connect_error);
}
?>
