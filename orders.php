<?php
require 'config.php';

$customer_id = $_GET['customer_id'] ?? null;
if (!$customer_id) {
    die('Customer ID missing');
}

// Get customer info
$stmt = $pdo->prepare('SELECT name FROM Customers WHERE customer_id = ?');
$stmt->execute([$customer_id]);
$customer = $stmt->fetch();
if (!$customer) {
    die('Customer not found');
}

// Get orders
$stmt = $pdo->prepare('SELECT order_id, order_date, status FROM Orders WHERE customer_id = ? ORDER BY order_date DESC');
$stmt->execute([$customer_id]);
$orders = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Orders for <?= htmlspecialchars($customer['name']) ?></title>
</head>
<body>
    <h1>Orders for <?= htmlspecialchars($customer['name']) ?></h1>
    <a href="index.php">← Back to Customers</a>
    <ul>
    <?php foreach ($orders as $order): ?>
        <li>
            <a href="order_details.php?order_id=<?= htmlspecialchars($order['order_id']) ?>">
                Order #<?= htmlspecialchars($order['order_id']) ?> - <?= htmlspecialchars($order['order_date']) ?> - Status: <?= htmlspecialchars($order['status']) ?>
            </a>
        </li>
    <?php endforeach; ?>
    </ul>
</body>
</html>
