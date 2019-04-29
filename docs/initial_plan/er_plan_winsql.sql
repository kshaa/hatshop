/* ER model planning */

CREATE TABLE Roles (
    ID INT NOT NULL IDENTITY PRIMARY KEY,
    Name VARCHAR(255) /* Admin, User */,
    Comment VARCHAR(255)
);

CREATE TABLE Users (
    ID INT IDENTITY PRIMARY KEY,
    Email VARCHAR(255),
    Name VARCHAR(255),
    Surname VARCHAR(255),
    Info VARCHAR(255),
    Yarn Int /* Money */
);

CREATE TABLE UserRoles (
    ID INT IDENTITY PRIMARY KEY,
    UserID INT,
    RoleID INT
)

ALTER TABLE UserRoles
ADD FOREIGN KEY (UserId) REFERENCES Users(ID);

ALTER TABLE UserRoles
ADD FOREIGN KEY (RoleId) REFERENCES Roles(ID);

/**
 * Upload STL files
 * Or link to Thingiverse w/ STL file https://www.thingiverse.com/thing:14698
 * Thingiverse API - https://www.thingiverse.com/developers/rest-api-reference
 * Max file path ~ 4096 https://stackoverflow.com/questions/9449241/where-is-path-max-defined-in-linux
 */
CREATE TABLE Hats (
    ID INT IDENTITY PRIMARY KEY,
    Code VARCHAR(255),
    Label VARCHAR(255) NOT NULL,
    Status VARCHAR(255) NOT NULL /* ["Approved", "Unapproved"] */,
    Description VARCHAR(255),

    Location VARCHAR(255) /* ["Factory", "Market", "Storage"] */,
    Quantity INT,
    Model VARCHAR(4096) /* Path to image file */,
    OwnerID INT
);

ALTER TABLE Hats
ADD FOREIGN KEY (OwnerID) REFERENCES Users(ID);

CREATE TABLE Charms (
    ID INT IDENTITY PRIMARY KEY,
    Code VARCHAR(255) NOT NULL,
    Label VARCHAR(255) NOT NULL,
    Status VARCHAR(255) /* ["Approved", "Unapproved"] */,
    Description VARCHAR(255)
);

CREATE TABLE HatCharms (
    ID INT IDENTITY PRIMARY KEY,
    HatID INT,
    CharmID INT
);

ALTER TABLE HatCharms
ADD FOREIGN KEY (HatID) REFERENCES Hats(ID);

ALTER TABLE HatCharms
ADD FOREIGN KEY (CharmID) REFERENCES Charms(ID);


CREATE TABLE Trade (
    ID INT IDENTITY PRIMARY KEY,
    HatID INT,
    Quantity INT,
    Yarn INT /* Price */
);

ALTER TABLE Trade
ADD FOREIGN KEY (HatID) REFERENCES Hats(ID);

CREATE TABLE Transactions (
    ID INT IDENTITY PRIMARY KEY,
    HatID INT,
    SellerID INT,    
    BuyerID INT,  
    Yarn INT 
);

ALTER TABLE Transactions
ADD FOREIGN KEY (HatID) REFERENCES Hats(ID);

ALTER TABLE Transactions
ADD FOREIGN KEY (SellerID) REFERENCES Users(ID);

ALTER TABLE Transactions
ADD FOREIGN KEY (BuyerID) REFERENCES Users(ID);

CREATE TABLE Comments (
    ID INT IDENTITY PRIMARY KEY,
    AuthorID INT,
    HatID INT,
    Body VARCHAR(max)
);

ALTER TABLE Comments
ADD FOREIGN KEY (AuthorID) REFERENCES Users(ID);

ALTER TABLE Comments
ADD FOREIGN KEY (HatID) REFERENCES Hats(ID);

/**
 * Possible future:
 * - User/Hat/Charm API
 * - Car racing game w/ hats - http://schteppe.github.io/cannon.js/demos/rigidVehicle.html
 */