<?php
session_start();
include('db_connection.php');

if (!isset($_SESSION['logged_in']) || !$_SESSION['is_admin']) {
    header("Location: login.html"); // توجيه غير الإداريين إلى صفحة تسجيل الدخول
    exit();
}

$stmt = $conn->prepare("SELECT * FROM transactions ORDER BY purchase_date DESC");
$stmt->execute();
$result = $stmt->get_result();

echo "<h1>لوحة التحكم - المعاملات</h1>";
echo "<table border='1'>
<tr>
<th>رقم المعاملة</th>
<th>اسم الخدمة</th>
<th>تاريخ الشراء</th>
<th>السعر</th>
</tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>
    <td>" . $row['id'] . "</td>
    <td>" . $row['service_name'] . "</td>
    <td>" . $row['purchase_date'] . "</td>
    <td>" . $row['price'] . "</td>
    </tr>";
}

echo "</table>";

$stmt->close();
$conn->close();
?>
