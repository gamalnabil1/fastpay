<?php
session_start();
session_unset(); // تفريغ الجلسة
session_destroy(); // تدمير الجلسة

// حذف الكوكيز
setcookie("user_id", "", time() - 3600, "/");
setcookie("user_email", "", time() - 3600, "/");

header("Location: speedpay.html"); // توجيه المستخدم إلى صفحة تسجيل الدخول
exit();
?>
