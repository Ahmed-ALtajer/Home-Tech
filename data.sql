
drop database Hstore;
CREATE DATABASE Hstore;
USE Hstore;

CREATE TABLE `User` (
    UserID INT AUTO_INCREMENT PRIMARY KEY,
    Username VARCHAR(255) NOT NULL,
    Email VARCHAR(255) UNIQUE NOT NULL,
    Password VARCHAR(255) NOT NULL,
    Mobile VARCHAR(20),
    Address TEXT
);

CREATE TABLE Admin (
    AdminID INT AUTO_INCREMENT PRIMARY KEY,
    Username VARCHAR(255) NOT NULL,
    Email VARCHAR(255) UNIQUE NOT NULL,
    Password VARCHAR(255) NOT NULL
);

CREATE TABLE Category (
    CategoryID INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(255) NOT NULL,
    Description TEXT
);

CREATE TABLE Product (
    ProductID INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(255) NOT NULL,
    Price DECIMAL(10, 2) NOT NULL,
    OriginalPrice DECIMAL(10, 2) NOT NULL,
    Discount INT,
    Picture VARCHAR(45),
    CategoryID INT,
    Stock INT NOT NULL,
    Description TEXT,
    FOREIGN KEY (CategoryID) REFERENCES Category(CategoryID)
);


CREATE TABLE Cart (
    CartID INT AUTO_INCREMENT PRIMARY KEY,
    UserID INT,
    FOREIGN KEY (UserID) REFERENCES `User`(UserID)
);

CREATE TABLE CartItem (
    CartItemID INT AUTO_INCREMENT PRIMARY KEY,
    CartID INT,
    ProductID INT,
    Quantity INT NOT NULL,
    FOREIGN KEY (CartID) REFERENCES Cart(CartID),
    FOREIGN KEY (ProductID) REFERENCES Product(ProductID)
);

CREATE TABLE Discount (
    DiscountID INT AUTO_INCREMENT PRIMARY KEY,
    ProductID INT,
    PercentageOff DECIMAL(5, 2) NOT NULL,
    ValidFrom DATE,
    ValidTo DATE,
    Price DECIMAL(10, 2),
    FOREIGN KEY (ProductID) REFERENCES Product(ProductID)
);

CREATE TABLE Checkout (
    CheckoutID INT AUTO_INCREMENT PRIMARY KEY,
    CartID INT,
    TotalPrice DECIMAL(10, 2) NOT NULL,
    CheckoutDate DATE NOT NULL,
    FOREIGN KEY (CartID) REFERENCES Cart(CartID)
);

CREATE TABLE `Order` (
    OrderID INT AUTO_INCREMENT PRIMARY KEY,
    CartID INT,
    TotalPrice DECIMAL(10, 2) NOT NULL,
    CheckoutDate DATE NOT NULL,
    FOREIGN KEY (CartID) REFERENCES Cart(CartID)
);
