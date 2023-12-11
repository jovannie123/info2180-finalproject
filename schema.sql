CREATE DATABASE IF NOT EXISTS dolphin_crm;

USE dolphin_crm;

CREATE TABLE IF NOT EXISTS Users(
    id int NOT NULL AUTO_INCREMENT,
    firstname varchar(255),
    lastname varchar(255),
    password varchar(255),
    email varchar(255),
    role varchar(255),
    created_at datetime,
    PRIMARY KEY(id)
);

INSERT INTO Users(firstname,lastname,password,email,role,created_at)
VALUES
('admin','admin',PASSWORD('password123'),'admin@project2.com','admin',NOW()),
('Alice', 'Smith', PASSWORD('hashed_password2'), 'alice@example.com', 'admin', NOW()),
('Bob', 'Johnson', PASSWORD('hashed_password3'), 'bob@example.com', 'admin', NOW()),
('Emily', 'Davis', PASSWORD('hashed_password4'), 'emily@example.com', 'admin', NOW()),
('Charlie', 'Brown', PASSWORD('hashed_password5'), 'charlie@example.com', 'user', NOW()),
('Eva', 'Williams', PASSWORD('hashed_password6'), 'eva@example.com', 'user', NOW()),
('David', 'Clark', PASSWORD('hashed_password7'), 'david@example.com', 'user', NOW()),
('Sophia', 'Anderson', PASSWORD('hashed_password8'), 'sophia@example.com', 'user', NOW()),
('Michael', 'Martin', PASSWORD('hashed_password9'), 'michael@example.com', 'user', NOW()),
('Olivia', 'Moore', PASSWORD('hashed_password10'), 'olivia@example.com', 'user', NOW());


CREATE TABLE IF NOT EXISTS Contacts(
    id int NOT NULL AUTO_INCREMENT,
    title varchar(255),
    firstname varchar(255),
    lastname varchar(255),
    email varchar(255),
    telephone varchar(255),
    company varchar(255),
    type varchar(255),
    assigned_to int,
    created_by int,
    created_at datetime,
    updated_at datetime,
    PRIMARY KEY (id),
    FOREIGN KEY(assigned_to) REFERENCES Users(id)
);

INSERT INTO Contacts (title, firstname, lastname, email, telephone, company, type, assigned_to, created_by, created_at, updated_at)
VALUES 
('Mr.', 'Tom', 'Smith', 'tom.smith@example.com', '123-456-7890', 'ABC Corp', 'Sales Lead', 1, 1, NOW(), NOW()),
('Mrs.', 'Chris', 'Johnson', 'chris.johnson@example.com', '987-654-3210', 'XYZ Ltd', 'Support', 2, 2, NOW(), NOW()),
('Dr.', 'Emma', 'White', 'emma.white@example.com', '555-123-4567', 'Medical Clinic', 'Sales Lead', 3, 3, NOW(), NOW()),
('Mr.', 'Sophie', 'Davis', 'sophie.davis@example.com', '111-222-3333', 'Tech Solutions', 'Support', 4, 4, NOW(), NOW()),
('Ms.', 'Ryan', 'Clark', 'ryan.clark@example.com', '444-555-6666', 'Marketing Agency', 'Sales Lead', 1, 1, NOW(), NOW()),
('Dr.', 'Avery', 'Williams', 'avery.williams@example.com', '777-888-9999', 'Healthcare Ltd', 'Support', 2, 2, NOW(), NOW()),
('Mrs.', 'Alex', 'Brown', 'alex.brown@example.com', '222-333-4444', 'Education Center', 'Sales Lead', 3, 3, NOW(), NOW()),
('Mr.', 'Jordan', 'Anderson', 'jordan.anderson@example.com', '999-888-7777', 'Financial Corp', 'Support', 4, 4, NOW(), NOW()),
('Ms.', 'Taylor', 'Martin', 'taylor.martin@example.com', '666-555-4444', 'Consulting Ltd', 'Sales Lead', 1, 1, NOW(), NOW()),
('Dr.', 'Casey', 'Moore', 'casey.moore@example.com', '333-444-5555', 'Software Company', 'Support', 2, 2, NOW(), NOW());

CREATE TABLE Notes(
    id int NOT NULL AUTO_INCREMENT,
    contact_id int,
    comment text,
    created_by int,
    created_at datetime,
    PRIMARY KEY(id),
    FOREIGN KEY(contact_id) REFERENCES Contacts(id),
    FOREIGN KEY(created_by) REFERENCES Users(id)
);

INSERT INTO Notes (contact_id, comment, created_by, created_at)
VALUES 
(1, 'This is a note about Tom Smith.', 1, NOW()),
(2, 'Note about Chris Johnson.', 2, NOW()),
(3, 'Important information about Emma White.', 3, NOW()),
(4, 'Discussion points about Sophie Davis.', 4, NOW()),
(5, 'Feedback about Ryan Clark.', 5, NOW());

