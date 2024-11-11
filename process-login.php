<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include('db_connection.php'); // تأكد من أن هذا الملف مضمن بشكل صحيح

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // التحقق من أن الحقول ليست فارغة
    if (empty($email) || empty($password)) {
        header("Location: login-error.html?error=emptyfields");
        exit();
    }

    // استعلام للتحقق من وجود المستخدم
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // تحقق من كلمة المرور
        if (password_verify($password, $user['password'])) {
            // بعد التحقق من كلمة المرور بنجاح
            $_SESSION['logged_in'] = true;
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email']; 
            $_SESSION['is_admin'] = $user['is_admin']; // تخزين حالة الأدمن في الجلسة

            // رسائل التصحيح للتأكد من أن الحالة تتم تعيينها بشكل صحيح
            error_log("User ID: " . $_SESSION['user_id']);
            error_log("Is Admin: " . $_SESSION['is_admin']); // طباعة الحالة في سجل الأخطاء

            // التحقق مما إذا كان المستخدم هو مشرف
            if ($_SESSION['is_admin'] == 1) { // إذا كان is_admin هو 1
                header("Location: admin.php"); // تحويل المستخدم إلى صفحة التحكم
            } else {
                header("Location: index.php"); // تحويل المستخدم إلى الصفحة الرئيسية
            }
            exit();
        } else {
            // كلمة المرور غير صحيحة
            header("Location: login-error.html?error=wrongpassword");
            exit();
        }
    } else {
        // البريد الإلكتروني غير موجود
        header("Location: login-error.html?error=nouser");
        exit();
    }
}
?>
