INSERT INTO Customers (name, email, phone, address) VALUES
('Alice Johnson', 'alice@example.com', '0712345678', 'Nairobi, Kenya'),
('Bob Smith', 'bob@example.com', '0723456789', 'Mombasa, Kenya');

INSERT INTO Categories (name, description) VALUES
('Electronics', 'Phones, Laptops, Accessories'),
('Clothing', 'Men and Women Apparel');

INSERT INTO Products (name, description, price, category_id) VALUES
('iPhone 14', 'Latest Apple iPhone', 1200.00, 1),
('Laptop HP', 'High performance HP laptop', 800.00, 1),
('T-Shirt', 'Cotton T-Shirt', 20.00, 2);

INSERT INTO Orders (customer_id, status) VALUES
(1, 'Completed'),
(2, 'Pending');

INSERT INTO Order_Items (order_id, product_id, quantity, price) VALUES
(1, 1, 1, 1200.00),
(1, 3, 2, 20.00),
(2, 2, 1, 800.00);

INSERT INTO Payments (order_id, amount, payment_method) VALUES
(1, 1240.00, 'Credit Card');
