-- Add information for an employee
INSERT INTO Employees (SSN, LastName, FirstName, Address, City, 
	State, ZipCode, Telephone, StartDate, HourlyRate)
	VALUES(?,?,?,?,?,?,?,?,?);

-- Edit information for an employee
UPDATE Employee
	SET HourlyRate = ?
	WHERE SSN = ?;

-- Delete information for an employee
DELETE FROM Employee
	WHERE SSN = ?;

-- Obtain a sales report for a particular month
SELECT * 
	FROM Sales
	WHERE SalesDate LIKE '2016/10%';

-- Produce a comprehensive listing of all items being advertised on the site
SELECT AdvertisementID, DISTINCT ItemName, Content, UnitPrice, AdvertisedDate, Company
	FROM Advertisements;

-- Produce a list of transactions by item name 
SELECT *
	FROM Sales
	WHERE AdvertisementID = 
		(SELECT Advertisements.AdvertisementID FROM Advertisements WHERE ItemName = "?");

-- Produce a list of transactions by user name ???
SELECT *
	FROM Sales
	WHERE UserID = 
		(SELECT UserID FROM Users WHERE FirstName = ? AND LastName = ?);

-- Produce a summary listing of revenue generated by a particular item
SELECT UnitPrice * NumberOfUnits, ItemName
	FROM Advertisements, Sales
	WHERE Advertisements.AdvertisementID IN 
		(SELECT AdvertisementID FROM Advertisements WHERE ItemName = ?) AS ADID
	AND Sales.AdvertisementID = ADID;

-- Produce a summary listing of revenue generated by item type
SELECT UnitPrice * NumberOfUnits, ItemName, Category
	FROM Advertisements, Sales
	WHERE Advertisements.Category = ?
	AND Sales.AdvertisementID IN 
		(SELECT AdvertisementID FROM Advertisements WHERE Advertisement.Category = ?)

-- Produce a summary listing of revenue generated by customer
SELECT SUM(Total) 
FROM Sales 
WHERE UserID = ?;

-- Determine which customer representative generated most total revenue
CREATE VIEW Best_Salesperson_View AS 
USE Not_Facebook;
SELECT EmployeeID
	FROM Advertisements JOIN
		(SELECT 
			AdvertisementID, SUM(NumberOfUnits) AS UnitsSum 
            FROM Sales GROUP BY AdvertisementID ORDER BY UnitsSum) a
        ON Advertisements.AdvertisementID = a.AdvertisementID
	LIMIT 1;

-- Determine which customer generated most total revenue
SELECT UserID, MAX(total_sum) as total
	FROM 
		(SELECT UserID, SUM(Total) AS total_sum 
			FROM Sales GROUP BY UserID
		) s
	GROUP BY UserID
    ORDER BY max(total_sum) DESC
	LIMIT 1

-- Produce a list of most active items
CREATE VIEW Beset_Seller_View AS
SELECT *
	FROM Advertisements JOIN
		(SELECT AdvertisementID, SUM(NumberOfUnits) AS UnitsSum FROM Sales ORDER BY UnitsSum) a
        ON Advertisements.AdvertisementID = a.AdvertisementID;

-- Produce a list of all customers who have purchased a particular item
SELECT UserID
	FROM Sales
	WHERE AdvertisementID IN (SELECT AdvertisementID FROM Advertisments WHERE ItemName = ?)

--Produce a list of all items for a given company
SELECT ItemName, Content, UnitPrice, Company
	FROM Advertisements
	WHERE Company = ?


-------------Customer-Representative-Level Transactions-----------

-- Create an advertisement
INSERT INTO Advertisments (AdvertisementID, EmployeeID, Category, AdvertisedDate, 
	Company, ItemName, Content, UnitPrice, AvailableUnits)
	VALUES (?,?,?,?,?,?,?,?,?);


-- Delete an advertisement.
START TRANSACTION;
DELETE FROM Advertisments
WHERE AdvertismentID = ?;
	
COMMIT;

-- Record a transaction
START TRANSACTION;
INSERT INTO Sales (TransactionID, UserID, SalesDate, AdvertisementID, NumberofUnits, AccountNumber, Total)
	VALUES(?, ?, ?, ?, ?);
	
UPDATE Advertisements
	SET AvailableUnits = AvailableUnits-1
	WHERE AdvertisementID = ?;
	
COMMIT;

-- Add information for a customer
START TRANSACTION;
INSERT INTO Sales (TransactionID, UserID, SalesDate, AdvertisementID, NumberofUnits, AccountNumber, Total)
	VALUES(?, ?, ?, ?, ?);
	
UPDATE Advertisements
	SET AvailableUnits = AvailableUnits-1
	WHERE AdvertisementID = ?;
	
COMMIT;


-- Edit information for a customer
START TRANSACTION;
UPDATE Sales
	SET NumberOfUnits = ?, Total = ?, SalesDate = ?
	WHERE TransactionID = ?;
COMMIT;

-- Delete information for a customer
START TRANSACTION;
DELETE FROM Sales
	WHERE TransactionID = ?;
COMMIT;

-- Produce customer mailing lists
SELECT Email, UserID
FROM Advertisements, Sales, Users
WHERE Users.UserID IN 
		(SELECT UserID FROM Sales WHERE AdvertisementID IN 
			(SELECT AdvertisementID FROM Advertisements WHERE EmployeeID = ?
			)
		)

-- Produce a list of item suggestions for a given customer (based on that customer's past transactions)
SELECT TOP 10 ItemName, Content, UnitPrice, AvailableUnits
	FROM Advertisements
	WHERE Advertisements.Category IN 
		(SELECT Category FROM Advertisements WHERE AdvertismentID IN 
			(SELECT AdvertisementID FROM Sales WHERE UserID = ? 
				ORDER BY SUM(NumberOfUnits) DESC
			) 
		)


-- Purchase one or more copies of an advertised item
START TRANSACTION;
INSERT INTO Sales (TransactionID, UserID, SalesDate, AdvertisementID, NumberofUnits, AccountNumber, Total)
	VALUES(?, ?, ?, ?, ?);
	
UPDATE Advertisements
	SET AvailableUnits = ?
	WHERE AdvertisementID = ?;
	
COMMIT;



-- A customer's current groups
SELECT groups
	FROM Users
	WHERE UserID = ?;

-- For each of a customer's accounts, the account history
SELECT TransactionID, ItemName, NumberofUnits, AccountNumt
	FROM Sales, Advertisements
	WHERE Sales.AdvertisementID IN 
			(SELECT AdvertisementID FROM Sales WHERE UserID = ?)
		AND Avertisements.AdvertisementID IN 
			(SELECT AdvertisementID FROM Sales WHERE UserID = ?);

-- Best-Seller list of items
SELECT TOP 10
	FROM Sales
	ORDER BY NumberOfUnits
	GROUP BY AdvertisementID;

-- Personalized item suggestion list
SELECT TOP 10 ItemName, Content, UnitPrice, AvailableUnits
	FROM Advertisements
	WHERE Advertisements.Category IN 
		(SELECT Category FROM Advertisements WHERE AdvertismentID IN 
			(SELECT AdvertisementID FROM Sales WHERE UserID = ? 
				ORDER BY SUM(NumberOfUnits) DESC
			) 
		)
		
