<?php
require 'config.php';

// 1. Top 5 best-selling products
$topProducts = $pdo->query("
    SELECT p.name AS product_name, SUM(oi.quantity) AS total_sold
    FROM Order_Items oi
    JOIN Products p ON oi.product_id = p.product_id
    GROUP BY p.name
    ORDER BY total_sold DESC
    LIMIT 5
")->fetchAll();

// 2. Revenue by category
$categoryRevenue = $pdo->query("
    SELECT c.name AS category_name, SUM(oi.quantity * oi.price) AS total_revenue
    FROM Order_Items oi
    JOIN Products p ON oi.product_id = p.product_id
    JOIN Categories c ON p.category_id = c.category_id
    GROUP BY c.name
    ORDER BY total_revenue DESC
")->fetchAll();

// 3. Monthly sales report
$monthlySales = $pdo->query("
    SELECT DATE_FORMAT(o.order_date, '%Y-%m') AS month, 
           SUM(oi.quantity * oi.price) AS monthly_sales
    FROM Orders o
    JOIN Order_Items oi ON o.order_id = oi.order_id
    GROUP BY DATE_FORMAT(o.order_date, '%Y-%m')
    ORDER BY month
")->fetchAll();

// 4. Inactive customers
$inactiveCustomers = $pdo->query("
    SELECT c.customer_id, c.name, c.email
    FROM Customers c
    LEFT JOIN Orders o ON c.customer_id = o.customer_id
    WHERE o.order_id IS NULL
")->fetchAll();

// 5. Payment method usage
$paymentStats = $pdo->query("
    SELECT payment_method, COUNT(*) AS total_transactions, 
           SUM(amount) AS total_amount
    FROM Payments
    GROUP BY payment_method
    ORDER BY total_amount DESC
")->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="assets/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<div class="container">
    <h1>📊 Admin Dashboard</h1>

    <!-- Top Products -->
    <section>
        <h2>Top 5 Best-Selling Products</h2>
        <canvas id="topProductsChart"></canvas>
    </section>

    <!-- Category Revenue -->
    <section>
        <h2>Revenue by Category</h2>
        <canvas id="categoryRevenueChart"></canvas>
    </section>

    <!-- Monthly Sales -->
    <section>
        <h2>Monthly Sales Report</h2>
        <canvas id="monthlySalesChart"></canvas>
    </section>

    <!-- Inactive Customers -->
    <section>
        <h2>Inactive Customers</h2>
        <?php if (count($inactiveCustomers) > 0): ?>
        <table>
            <tr><th>ID</th><th>Name</th><th>Email</th></tr>
            <?php foreach ($inactiveCustomers as $c): ?>
                <tr>
                    <td><?= htmlspecialchars($c['customer_id']) ?></td>
                    <td><?= htmlspecialchars($c['name']) ?></td>
                    <td><?= htmlspecialchars($c['email']) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <?php else: ?>
            <p>All customers have orders.</p>
        <?php endif; ?>
    </section>

    <!-- Payment Stats -->
    <section>
        <h2>Payment Method Statistics</h2>
        <table>
            <tr><th>Payment Method</th><th>Transactions</th><th>Total Amount</th></tr>
            <?php foreach ($paymentStats as $p): ?>
                <tr>
                    <td><?= htmlspecialchars($p['payment_method']) ?></td>
                    <td><?= htmlspecialchars($p['total_transactions']) ?></td>
                    <td>$<?= number_format($p['total_amount'], 2) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </section>
</div>

<script>
// Prepare chart data
const topProducts = <?= json_encode($topProducts) ?>;
const categoryRevenue = <?= json_encode($categoryRevenue) ?>;
const monthlySales = <?= json_encode($monthlySales) ?>;

// Top Products Chart
new Chart(document.getElementById('topProductsChart'), {
    type: 'bar',
    data: {
        labels: topProducts.map(item => item.product_name),
        datasets: [{
            label: 'Units Sold',
            data: topProducts.map(item => item.total_sold),
            backgroundColor: '#4CAF50'
        }]
    }
});

// Category Revenue Chart
new Chart(document.getElementById('categoryRevenueChart'), {
    type: 'pie',
    data: {
        labels: categoryRevenue.map(item => item.category_name),
        datasets: [{
            label: 'Revenue',
            data: categoryRevenue.map(item => item.total_revenue),
            backgroundColor: ['#FF6384','#36A2EB','#FFCE56','#8E44AD','#2ECC71']
        }]
    }
});

// Monthly Sales Chart
new Chart(document.getElementById('monthlySalesChart'), {
    type: 'line',
    data: {
        labels: monthlySales.map(item => item.month),
        datasets: [{
            label: 'Sales ($)',
            data: monthlySales.map(item => item.monthly_sales),
            backgroundColor: '#3498DB',
            borderColor: '#2980B9',
            fill: false
        }]
    }
});
</script>
</body>
</html>
