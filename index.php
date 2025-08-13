<?php
require 'config.php';

$stmt = $pdo->query('SELECT customer_id, name, email FROM Customers ORDER BY name');

?>

<!DOCTYPE html>
<html>
<head>
    <title>Customers</title>
</head>
<body>
    <h1>Customers</h1>
    <ul>
    <?php while ($row = $stmt->fetch()): ?>
        <li>
            <a href="orders.php?customer_id=<?= htmlspecialchars($row['customer_id']) ?>">
                <?= htmlspecialchars($row['name']) ?> (<?= htmlspecialchars($row['email']) ?>)
            </a>
        </li>
    <?php endwhile; ?>
    </ul>
</body>
</html>
