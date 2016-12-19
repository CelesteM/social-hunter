DROP DATABASE Not_Facebook;

CREATE DATABASE IF NOT EXISTS Not_Facebook;

USE Not_Facebook;


CREATE TABLE IF NOT EXISTS Users (
  `UserID` INT NOT NULL,
  `LastName` VARCHAR(45) NOT NULL,
  `FirstName` VARCHAR(45) NOT NULL,
  `Address` VARCHAR(45) NULL,
  `City` CHAR(45) NULL,
  `State` CHAR(45) NULL,
  `ZipCode` INT NULL,
  `Telephone` INT NULL,
  `Email` CHAR(45) NOT NULL,
  `AccountNumber` INT NOT NULL,
  `CreationDate` DATE NOT NULL,
  `CreditCardNumber` INT NULL,
  `Preferences` VARCHAR(45) NULL,
  `Rating` VARCHAR(45) NULL,
  PRIMARY KEY (`UserID`));



-- -----------------------------------------------------
-- Table `Group`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Group` (
  `GroupID` INT NOT NULL,
  `Group Name` VARCHAR(45) NOT NULL,
  `Type` CHAR(45) NOT NULL,
  `Owner` INT NOT NULL,
  PRIMARY KEY (`GroupID`),
  CONSTRAINT `Owner`
    FOREIGN KEY (`Owner`)
    REFERENCES `Users` (`UserID`));


-- -----------------------------------------------------
-- Table `Group Page`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Group Page` (
  `PageID` INT NOT NULL,
  `Owner` INT NOT NULL,
  `Associated Group` INT NULL,
  `Post Count` INT NOT NULL,
  PRIMARY KEY (`PageID`),
    FOREIGN KEY (`Owner`)
    REFERENCES `Users` (`UserID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `Associated Group`
    FOREIGN KEY (`Associated Group`)
    REFERENCES `Group` (`GroupID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `Personal Page`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Personal Page` (
  `PageID` INT NOT NULL,
  `Owner` INT NOT NULL,
  `Post Count` INT NOT NULL,
  PRIMARY KEY (`PageID`),
    FOREIGN KEY (`Owner`)
    REFERENCES `Users` (`UserID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `Post`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Post` (
  `PostID` INT NOT NULL,
  `Date` DATE NOT NULL,
  `Content` VARCHAR(100) NOT NULL,
  `Comment Count` INT NOT NULL,
  `PostedBy` INT NOT NULL,
  `Post Page` INT NOT NULL,
  PRIMARY KEY (`PostID`),
  CONSTRAINT `PostedBy`
    FOREIGN KEY (`PostedBy`)
    REFERENCES `Users` (`UserID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (`Post Page`)
    REFERENCES `Group Page` (`PageID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (`Post Page`)
    REFERENCES `Personal Page` (`PageID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `Comment`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Comment` (
  `PostID` INT NOT NULL,
  `Date` DATE NOT NULL,
  `Content` VARCHAR(100) NOT NULL,
  `Author` INT NOT NULL,
  `Post` INT NOT NULL,
  PRIMARY KEY (`PostID`),
  CONSTRAINT `Author`
    FOREIGN KEY (`Author`)
    REFERENCES `Users` (`UserID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `Post`
    FOREIGN KEY (`Post`)
    REFERENCES `Post` (`PostID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `Messages`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Messages` (
  `MessageID` INT NOT NULL,
  `Date` DATETIME NOT NULL,
  `Subject` CHAR(45) NULL,
  `Content` VARCHAR(100) NOT NULL,
  `Sender` INT NOT NULL,
  `Receiver` INT NOT NULL,
  PRIMARY KEY (`MessageID`),
  CONSTRAINT `Sender`
    FOREIGN KEY (`Sender`)
    REFERENCES `Users` (`UserID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `Receiver`
    FOREIGN KEY (`Receiver`)
    REFERENCES `Users` (`UserID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `mydb`.`Employee`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Employees` (
  `SSN` INT(10) NOT NULL,
  `LastName` VARCHAR(45) NOT NULL,
  `FirstName` VARCHAR(45) NOT NULL,
  `Address` VARCHAR(45) NULL,
  `City` CHAR(45) NULL,
  `State` CHAR(45) NULL,
  `ZipCode` INT NULL,
  `Telephone` VARCHAR(15) NULL,
  `StartDate` DATE NOT NULL,
  `HourlyRate` DOUBLE NOT NULL,
  PRIMARY KEY (`SSN`));


-- -----------------------------------------------------
-- Table `Advertisements`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Advertisements` (
  `AdvertisementID` INT NOT NULL,
  `EmployeeID` INT(10) NOT NULL,
  `Category` VARCHAR(45) NOT NULL,
  `AdvertisedDate` DATETIME NOT NULL,
  `Company` VARCHAR(45) NOT NULL,
  `ItemName` CHAR(45) NOT NULL,
  `Content` VARCHAR(200) NOT NULL,
  `UnitPrice` DOUBLE NOT NULL,
  `AvailableUnits` INT NOT NULL,
  PRIMARY KEY (`AdvertisementID`));
    -- FOREIGN KEY (`EmployeeID`)
--     REFERENCES `Employees` (`SSN`));


-- -----------------------------------------------------
-- Table `Join Group`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Join Group` (
  `GroupID` INT NOT NULL,
  `UserID` INT NOT NULL,
  `Member Since` DATETIME NOT NULL,
  PRIMARY KEY (`GroupID`, `UserID`),
  CONSTRAINT `GroupID`
    FOREIGN KEY (`GroupID`)
    REFERENCES `Group` (`GroupID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `UserID`
    FOREIGN KEY (`UserID`)
    REFERENCES `Users` (`UserID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `Sales`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Sales` (
  `TransactionID` INT NOT NULL,
  `SalesDate` DATETIME NOT NULL,
  `AdvertisementID` INT NOT NULL,
  `NumberofUnits` INT NOT NULL,
  `UserID` INT NOT NULL,
  `AccountNumber` BIGINT NOT NULL,
  `Total` DOUBLE NOT NULL,
  PRIMARY KEY (`TransactionID`),
  -- CONSTRAINT `AdvertisementID`
    FOREIGN KEY (`AdvertisementID`)
    REFERENCES `Advertisements` (`AdvertisementID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (`UserID`)
    REFERENCES `Users` (`UserID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);