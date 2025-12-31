-- 1. Create the database
CREATE DATABASE IF NOT EXISTS kickvibe;
USE kickvibe;

-- 2. Users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    address VARCHAR(255)
);

-- 3. Products table
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    category VARCHAR(50),
    color VARCHAR(20),
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    material VARCHAR(50),
    weight VARCHAR(20),
    cushioning VARCHAR(50),
    best_for VARCHAR(50)
);

-- 4. Orders table
CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    order_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    total DECIMAL(10,2) NOT NULL,
    status INT DEFAULT 0, -- 0: Processing, 1: Shipped, 2: Out for Delivery, 3: Delivered
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- 5. Order items table
CREATE TABLE IF NOT EXISTS order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT DEFAULT 1,
    price DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

-- 6. Optional: Insert demo products
INSERT INTO products (name, category, color, description, price, material, weight, cushioning, best_for)
VALUES
('Urban Flow X1', 'Street', '#ccff00', 'Designed for the city dweller.', 89.00, 'Breathable Mesh', '280g', 'Medium', 'Daily Wear'),
('Night Runner', 'Sport', '#00f0ff', 'Reflective materials for night runs.', 120.00, 'Reflective Knit', '240g', 'High (Foam)', 'Running'),
('Canvas Classic', 'Casual', '#ff4444', 'Timeless design, modern comfort.', 55.00, 'Canvas', '320g', 'Low', 'Casual'),
('Stealth High', 'High-Top', '#333333', 'Ankle support with a minimalist look.', 110.00, 'Leather/Suede', '410g', 'Medium', 'Lifestyle'),
('Aero Glide', 'Sport', '#ffffff', 'Air-cushioned sole technology.', 145.00, 'Performance Mesh', '260g', 'Max Air', 'Sports'),
('Retro Wave', 'Casual', '#ff00cc', '80s inspired aesthetics.', 75.00, 'Synthetic Leather', '350g', 'Low', 'Vintage Style');
