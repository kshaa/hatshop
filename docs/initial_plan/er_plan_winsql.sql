
CREATE TABLE Users (
    ID INT IDENTITY PRIMARY KEY,
    Email VARCHAR(255),
    -- Roles RolesPrim(ID),
    Name VARCHAR(255),
    Surname VARCHAR(255),
    Info VARCHAR(255),
    Yarn Int /* Money */
);

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