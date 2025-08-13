# 🛒 Database Design & Normalization – E-Commerce Example

This repository demonstrates the process of designing, normalizing, and implementing an **e-commerce database** with a **PHP + Chart.js** admin dashboard. It includes SQL scripts, sample data, and example analytics queries to showcase **database administration** skills.

[![GitHub License](https://img.shields.io/badge/license-GNU%20GPL%20v3.0-green)](LICENSE)
[![PHP](https://img.shields.io/badge/Backend-PHP-blue)](#)
[![MySQL](https://img.shields.io/badge/Database-MySQL-orange)](#)
[![Chart.js](https://img.shields.io/badge/Charts-Chart.js-yellow)](https://www.chartjs.org/)

---

## 📁 File Structure

```

Database-Design-Normalization/
│
├── assets/
│   ├── chart.js                # Chart.js library
│   ├── style.css               # Dashboard styles
│   └── ERD.png                 # Entity-Relationship Diagram
│
├── LICENSE                     # GNU GPL v3.0 License
├── README.md                   # Project documentation
├── admin.php                   # Admin dashboard with data visualization
├── config.php                  # Database connection settings
├── ecommerce\_db.sql           # Full normalized database schema
├── index.php                   # Landing page
├── insert\_sample\_data.sql    # Sample dataset for testing
├── order\_details.php          # View specific order details
├── orders.php                  # List of all orders
└── sample\_queries.sql         # Example analytics queries

````

---

## 📚 Features

- **3NF Normalized Database** for e-commerce
- **Entity-Relationship Diagram (ERD)**
- **Pre-loaded Sample Data**
- **PHP Admin Dashboard**
- **Interactive Visualizations** using Chart.js
- **Common Analytics Queries**, including:
  - Top-selling products
  - Revenue per category
  - Stock level alerts
  - Customer purchase history

---

## 🛠️ Setup Instructions

### 1️⃣ Clone the Repository
```bash
git clone https://github.com/YOUR_USERNAME/Database-Design-Normalization.git
cd Database-Design-Normalization
````

### 2️⃣ Create the Database

1. Open MySQL (CLI, phpMyAdmin, or Workbench).
2. Run:

```sql
SOURCE ecommerce_db.sql;
SOURCE insert_sample_data.sql;
```

### 3️⃣ Configure Database Connection

Edit **config.php** and set your DB credentials:

```php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "ecommerce_db";
```

### 4️⃣ Run Locally

From the project root:

```bash
php -S localhost:8000
```

Open: [http://localhost:8000/admin.php](http://localhost:8000/admin.php)

---

## 📊 Example Queries

### Top 5 Selling Products

```sql
SELECT p.product_name, SUM(oi.quantity) AS total_sold
FROM order_items oi
JOIN products p ON oi.product_id = p.product_id
GROUP BY p.product_name
ORDER BY total_sold DESC
LIMIT 5;
```

### Revenue Per Category

```sql
SELECT c.category_name, SUM(oi.quantity * oi.price) AS revenue
FROM order_items oi
JOIN products p ON oi.product_id = p.product_id
JOIN categories c ON p.category_id = c.category_id
GROUP BY c.category_name;
```

---

## 📜 License

This project is licensed under the **GNU General Public License v3.0**.
You may freely use, modify, and distribute it under the same license.
See the [LICENSE](LICENSE) file for details.

---

## 📌 Notes

* Make sure **MySQL** and **PHP** are installed locally.
* Chart.js is included locally in `assets/chart.js` for offline use.
* The ERD is available in `assets/ERD.png`.

---
