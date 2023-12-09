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

