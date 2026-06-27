CREATE DATABASE IF NOT EXISTS `kelas-a_Coffe_Drip` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `kelas-a_Coffe_Drip`;

-- Menu items table
CREATE TABLE menu_items (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    category ENUM('kopi', 'non-kopi', 'makanan', 'dessert') NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    description TEXT,
    image_url VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

-- Users table
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'kasir', 'user') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

-- Orders table
CREATE TABLE orders (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NULL,
    queue_number VARCHAR(20) NOT NULL UNIQUE,
    table_number VARCHAR(10) NOT NULL,
    subtotal DECIMAL(10,2) NOT NULL,
    tax DECIMAL(10,2) NOT NULL,
    total DECIMAL(10,2) NOT NULL,
    payment_method ENUM('qris', 'transfer', 'cash') NOT NULL,
    status ENUM('pending', 'processing', 'completed') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

-- Order items table
CREATE TABLE order_items (
    id INT PRIMARY KEY AUTO_INCREMENT,
    order_id INT NOT NULL,
    menu_id INT NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (menu_id) REFERENCES menu_items(id)
) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

-- Transactions table
CREATE TABLE transactions (
    id INT PRIMARY KEY AUTO_INCREMENT,
    order_id INT NOT NULL,
    kasir_id INT,
    total DECIMAL(10,2) NOT NULL,
    payment_method VARCHAR(50) NOT NULL,
    status VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (kasir_id) REFERENCES users(id) ON DELETE SET NULL
) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

-- Insert sample admin
INSERT INTO users (name, email, password, role) VALUES
('Admin Coffee', 'admin@drip.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin'),
('Kasir Coffee', 'kasir@drip.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'kasir');


-- Insert sample menu items
INSERT INTO menu_items (name, category, price, description) VALUES
('Americano', 'kopi', 28000, 'espresso + air panas. simple, bold.'),
('Cappuccino', 'kopi', 35000, 'espresso + steamed milk + foam tebal.'),
('Kopi Susu Gula Aren', 'kopi', 32000, 'kopi susu dengan gula aren asli.'),
('V60 Pour Over', 'kopi', 42000, 'manual brew, karakter kopi beda level.'),
('Cold Brew', 'kopi', 38000, '16 jam steep, smooth banget.'),
('Matcha Latte', 'non-kopi', 35000, 'matcha grade A + oat milk.'),
('Teh Tarik', 'non-kopi', 22000, 'teh susu kental, panas atau dingin.'),
('Mojito Virgin', 'non-kopi', 28000, 'mint + lime + soda. seger banget.'),
('Avocado Toast', 'makanan', 35000, 'sourdough + alpukat + telur setengah matang.'),
('Croissant', 'makanan', 28000, 'butter croissant fresh baked.'),
('Nasi Goreng Barista', 'makanan', 42000, 'nasi goreng spesial + telor mata sapi.'),
('Cheesecake', 'dessert', 32000, 'new york style, creamy + dense.'),
('Tiramisu', 'dessert', 35000, 'classic italian, pakai espresso shot.'),
('Brownies', 'dessert', 25000, 'fudgy, dark chocolate. adiktif.'),
('Flat White', 'kopi', 36000, 'ristretto + velvet milk. intensitas tinggi.'),
('Lychee Tea', 'non-kopi', 26000, 'teh bunga + lychee segar.');
