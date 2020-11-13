
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
    quantity int NOT null,
    FOREIGN KEY (color) REFERENCES Color (colorID)
);

insert into Product (`name`, price, `image`, `description`, color, quantity) values ('Ducky', 99, 'img/duck.png', 'This is a yellow duck', 1, 10);
insert into Product (`name`, price, `image`, `description`, color, quantity) values ('Blue Ducky', 199, 'img/bducky.png', 'This is magical blue duck', 2, 50);
insert into Product (`name`, price, `image`, `description`, color, quantity) values ('Black Duck', 50, 'img/ducky.png', 'Said to bring misfortune to those who see it cross the road', 4, 20);

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
    startTime DECIMAL(4,2) NOT NULL,
    endtime DECIMAL(4,2) NOT Null
);

CREATE TABLE News
(
    newsID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    title varchar(100) NOT NULL,
    `description` varchar(10000) NOT NULL,
    `date` date NOT NULL
);

CREATE TABLE DailySpecial
(
    dailyID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    discount int NOT NULL
);

CREATE TABLE SpecialNews
(
    daily int NOT NULL,
    news int NOT NULL,
    CONSTRAINT PK_ProductCategory PRIMARY KEY (daily, news),  
    FOREIGN KEY (daily) REFERENCES DailySpecial (dailyID),
    FOREIGN KEY (news) REFERENCES News (newsID) 
);

CREATE TABLE Offer
(
    offer int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    productID int NOT NULL,
    dailyID int NOT NULL,
    FOREIGN KEY (productID) REFERENCES Product (ProductID),
    FOREIGN KEY (dailyID) REFERENCES DailySpecial (dailyID)
);
