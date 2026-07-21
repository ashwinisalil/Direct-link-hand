-- =====================================================================
-- Direct Link Hands (Online Donation Management System)
-- Database Import File for MySQL / phpMyAdmin (XAMPP)
-- =====================================================================

CREATE DATABASE IF NOT EXISTS directlinkhands
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE directlinkhands;

SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- 1. categories  (created first since organizations references it)
-- ---------------------------------------------------------------------
DROP TABLE IF EXISTS categories;
CREATE TABLE categories (
    category_id   INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(100) NOT NULL,
    description   TEXT
) ENGINE=InnoDB;

INSERT INTO categories (category_name, description) VALUES
('Education', 'Support for schools, scholarships, and learning materials'),
('Healthcare', 'Medical treatment and hospital support'),
('Orphanage', 'Care and support for orphaned children'),
('Animal Welfare', 'Protection and care of animals'),
('Disaster Relief', 'Emergency aid during natural disasters'),
('Medical Aid', 'Medicines and medical equipment support');

-- ---------------------------------------------------------------------
-- 2. users
-- ---------------------------------------------------------------------
DROP TABLE IF EXISTS users;
CREATE TABLE users (
    user_id     INT AUTO_INCREMENT PRIMARY KEY,
    full_name   VARCHAR(100) NOT NULL,
    email       VARCHAR(100) NOT NULL UNIQUE,
    phone       VARCHAR(15),
    password    VARCHAR(255) NOT NULL,
    gender      VARCHAR(10),
    address     TEXT,
    city        VARCHAR(50),
    state       VARCHAR(50),
    pincode     VARCHAR(10),
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- 3. admin
-- ---------------------------------------------------------------------
DROP TABLE IF EXISTS admin;
CREATE TABLE admin (
    admin_id    INT AUTO_INCREMENT PRIMARY KEY,
    username    VARCHAR(50) NOT NULL UNIQUE,
    email       VARCHAR(100) NOT NULL UNIQUE,
    password    VARCHAR(255) NOT NULL,
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Default admin login (username: admin / password: admin123 -- CHANGE THIS)
INSERT INTO admin (username, email, password) VALUES
('admin', 'admin@directlinkhands.com', '$2y$10$abcdefghijklmnopqrstuv');
-- NOTE: replace the password hash above with a real password_hash() output before going live.

-- ---------------------------------------------------------------------
-- 4. organizations
-- ---------------------------------------------------------------------
DROP TABLE IF EXISTS organizations;
CREATE TABLE organizations (
    org_id             INT AUTO_INCREMENT PRIMARY KEY,
    organization_name  VARCHAR(150) NOT NULL,
    category_id        INT,
    email              VARCHAR(100) NOT NULL UNIQUE,
    password           VARCHAR(255) NOT NULL,
    phone              VARCHAR(15),
    address            TEXT,
    city               VARCHAR(50),
    state              VARCHAR(50),
    pincode            VARCHAR(10),
    description        TEXT,
    bank_name          VARCHAR(100),
    account_number     VARCHAR(30),
    ifsc_code          VARCHAR(20),
    account_holder     VARCHAR(100),
    status             ENUM('Pending','Approved','Rejected') DEFAULT 'Pending',
    created_at         TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_org_category
        FOREIGN KEY (category_id) REFERENCES categories(category_id)
        ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- 5. organization_documents
-- ---------------------------------------------------------------------
DROP TABLE IF EXISTS organization_documents;
CREATE TABLE organization_documents (
    document_id               INT AUTO_INCREMENT PRIMARY KEY,
    org_id                     INT NOT NULL,
    registration_certificate   VARCHAR(255),
    pan_card                   VARCHAR(255),
    government_certificate     VARCHAR(255),
    uploaded_at                TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_docs_org
        FOREIGN KEY (org_id) REFERENCES organizations(org_id)
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- 6. donations
-- ---------------------------------------------------------------------
DROP TABLE IF EXISTS donations;
CREATE TABLE donations (
    donation_id     INT AUTO_INCREMENT PRIMARY KEY,
    user_id         INT NOT NULL,
    org_id          INT NOT NULL,
    amount          DECIMAL(10,2) NOT NULL,
    payment_id      VARCHAR(100),
    payment_method  VARCHAR(50),
    payment_status  VARCHAR(30) DEFAULT 'Pending',
    donation_date   DATETIME DEFAULT CURRENT_TIMESTAMP,
    receipt_number  VARCHAR(50),
    CONSTRAINT fk_donation_user
        FOREIGN KEY (user_id) REFERENCES users(user_id)
        ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_donation_org
        FOREIGN KEY (org_id) REFERENCES organizations(org_id)
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- 7. payment_transactions
-- ---------------------------------------------------------------------
DROP TABLE IF EXISTS payment_transactions;
CREATE TABLE payment_transactions (
    transaction_id          INT AUTO_INCREMENT PRIMARY KEY,
    donation_id             INT NOT NULL,
    payment_gateway         VARCHAR(50),
    transaction_reference   VARCHAR(100),
    amount                  DECIMAL(10,2) NOT NULL,
    transaction_status      VARCHAR(30) DEFAULT 'Pending',
    transaction_date        DATETIME DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_transaction_donation
        FOREIGN KEY (donation_id) REFERENCES donations(donation_id)
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- 8. contacts
-- ---------------------------------------------------------------------
DROP TABLE IF EXISTS contacts;
CREATE TABLE contacts (
    contact_id    INT AUTO_INCREMENT PRIMARY KEY,
    name          VARCHAR(100) NOT NULL,
    email         VARCHAR(100) NOT NULL,
    subject       VARCHAR(150),
    message       TEXT,
    submitted_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

SET FOREIGN_KEY_CHECKS = 1;

-- =====================================================================
-- End of file
-- =====================================================================
