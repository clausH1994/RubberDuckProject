
DROP DATABASE IF EXISTS RubberDuckDB;
CREATE DATABASE RubberDuckDB;
USE RubberDuckDB;

CREATE TABLE Employee (
    employeeID int AUTO_INCREMENT NOT NULL PRIMARY KEY,
    fname varchar(100) NOT NULL,
    lname varchar(100) NOT NULL,
    email varchar(100) NOT NULL,
    pass varchar(255)  NOT NULL
);



CREATE TABLE Invoice (
    invoiceID int AUTO_INCREMENT NOT NULL PRIMARY KEY,
    `date` date NOT NULL,
    details varchar(60000) NULl,
    `status` boolean NOT NULL
);

--

CREATE TABLE PostalCode (
    zipcodeID int NOT NULL PRIMARY KEY,
    City varchar(255) NOT NULL  
);

CREATE TABLE Customer (
    customerID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    fname varchar(100) NOT NULL,
    lname varchar(100)  NOT NULL,
    pass varchar(255) NOT NULL,
    phonenumber int NOT NULL,
    email varchar(100) NOT NULL,
    `address` varchar(100) NOT NULL, 
    postalID int NOT NULL,
    FOREIGN KEY (postalID) REFERENCES PostalCode (zipcodeID)
);


CREATE TABLE `Order` (
    orderID int NOT NULL AUTO_INCREMENT PRIMARY KEY,  
    `date` date NOT NULL,
    numberOfProducts int NOT NULL,
    customer int NOT NULL,
    invoice int NOT NULL,
    FOREIGN KEY (customer) REFERENCES Customer (customerID),
    FOREIGN KEY (invoice) REFERENCES Invoice (InvoiceID)  
);

CREATE TABLE Orderline
(
    orderlineID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    price DECIMAL(5, 2) NOT NULL,
    quanity INT NOT NULL,
    `order` INT NOT NULL,
    product INT NOT NULL,
    FOREIGN KEY (`order`) REFERENCES `Order` (orderID)
);

CREATE TABLE Color
(
    colorID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` varchar(100) NOT NULL
);

insert into Color (ColorID, `name`) values (null, 'yellow');
insert into Color (ColorID, `name`) values (null, 'blue');
insert into Color (ColorID, `name`) values (null, 'pink');
insert into Color (ColorID, `name`) values (null, 'black');

CREATE TABLE Product
(
    productID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` varchar(255) NOT NULL,
    price DECIMAL(5, 2) NOT NULL,
    `image` varchar(255),
    `description` varchar(60000),
    color int NOT NULL,
    FOREIGN KEY (color) REFERENCES Color (colorID)
);

ALTER TABLE Orderline
ADD FOREIGN KEY (product) REFERENCES Product (productID);

CREATE TABLE Category
(
    categoryID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` varchar(100)
);

CREATE TABLE ProductCategory
(
    product int NOT NULL,
    category int NOT NULL,
    CONSTRAINT PK_ProductCategory PRIMARY KEY (product, category),  
    FOREIGN KEY (product) REFERENCES Product (productID),
    FOREIGN KEY (category) REFERENCES Category (categoryID)  
);



CREATE TABLE Company
(
    companyID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` varchar(100) NOT NULL, 
    `address` varchar(200) NOT NULL,
    postalID int NOT NULL,
    phone int NOT NULL,
    email varchar(255) NOT NULL,
    `description` varchar(10000) NOT NULL,
    FOREIGN KEY (postalID) REFERENCES PostalCode (zipcodeID)
);


CREATE TABLE OpeningHours
(
    openinghoursID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `day` varchar(50) NOT NULL,
    startTime float NOT NULL,
    endtime float NOT Null,
    company int NOT NULL,
    FOREIGN KEY (company) REFERENCES Company (companyID)
)

