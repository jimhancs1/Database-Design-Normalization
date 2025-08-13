-- Get total revenue
SELECT SUM(amount) AS total_revenue FROM Payments;

-- Top selling products
SELECT p.name, SUM(oi.quantity) AS total_sold
FROM Order_Items oi
JOIN Products p ON oi.product_id = p.product_id
GROUP BY p.name
ORDER BY total_sold DESC;

-- Orders by customer
SELECT c.name, COUNT(o.order_id) AS orders_count
FROM Customers c
JOIN Orders o ON c.customer_id = o.customer_id
GROUP BY c.name;

-- Get Top 5 Best-Selling Products
SELECT p.name AS product_name, SUM(oi.quantity) AS total_sold
FROM Order_Items oi
JOIN Products p ON oi.product_id = p.product_id
GROUP BY p.name
ORDER BY total_sold DESC
LIMIT 5;

--Get Revenue by Category
SELECT c.name AS category_name, SUM(oi.quantity * oi.price) AS total_revenue
FROM Order_Items oi
JOIN Products p ON oi.product_id = p.product_id
JOIN Categories c ON p.category_id = c.category_id
GROUP BY c.name
ORDER BY total_revenue DESC;

--Monthly Sales Report
SELECT DATE_FORMAT(o.order_date, '%Y-%m') AS month, 
       SUM(oi.quantity * oi.price) AS monthly_sales
FROM Orders o
JOIN Order_Items oi ON o.order_id = oi.order_id
GROUP BY DATE_FORMAT(o.order_date, '%Y-%m')
ORDER BY month;

--SELECT c.customer_id, c.name, c.email
FROM Customers c
LEFT JOIN Orders o ON c.customer_id = o.customer_id
WHERE o.order_id IS NULL;

--Payment Method Usage Statistics
SELECT payment_method, COUNT(*) AS total_transactions, 
       SUM(amount) AS total_amount
FROM Payments
GROUP BY payment_method
ORDER BY total_amount DESC;
