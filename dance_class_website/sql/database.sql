-- Create Database
CREATE DATABASE dance_class;
USE dance_class;

-- Users Table (Stores user & admin information)
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Feedback Table (Stores user feedback)
CREATE TABLE feedback (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Packages Table (Stores dance class packages)
CREATE TABLE packages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert Admin User (Default admin login)
INSERT INTO users (name, email, password, role) 
VALUES ('Admin', 'admin@example.com', MD5('admin123'), 'admin');

-- Insert Sample Packages
INSERT INTO packages (name, description, price) VALUES
('Beginner Dance', 'Perfect for beginners learning the basics.', 50.00),
('Intermediate Dance', 'For dancers with basic experience.', 75.00),
('Advanced Dance', 'Challenging routines for professionals.', 100.00);
