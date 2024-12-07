-- Create the database and tables

CREATE DATABASE establishment_db;

USE establishment_db;

CREATE TABLE users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    phone_number VARCHAR(15),
    password VARCHAR(255) NOT NULL,
    role ENUM('customer', 'therapist', 'admin') NOT NULL DEFAULT 'customer',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE services (
    service_id INT PRIMARY KEY AUTO_INCREMENT,
    service_name VARCHAR(100) NOT NULL,
    description TEXT,
    duration INT,
    price DECIMAL(10,2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE appointments (
    appointment_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    therapist_id INT,
    service_id INT,
    appointment_date DATE,
    start_time TIME,
    end_time TIME,
    status ENUM('pending', 'confirmed', 'completed', 'canceled') DEFAULT 'pending',
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (therapist_id) REFERENCES users(user_id),
    FOREIGN KEY (service_id) REFERENCES services(service_id)
);

CREATE TABLE payments (
    payment_id INT PRIMARY KEY AUTO_INCREMENT,
    appointment_id INT,
    amount DECIMAL(10,2),
    payment_method ENUM('cash', 'credit_card', 'paypal'),
    payment_status ENUM('paid', 'unpaid', 'refunded'),
    transaction_id VARCHAR(100),
    payment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (appointment_id) REFERENCES appointments(appointment_id)
);

CREATE TABLE availability (
    availability_id INT PRIMARY KEY AUTO_INCREMENT,
    therapist_id INT,
    date DATE,
    start_time TIME,
    end_time TIME,
    FOREIGN KEY (therapist_id) REFERENCES users(user_id)
);

CREATE TABLE reviews (
    review_id INT PRIMARY KEY AUTO_INCREMENT,
    appointment_id INT,
    user_id INT,
    rating INT,
    comment TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (appointment_id) REFERENCES appointments(appointment_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

CREATE TABLE promotions (
    promo_id INT PRIMARY KEY AUTO_INCREMENT,
    promo_code VARCHAR(50),
    description TEXT,
    discount_percent DECIMAL(5,2),
    start_date DATE,
    end_date DATE
);


-- Create the initial data

USE establishment_db;

INSERT INTO users (full_name, email, phone_number, password, role, created_at)
VALUES
    ('Manager', 'manager@example.com', '09345678912', 'Admin_101', 'admin', '2024-11-18'),
    ('Adam Smith', 'adamsmith@example.com', '09234567891', 'Therapist_101', 'therapist', '2024-11-18'),
    ('Bob Smith', 'bobsmith@example.com', '09234567891', 'Therapist_101', 'therapist', '2024-11-18'),
    ('Alvaro Mauro', 'alvaromauro@example.com', '09234567891', 'Therapist_101', 'therapist', '2024-11-18'),
    ('Reno Sanchez', 'renosanchez@example.com', '09234567891', 'Therapist_101', 'therapist', '2024-11-18'),
    ('Eve Smith', 'evesmith@example.com', '09234567891', 'Therapist_101', 'therapist', '2024-11-18'),
    ('Alice Smith', 'alicesmith@example.com', '09234567891', 'Therapist_101', 'therapist', '2024-11-18'),
    ('Kaitlin Monceda', 'kaitlinmonceda@example.com', '09234567891', 'Therapist_101', 'therapist', '2024-11-18'),
    ('Leilani Rosario', 'leilanirosario@example.com', '09234567891', 'Therapist_101', 'therapist', '2024-11-18'),
    ('John Doe', 'johndoe@example.com', '09123456789', 'hashed_password', 'customer', '2024-11-18'),
    ('Jane Doe', 'janedoe@example.com', '09123456789', 'hashed_password', 'customer', '2024-11-18');

INSERT INTO services (service_name, description, duration, price, created_at)
VALUES
    ('Swedish Massage', 'A classic stress-relieving massage using smooth flowing techniques to promote improved circulation and relaxation.', 60, 450.00, '2024-11-18'),
    ('Sports Massage', 'Improve recovery and flexibility while reducing the risk of injuryies. This massage utilizes a mixture of techniques and myofscial release preparing the athlete for peak performance.', 60, 550.00, '2024-11-18'),
    ('Trigger Point Therapy', 'Release those bound up muscles that are causing pain or decreasing your range of motion. This specifically designed massage alleviates the source of the pain or limitation through cycles of isolated pressure and release.', 90, 600.00, '2024-11-18'),
    ('Deep Tissue Massage', 'Slow, deep pressure with skillful hand movements targeting stressed, overworked, and knotted muscles help unlock tension while relieveing pain. An ideal massage for the active individual.', 90, 650.00, '2024-11-18'),
    ("Chair Massage", "A quick and effective way to alleviate stress and boost energy. Our Chair Massage offers a targeted massage experience, perfect for busy individuals. Relax and rejuvenate in a comfortable seated position.", 90, 350.00, '2024-11-18'),
    ("Couple's Massage", "Indulge in ultimate relaxation with your loved one. Our Couple's Massage offers a serene and rejuvenating experience, tailored to your preferences. Unwind together and reconnect through the soothing touch of our expert therapists.", 90, 950.00, '2024-11-18');

INSERT INTO appointments (user_id, therapist_id, service_id, appointment_date, start_time, end_time, status)
VALUES
    (4, 2, 2, '2024-11-20', '09:30:00', '10:30:00', 'confirmed'),
    (4, 2, 2, '2024-11-29', '10:00:00', '11:00:00', 'pending'),
    (5, 3, 1, '2024-11-29', '10:00:00', '11:00:00', 'pending');

INSERT INTO payments (appointment_id, amount, payment_method, payment_status, transaction_id, payment_date)
VALUES
    (1, 550.00, 'cash', 'paid', '24NOV001', '2024-11-20');

INSERT INTO availability (therapist_id, date, start_time, end_time)
VALUES
    (2, '2024-11-26', '10:00:00', '17:00:00'),
    (2, '2024-11-27', '10:00:00', '17:00:00'),
    (2, '2024-11-28', '10:00:00', '17:00:00'),
    (2, '2024-11-29', '10:00:00', '17:00:00'),
    (2, '2024-11-30', '09:00:00', '17:00:00'),
    (2, '2024-12-01', '10:00:00', '17:00:00'),
    (2, '2024-12-02', '10:00:00', '17:00:00'),
    (2, '2024-12-03', '10:00:00', '17:00:00'),
    (2, '2024-12-04', '10:00:00', '17:00:00'),
    (2, '2024-12-05', '09:00:00', '17:00:00'),
    (2, '2024-12-06', '09:00:00', '17:00:00'),
    (2, '2024-12-07', '09:00:00', '17:00:00'),
    (2, '2024-12-08', '09:00:00', '17:00:00'),
    (2, '2024-12-09', '09:00:00', '17:00:00'),
    (2, '2024-12-10', '09:00:00', '17:00:00'),
    (2, '2024-12-11', '09:00:00', '17:00:00'),
    (2, '2024-12-12', '09:00:00', '17:00:00'),
    (2, '2024-12-13', '09:00:00', '17:00:00'),
    (2, '2024-12-14', '09:00:00', '17:00:00'),
    (2, '2024-12-15', '09:00:00', '17:00:00'),
    (2, '2024-12-16', '09:00:00', '17:00:00'),
    (2, '2024-12-17', '09:00:00', '17:00:00'),
    (2, '2024-12-18', '09:00:00', '17:00:00'),
    (3, '2024-11-26', '10:00:00', '17:00:00'),
    (3, '2024-11-27', '10:00:00', '17:00:00'),
    (3, '2024-11-28', '10:00:00', '17:00:00'),
    (3, '2024-11-29', '10:00:00', '17:00:00'),
    (3, '2024-11-30', '09:00:00', '17:00:00'),
    (3, '2024-12-01', '10:00:00', '17:00:00'),
    (3, '2024-12-02', '10:00:00', '17:00:00'),
    (3, '2024-12-03', '10:00:00', '17:00:00'),
    (3, '2024-12-04', '10:00:00', '17:00:00'),
    (3, '2024-12-05', '09:00:00', '17:00:00'),
    (3, '2024-12-06', '09:00:00', '17:00:00'),
    (3, '2024-12-07', '09:00:00', '17:00:00'),
    (3, '2024-12-08', '09:00:00', '17:00:00'),
    (3, '2024-12-09', '09:00:00', '17:00:00'),
    (3, '2024-12-10', '09:00:00', '17:00:00'),
    (3, '2024-12-11', '09:00:00', '17:00:00'),
    (3, '2024-12-12', '09:00:00', '17:00:00'),
    (3, '2024-12-13', '09:00:00', '17:00:00'),
    (3, '2024-12-14', '09:00:00', '17:00:00'),
    (3, '2024-12-15', '09:00:00', '17:00:00'),
    (3, '2024-12-16', '09:00:00', '17:00:00'),
    (3, '2024-12-17', '09:00:00', '17:00:00'),
    (3, '2024-12-18', '09:00:00', '17:00:00'),
    (4, '2024-11-26', '10:00:00', '17:00:00'),
    (4, '2024-11-27', '10:00:00', '17:00:00'),
    (4, '2024-11-28', '10:00:00', '17:00:00'),
    (4, '2024-11-29', '10:00:00', '17:00:00'),
    (4, '2024-11-30', '09:00:00', '17:00:00'),
    (4, '2024-12-01', '10:00:00', '17:00:00'),
    (4, '2024-12-02', '10:00:00', '17:00:00'),
    (4, '2024-12-03', '10:00:00', '17:00:00'),
    (4, '2024-12-04', '10:00:00', '17:00:00'),
    (4, '2024-12-05', '09:00:00', '17:00:00'),
    (4, '2024-12-06', '09:00:00', '17:00:00'),
    (4, '2024-12-07', '09:00:00', '17:00:00'),
    (4, '2024-12-08', '09:00:00', '17:00:00'),
    (4, '2024-12-09', '09:00:00', '17:00:00'),
    (4, '2024-12-10', '09:00:00', '17:00:00'),
    (4, '2024-12-11', '09:00:00', '17:00:00'),
    (4, '2024-12-12', '09:00:00', '17:00:00'),
    (4, '2024-12-13', '09:00:00', '17:00:00'),
    (4, '2024-12-14', '09:00:00', '17:00:00'),
    (4, '2024-12-15', '09:00:00', '17:00:00'),
    (4, '2024-12-16', '09:00:00', '17:00:00'),
    (4, '2024-12-17', '09:00:00', '17:00:00'),
    (4, '2024-12-18', '09:00:00', '17:00:00'),
    (5, '2024-11-26', '10:00:00', '17:00:00'),
    (5, '2024-11-27', '10:00:00', '17:00:00'),
    (5, '2024-11-28', '10:00:00', '17:00:00'),
    (5, '2024-11-29', '10:00:00', '17:00:00'),
    (5, '2024-11-30', '09:00:00', '17:00:00'),
    (5, '2024-12-01', '10:00:00', '17:00:00'),
    (5, '2024-12-02', '10:00:00', '17:00:00'),
    (5, '2024-12-03', '10:00:00', '17:00:00'),
    (5, '2024-12-04', '10:00:00', '17:00:00'),
    (5, '2024-12-05', '09:00:00', '17:00:00'),
    (5, '2024-12-06', '09:00:00', '17:00:00'),
    (5, '2024-12-07', '09:00:00', '17:00:00'),
    (5, '2024-12-08', '09:00:00', '17:00:00'),
    (5, '2024-12-09', '09:00:00', '17:00:00'),
    (5, '2024-12-10', '09:00:00', '17:00:00'),
    (5, '2024-12-11', '09:00:00', '17:00:00'),
    (5, '2024-12-12', '09:00:00', '17:00:00'),
    (5, '2024-12-13', '09:00:00', '17:00:00'),
    (5, '2024-12-14', '09:00:00', '17:00:00'),
    (5, '2024-12-15', '09:00:00', '17:00:00'),
    (5, '2024-12-16', '09:00:00', '17:00:00'),
    (5, '2024-12-17', '09:00:00', '17:00:00'),
    (5, '2024-12-18', '09:00:00', '17:00:00'),
    (6, '2024-11-26', '10:00:00', '17:00:00'),
    (6, '2024-11-27', '10:00:00', '17:00:00'),
    (6, '2024-11-28', '10:00:00', '17:00:00'),
    (6, '2024-11-29', '10:00:00', '17:00:00'),
    (6, '2024-11-30', '09:00:00', '17:00:00'),
    (6, '2024-12-01', '10:00:00', '17:00:00'),
    (6, '2024-12-02', '10:00:00', '17:00:00'),
    (6, '2024-12-03', '10:00:00', '17:00:00'),
    (6, '2024-12-04', '10:00:00', '17:00:00'),
    (6, '2024-12-05', '09:00:00', '17:00:00'),
    (6, '2024-12-06', '09:00:00', '17:00:00'),
    (6, '2024-12-07', '09:00:00', '17:00:00'),
    (6, '2024-12-08', '09:00:00', '17:00:00'),
    (6, '2024-12-09', '09:00:00', '17:00:00'),
    (6, '2024-12-10', '09:00:00', '17:00:00'),
    (6, '2024-12-11', '09:00:00', '17:00:00'),
    (6, '2024-12-12', '09:00:00', '17:00:00'),
    (6, '2024-12-13', '09:00:00', '17:00:00'),
    (6, '2024-12-14', '09:00:00', '17:00:00'),
    (6, '2024-12-15', '09:00:00', '17:00:00'),
    (6, '2024-12-16', '09:00:00', '17:00:00'),
    (6, '2024-12-17', '09:00:00', '17:00:00'),
    (6, '2024-12-18', '09:00:00', '17:00:00'),
    (7, '2024-11-26', '10:00:00', '17:00:00'),
    (7, '2024-11-27', '10:00:00', '17:00:00'),
    (7, '2024-11-28', '10:00:00', '17:00:00'),
    (7, '2024-11-29', '10:00:00', '17:00:00'),
    (7, '2024-11-30', '09:00:00', '17:00:00'),
    (7, '2024-12-01', '10:00:00', '17:00:00'),
    (7, '2024-12-02', '10:00:00', '17:00:00'),
    (7, '2024-12-03', '10:00:00', '17:00:00'),
    (7, '2024-12-04', '10:00:00', '17:00:00'),
    (7, '2024-12-05', '09:00:00', '17:00:00'),
    (7, '2024-12-06', '09:00:00', '17:00:00'),
    (7, '2024-12-07', '09:00:00', '17:00:00'),
    (7, '2024-12-08', '09:00:00', '17:00:00'),
    (7, '2024-12-09', '09:00:00', '17:00:00'),
    (7, '2024-12-10', '09:00:00', '17:00:00'),
    (7, '2024-12-11', '09:00:00', '17:00:00'),
    (7, '2024-12-12', '09:00:00', '17:00:00'),
    (7, '2024-12-13', '09:00:00', '17:00:00'),
    (7, '2024-12-14', '09:00:00', '17:00:00'),
    (7, '2024-12-15', '09:00:00', '17:00:00'),
    (7, '2024-12-16', '09:00:00', '17:00:00'),
    (7, '2024-12-17', '09:00:00', '17:00:00'),
    (7, '2024-12-18', '09:00:00', '17:00:00'),
    (8, '2024-11-26', '10:00:00', '17:00:00'),
    (8, '2024-11-27', '10:00:00', '17:00:00'),
    (8, '2024-11-28', '10:00:00', '17:00:00'),
    (8, '2024-11-29', '10:00:00', '17:00:00'),
    (8, '2024-11-30', '09:00:00', '17:00:00'),
    (8, '2024-12-01', '10:00:00', '17:00:00'),
    (8, '2024-12-02', '10:00:00', '17:00:00'),
    (8, '2024-12-03', '10:00:00', '17:00:00'),
    (8, '2024-12-04', '10:00:00', '17:00:00'),
    (8, '2024-12-05', '09:00:00', '17:00:00'),
    (8, '2024-12-06', '09:00:00', '17:00:00'),
    (8, '2024-12-07', '09:00:00', '17:00:00'),
    (8, '2024-12-08', '09:00:00', '17:00:00'),
    (8, '2024-12-09', '09:00:00', '17:00:00'),
    (8, '2024-12-10', '09:00:00', '17:00:00'),
    (8, '2024-12-11', '09:00:00', '17:00:00'),
    (8, '2024-12-12', '09:00:00', '17:00:00'),
    (8, '2024-12-13', '09:00:00', '17:00:00'),
    (8, '2024-12-14', '09:00:00', '17:00:00'),
    (8, '2024-12-15', '09:00:00', '17:00:00'),
    (8, '2024-12-16', '09:00:00', '17:00:00'),
    (8, '2024-12-17', '09:00:00', '17:00:00'),
    (8, '2024-12-18', '09:00:00', '17:00:00'),
    (9, '2024-11-26', '10:00:00', '17:00:00'),
    (9, '2024-11-27', '10:00:00', '17:00:00'),
    (9, '2024-11-28', '10:00:00', '17:00:00'),
    (9, '2024-11-29', '10:00:00', '17:00:00'),
    (9, '2024-11-30', '09:00:00', '17:00:00'),
    (9, '2024-12-01', '10:00:00', '17:00:00'),
    (9, '2024-12-02', '10:00:00', '17:00:00'),
    (9, '2024-12-03', '10:00:00', '17:00:00'),
    (9, '2024-12-04', '10:00:00', '17:00:00'),
    (9, '2024-12-05', '09:00:00', '17:00:00'),
    (9, '2024-12-06', '09:00:00', '17:00:00'),
    (9, '2024-12-07', '09:00:00', '17:00:00'),
    (9, '2024-12-08', '09:00:00', '17:00:00'),
    (9, '2024-12-09', '09:00:00', '17:00:00'),
    (9, '2024-12-10', '09:00:00', '17:00:00'),
    (9, '2024-12-11', '09:00:00', '17:00:00'),
    (9, '2024-12-12', '09:00:00', '17:00:00'),
    (9, '2024-12-13', '09:00:00', '17:00:00'),
    (9, '2024-12-14', '09:00:00', '17:00:00'),
    (9, '2024-12-15', '09:00:00', '17:00:00'),
    (9, '2024-12-16', '09:00:00', '17:00:00'),
    (9, '2024-12-17', '09:00:00', '17:00:00'),
    (9, '2024-12-18', '09:00:00', '17:00:00');

INSERT INTO reviews (appointment_id, user_id, rating, comment, created_at)
VALUES
    (1, 4, 5, 'Excellent service! Staff were all very friendly and accomodating. The place was very clean and tidy too.', '2024-11-21');

INSERT INTO promotions (promo_code, description, discount_percent, start_date, end_date)
VALUES
    ('OPENING2024', '15% off for establishment opening', 15.00, '2024-11-20', '2024-12-19'),
    ('WELCOME10', '10% off your first appointment', 10.00, '2024-12-20', '2025-12-20');