# 🛒 E-Commerce Store Database (MySQL/PostgreSQL)

## Overview
This project demonstrates **database design, normalization, and implementation** for a fictional e-commerce store.
It covers:
- **ERD Creation**
- **Normalization (1NF → 3NF)**
- **SQL Implementation**
- **Sample Data & Queries**

## 🗂 Database Structure
**Entities:**
- `Customers`
- `Products`
- `Orders`
- `Order_Items`
- `Payments`
- `Categories`

**ERD:**
![ERD Diagram](schema/erd.png)

## ⚙️ Features
- Fully normalized schema
- Proper constraints (PK, FK, UNIQUE, NOT NULL)
- Indexes for performance
- Sample queries for analytics

## 🛠 Setup
```bash
# Create Database
CREATE DATABASE ecommerce_db;

# Run schema
mysql -u root -p ecommerce_db < schema/create_tables.sql

# Insert sample data
mysql -u root -p ecommerce_db < schema/insert_sample_data.sql
