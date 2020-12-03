-- DROP DATABASE IF EXISTS RubberDuckDB;
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
    details varchar(60000) NULL,
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
    phonenumber varchar(100) NOT NULL,
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
    quantity INT NOT NULL,
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
  `ID` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `price` double(10,2) NOT NULL,
  `color` int NOT null,
  `desc` varchar(255),
  `quantity` int NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `product_code` (`code`),
  FOREIGN KEY (color) REFERENCES Color (ColorID)
);

ALTER TABLE Orderline
ADD FOREIGN KEY (product) REFERENCES Product (ID);

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
    FOREIGN KEY (product) REFERENCES Product (ID),
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
    FOREIGN KEY (productID) REFERENCES Product (ID),
    FOREIGN KEY (dailyID) REFERENCES DailySpecial (dailyID)
);

insert into Product (`code`,`name`, `price`, `image`, `color`, `desc`, `quantity`) values ('D0001','Ducky', 99, 'img/duck.png', 1, 'test 1', 100);
insert into Product (`code`,`name`, `price`, `image`, `color`, `desc`, `quantity`) values ('D0002','Blue Ducky', 199, 'img/bducky.png', 2, 'test 2', 100);
insert into Product (`code`,`name`, `price`, `image`, `color`, `desc`, `quantity`) values ('D0003','Black Duck', 50, 'img/ducky.png', 4, 'test 3', 100);


CREATE VIEW NewsAndSpecialData AS
SELECT n.newsID, n.title, n.description, n.date, ds.dailyID, ds.discount, o.productID
FROM News n, SpecialNews sn, DailySpecial ds, Offer o
WHERE n.newsID = sn.news
AND sn.daily = ds.dailyID
AND o.dailyID = ds.dailyID

CREATE VIEW InvoiceOrderData AS SELECT o.orderID, o.date, ol.product, ol.quantity, p.name, p.price, o.invoice, o.numberOfProducts,
c.customerID, c.fname, c.lname, c.phonenumber, c.address, c.postalID, c.email, pc.zipcodeID, pc.City
FROM `Order` o, Orderline ol, Product p, Customer c, PostalCode pc
WHERE o.orderID = ol.order
AND ol.product = p.ID
AND c.postalID = pc.zipcodeID
AND o.customer = c.customerID

DELIMITER //
Create Trigger after_insert_Orderline AFTER INSERT ON Orderline FOR EACH ROW
BEGIN
UPDATE Product pt
SET pt.quantity = pt.quantity - NEW.quantity
WHERE pt.ID = NEW.product;
END //
DELIMITER ;
