-- Customers
INSERT INTO Customers (name, email, phone, address) VALUES
('Alice Johnson', 'alice@example.com', '0712345678', 'Nairobi, Kenya'),
('Bob Smith', 'bob@example.com', '0723456789', 'Mombasa, Kenya'),
('Carol White', 'carol@example.com', '0734567890', 'Kisumu, Kenya'),
('David Brown', 'david@example.com', '0745678901', 'Nakuru, Kenya'),
('Emily Davis', 'emily@example.com', '0756789012', 'Eldoret, Kenya');

-- Categories
INSERT INTO Categories (name, description) VALUES
('Electronics', 'Phones, Laptops, Accessories'),
('Clothing', 'Men and Women Apparel'),
('Home Appliances', 'Kitchen and household appliances'),
('Books', 'Printed and eBooks'),
('Sports', 'Sporting goods and fitness equipment');

-- Products
INSERT INTO Products (name, description, price, category_id) VALUES
('iPhone 14', 'Latest Apple iPhone', 1200.00, 1),
('Laptop HP', 'High performance HP laptop', 800.00, 1),
('T-Shirt', 'Cotton T-Shirt', 20.00, 2),
('Blender', 'High-speed kitchen blender', 50.00, 3),
('Microwave Oven', '900W microwave oven', 150.00, 3),
('The Great Gatsby', 'Classic novel by F. Scott Fitzgerald', 10.00, 4),
('Basketball', 'Official size basketball', 25.00, 5),
('Running Shoes', 'Lightweight running shoes', 60.00, 5);

-- Orders
INSERT INTO Orders (customer_id, status) VALUES
(1, 'Completed'),
(2, 'Pending'),
(3, 'Completed'),
(4, 'Completed'),
(5, 'Pending');

-- Order Items
INSERT INTO Order_Items (order_id, product_id, quantity, price) VALUES
(1, 1, 1, 1200.00),
(1, 3, 2, 20.00),
(2, 2, 1, 800.00),
(3, 4, 1, 50.00),
(3, 5, 1, 150.00),
(4, 6, 3, 10.00),
(5, 8, 1, 60.00),
(5, 7, 2, 25.00);

-- Payments
INSERT INTO Payments (order_id, amount, payment_method) VALUES
(1, 1240.00, 'Credit Card'),
(3, 200.00, 'Mobile Money'),
(4, 30.00, 'Cash');
