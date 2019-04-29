/* ER model planning */

CREATE TABLE Roles {
    ID INT NOT NULL AUTO_INCREMENT,
    Name VARCHAR(255),
    Comment {String} ["Admin", "User"] (What is the group for)
}

CREATE TABLE Users [
    ID INT NOT NULL AUTO_INCREMENT,
    (?) Groups {Groups.ID},
    Name VARCHAR(255),
    Surname {String},
    (~) Info {String},
    Yarn {Int} /* Money */
]

/**
 * Upload STL files
 * Or link to Thingiverse w/ STL file https://www.thingiverse.com/thing:14698
 * Thingiverse API - https://www.thingiverse.com/developers/rest-api-reference
 * Max file path ~ 4096 https://stackoverflow.com/questions/9449241/where-is-path-max-defined-in-linux
 */
CREATE TABLE Hats {
    Codename VARCHAR(255) NOT NULL,
    Status VARCHAR(255) /* ["Approved", "Unapproved"] */,
    Location VARCHAR(255) /* ["Factory", "Market", "Storage"] */,
    Quantity INT,
    Model VARCHAR(4096) /* Path to image file */,
    OwnerID INT REFERENCES Users(ID)
}

CREATE TABLE Marketplace {
    ID INT NOT NULL AUTO_INCREMENT,
    HatID VARCHAR REFERENCES Hats(Codename),
    Yarn INT /* Price */
}

CREATE TABLE Transactions {
    HatID VARCHAR REFERENCES Hats(Codename),
    Yarn INT /* Price */,
    SellerID INT REFERENCES Users(ID),    
    BuyerID INT REFERENCES Users(ID)    
}

CREATE TABLE Comments {
    AuthorID INT REFERENCES Users(ID),
    Body TEXT
}


/* Hat car game - http://schteppe.github.io/cannon.js/demos/rigidVehicle.html */