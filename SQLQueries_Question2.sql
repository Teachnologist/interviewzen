-- 1. List employees (names) who have a bigger salary than their boss

Select a.`name` FROM Employees AS a
JOIN Employees AS b
ON (a.`BossID` = b.`EmployeeID`)
WHERE a.`Salary` > b.`Salary`;

-- 2. List departments that have less than 3 people in it
Select a.`DepartmentID`, a.`Name`,COUNT(b.`EmployeeID`) AS employee_count FROM Departments AS a
JOIN Employees AS b
ON (a.`DepartmentID` = b.`DepartmentID`)
GROUP BY b.`DepartmentID`
HAVING employee_count < 3;


-- 3. List all departments along with the total salary there
Select a.`DepartmentID`, a.`Name`,SUM(b.`Salary`) AS total_salary FROM Departments AS a
JOIN Employees AS b
ON (a.`DepartmentID` = b.`DepartmentID`)
GROUP BY b.`DepartmentID`;


-- 4. List employees that don't have a boss in the same department
Select a.* FROM Employees AS a
JOIN Employees AS b
ON (a.`BossID` = b.`EmployeeID` AND a.`DepartmentID` <> b.`DepartmentID`);



-- 5. List all departments along with the number of people there
Select a.`DepartmentID`, a.`Name`,COUNT(b.`EmployeeID`) AS employee_count FROM Departments AS a
JOIN Employees AS b
ON (a.`DepartmentID` = b.`DepartmentID`)
GROUP BY b.`DepartmentID`;
