<?php
session_start();
include('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $transaction_id = $_POST['transaction_id'];

    $stmt = $conn->prepare("UPDATE transactions SET status = 'approved' WHERE id = ?");
    $stmt->bind_param("i", $transaction_id);
    $stmt->execute();

    header("Location: admin.php");
    exit();
}
?>
