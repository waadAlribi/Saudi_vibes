CREATE DATABASE IF NOT EXISTS saudi_vibes;
USE saudi_vibes;

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(120) NOT NULL,
  email VARCHAR(190) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  created_at DATETIME NOT NULL
);

CREATE TABLE IF NOT EXISTS achievements (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(200) NOT NULL,
  category VARCHAR(80) NOT NULL,
  short_description VARCHAR(500) NOT NULL,
  image_path VARCHAR(255) NOT NULL,
  created_at DATETIME NOT NULL
);

INSERT INTO achievements (title, category, short_description, image_path, created_at) VALUES
('NEOM – The Line', 'giga-project', 'A futuristic linear city redefining urban life.', 'images/neom.jpg', NOW()),
('Red Sea Project', 'tourism', 'A luxury tourism destination on the west coast of Saudi Arabia.', 'images/red-sea.jpg', NOW()),
('Qiddiya Entertainment City', 'entertainment', 'A mega entertainment, sports, and cultural destination near Riyadh.', 'images/qiddiya.jpg', NOW()),
('Diriyah Gate', 'heritage', 'A cultural and lifestyle destination rooted in Saudi heritage.', 'images/diriyah-gate.jpg', NOW());
