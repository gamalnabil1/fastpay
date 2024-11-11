<?php
session_start();
include 'db_connection.php';

// التحقق من أن المستخدم هو الأدمن
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== 1) {
    header("Location: speedpay.html"); // تحويل غير الأدمن إلى صفحة الدخول
    exit();
}

// استرجاع الطلبات من قاعدة البيانات
$sql = "SELECT * FROM orders ORDER BY created_at DESC";
$result = $conn->query($sql);

// استرجاع حالات الطلبات من قاعدة البيانات
$status_sql = "SELECT * FROM order_statuses";
$status_result = $conn->query($status_sql);
$status_options = [];
if ($status_result->num_rows > 0) {
    while ($row = $status_result->fetch_assoc()) {
        $status_options[$row['status_key']] = $row['status_value'];
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة تحكم الأدمن</title>
    <link rel="stylesheet" href="styles.css">
    <style>
    /* إعدادات عامة */
body {
    font-family: 'Arial', sans-serif;
    background-color: #121212;
    color: #e0e0e0;
    margin: 0;
    padding: 0;
}

/* الرأس */
header {
    background-color: #1f1f1f;
    color: #f5f5f5;
    padding: 20px;
    text-align: center;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
}

/* أزرار */
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

/* قسم الخدمات */
.services {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
    margin: 20px;
    padding: 20px;
    background-color: #1c1c1c;
    border-radius: 10px;
}

/* خدمات فردية */
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

/* جدول الطلبات */
table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
}

table, th, td {
    border: 1px solid #333;
}

th, td {
    padding: 10px;
    text-align: left;
}

th {
    background-color: #1c1c1c;
}

td {
    background-color: #282828;
}

/* الأزرار داخل الجدول */
button {
    background-color: #ff5722;
    color: white;
    border: none;
    padding: 8px 12px;
    border-radius: 5px;
    cursor: pointer;
}

button:hover {
    background-color: #ff3d00;
}

/* قسم المعاملات */
.transactions {
    background-color: #1c1c1c;
    padding: 20px;
    margin: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
}

/* فوتر */
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

/* أسلوب العناوين */
h1, h2 {
    color: #00ff00;
}

/* وسائل الإعلام */
@media (max-width: 768px) {
    .services {
        flex-direction: column;
        align-items: center;
    }
}

    </style>
</head>
<body>
    <header>
        <h1>لوحة تحكم الأدمن - إدارة الطلبات</h1>
        <a href="logout.php">تسجيل الخروج</a>
    </header>

    <section class="orders">
        <h2>الطلبات</h2>
        <table>
            <tr>
                <th>رقم الطلب</th>
                <th>اسم الخدمة</th>
                <th>البريد الإلكتروني للمستخدم</th>
                <th>الكمية</th>
                <th>السعر الكلي</th>
                <th>الحالة</th>
                <th>إجراءات</th>
            </tr>

            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['service_name']; ?></td>
                        <td><?php echo $row['user_email']; ?></td>
                        <td><?php echo $row['quantity']; ?></td>
                        <td><?php echo $row['total_price']; ?> دولار</td>
                        <td><?php echo $status_options[$row['status']] ?? $row['status']; ?></td> <!-- عرض الحالة بالعربية -->
                        <td>
                            <form method="POST" action="update_order_status.php">
                                <input type="hidden" name="order_id" value="<?php echo $row['id']; ?>">
                                <select name="status">
                                    <?php foreach ($status_options as $key => $value): ?>
                                        <option value="<?php echo $key; ?>" <?php echo $row['status'] == $key ? 'selected' : ''; ?>><?php echo $value; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <button type="submit">تحديث</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="7">لا توجد طلبات في الوقت الحالي.</td></tr>
            <?php endif; ?>
        </table>
    </section>
</body>
</html>
