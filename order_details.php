<?php
require 'config.php';

$order_id = $_GET['order_id'] ?? null;
if (!$order_id) {
    die('Order ID missing');
}

// Get order and customer info
$stmt = $pdo->prepare(
    'SELECT o.order_id, o.order_date, o.status, c.name AS customer_name 
     FROM Orders o JOIN Customers c ON o.customer_id = c.customer_id
     WHERE o.order_id = ?'
);
$stmt->execute([$order_id]);
$order = $stmt->fetch();
if (!$order) {
    die('Order not found');
}

// Get order items
$stmt = $pdo->prepare(
    'SELECT p.name AS product_name, oi.quantity, oi.price
     FROM Order_Items oi JOIN Products p ON oi.product_id = p.product_id
     WHERE oi.order_id = ?'
);
$stmt->execute([$order_id]);
$items = $stmt->fetchAll();

// Get payment info
$stmt = $pdo->prepare('SELECT amount, payment_date, payment_method FROM Payments WHERE order_id = ?');
$stmt->execute([$order_id]);
$payment = $stmt->fetch();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Order #<?= htmlspecialchars($order['order_id']) ?> Details</title>
</head>
<body>
    <h1>Order #<?= htmlspecialchars($order['order_id']) ?> Details</h1>
    <a href="orders.php?customer_id=<?= urlencode($order['customer_id']) ?>">← Back to Orders</a>
    <p><strong>Customer:</strong> <?= htmlspecialchars($order['customer_name']) ?></p>
    <p><strong>Order Date:</strong> <?= htmlspecialchars($order['order_date']) ?></p>
    <p><strong>Status:</strong> <?= htmlspecialchars($order['status']) ?></p>

    <h2>Items</h2>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>Product</th><th>Quantity</th><th>Price (each)</th><th>Subtotal</th>
        </tr>
        <?php
        $total = 0;
        foreach ($items as $item):
            $subtotal = $item['quantity'] * $item['price'];
            $total += $subtotal;
        ?>
        <tr>
            <td><?= htmlspecialchars($item['product_name']) ?></td>
            <td><?= htmlspecialchars($item['quantity']) ?></td>
            <td>$<?= number_format($item['price'], 2) ?></td>
            <td>$<?= number_format($subtotal, 2) ?></td>
        </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="3" align="right"><strong>Total</strong></td>
            <td><strong>$<?= number_format($total, 2) ?></strong></td>
        </tr>
    </table>

    <h2>Payment</h2>
    <?php if ($payment): ?>
        <p><strong>Amount:</strong> $<?= number_format($payment['amount'], 2) ?></p>
        <p><strong>Payment Date:</strong> <?= htmlspecialchars($payment['payment_date']) ?></p>
        <p><strong>Method:</strong> <?= htmlspecialchars($payment['payment_method']) ?></p>
    <?php else: ?>
        <p>No payment recorded.</p>
    <?php endif; ?>
</body>
</html>
