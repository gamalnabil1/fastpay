<?php
$servername = "sql305.infinityfree.com"; // اسم خادم قاعدة البيانات
$username = "if0_37494530";               // اسم المستخدم الذي أدخلته في InfinityFree
$password = "3Pgm5MbKoK2yfP6";                 // كلمة مرور قاعدة البيانات
$dbname = "if0_37494530_users";            // اسم قاعدة البيانات


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("فشل الاتصال بقاعدة البيانات: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // التحقق من تكرار البريد الإلكتروني أو اسم المستخدم
    $checkUser = "SELECT * FROM users WHERE email='$email' OR username='$username'";
    $result = $conn->query($checkUser);

    if ($result->num_rows > 0) {
        header("Location: error.html");
        exit();
    } else {
        $sql = "INSERT INTO users (name, username, email, phone, password) VALUES ('$name', '$username', '$email', '$phone', '$password')";

        if ($conn->query($sql) === TRUE) {
            header("Location: success.html");
            exit();
        } else {
            echo "خطأ: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>
