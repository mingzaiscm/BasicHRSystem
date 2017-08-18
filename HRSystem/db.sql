CREATE DATABASE firezett_hrsystem;
USE firezett_hrsystem;

CREATE TABLE `Employee`(
`employeeCode` VARCHAR(7) NOT NULL PRIMARY KEY,
`name` varchar(225) NOT NULL,
`title` varchar(30) DEFAULT NULL,
`cimbAcc` varchar(225) DEFAULT NULL,
`icNo` varchar(20) DEFAULT NULL,
`gender` varchar(10) DEFAULT NULL,
`citizenship` varchar(225) DEFAULT NULL,
`epfNo` varchar(11) DEFAULT NULL,
`socsoNo` varchar(17) DEFAULT NULL,
`incomeTaxNo` varchar(17) DEFAULT NULL,
`dob` date DEFAULT NULL,
`marital` varchar(10) DEFAULT NULL,
`permaAddr` varchar(225) DEFAULT NULL,
`residentialAddr` varchar(225) DEFAULT NULL,
`telNo` varchar(100) DEFAULT NULL,
`handphoneNo` varchar(100) DEFAULT NULL,
`joinDate` date DEFAULT NULL,
`confirmDate` date DEFAULT NULL,
`email` varchar(100) DEFAULT NULL,
`companyEmail` varchar(100) DEFAULT NULL,
`resignDate` date DEFAULT NULL,
`emergencyName` varchar(225) DEFAULT NULL,
`relationship` varchar(20) DEFAULT NULL,
`emergencyTel` varchar(100) DEFAULT NULL,
`emergencyAddr` varchar(225) DEFAULT NULL,
`status` varchar(20) DEFAULT 'Active',
`createdBy` VARCHAR(7) NOT NULL,
`createdDate` TIMESTAMP NOT NULL DEFAULT now(),
`modifiedBy` VARCHAR(7),
`modifiedDate` TIMESTAMP NULL,
UNIQUE (companyEmail),
FOREIGN key (`createdBy`) REFERENCES Employee(`employeeCode`),
FOREIGN key (`modifiedBy`) REFERENCES Employee(`employeeCode`)
)ENGINE = "InnoDB" DEFAULT charset="utf8";

INSERT INTO `Employee` (employeeCode, name, createdBy)
  VALUES('admin', 'admin', 'admin');

CREATE TABLE `Role`(
`roleId` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
`roleName` VARCHAR(20) NOT NULL,
`roleDesc` VARCHAR(255) NOT NULL,
`permission` VARCHAR(255) NOT NULL,
`createdBy` VARCHAR(7) NOT NULL,
`createdDate` TIMESTAMP NOT NULL,
`modifiedBy` VARCHAR(7),
`modifiedDate` TIMESTAMP,
FOREIGN key (`createdBy`) REFERENCES Employee(`employeeCode`),
FOREIGN key (`modifiedBy`) REFERENCES Employee(`employeeCode`)
)ENGINE = "InnoDB" DEFAULT charset="utf8";
  
INSERT INTO `Role` (roleId, roleName, roleDesc, permission, createdBy, createdDate)
  VALUES(1, 'superadmin', 'superadmin', 
  '1-2-3-4-5-6-7-8-9-10-11-12-13-14-15-16-17-18-19-20-21-22-23',
  'admin', now());
  
INSERT INTO `Role` (roleId, roleName, roleDesc, permission, createdBy, createdDate)
  VALUES(2, 'employee', 'employee', 
  '',
  'admin', now());

CREATE TABLE `Account`(
`username` VARCHAR(255) NOT NULL PRIMARY KEY,
`password` VARCHAR(255) NOT NULL,
`roleId` INT NULL,
`locked` BOOLEAN NOT NULL DEFAULT 0,
`loginFailure` INT(1) NOT NULL DEFAULT 0,
`employeeCode` VARCHAR(7),
`createdBy` VARCHAR(7) NOT NULL,
`createdDate` TIMESTAMP NOT NULL,
`modifiedBy` VARCHAR(7),
`modifiedDate` TIMESTAMP,
UNIQUE (username),
FOREIGN key (`employeeCode`) REFERENCES Employee(`employeeCode`),
FOREIGN key (`roleId`) REFERENCES Role(`roleId`),
FOREIGN key (`createdBy`) REFERENCES Employee(`employeeCode`),
FOREIGN key (`modifiedBy`) REFERENCES Employee(`employeeCode`)
)ENGINE = "InnoDB" DEFAULT charset="utf8";

INSERT INTO `Account` (username, password, roleId, locked, employeeCode, createdBy, createdDate)
  VALUES('admin', md5("admin"), '1', 0, 'admin', 'admin', now());
  
CREATE TABLE `HolidaySchedule`(
`hsId` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
`hsDate` DATE NOT NULL,
`hsDesc` VARCHAR(50) NOT NULL,
`enabled` BOOLEAN NOT NULL,
`createdBy` VARCHAR(7) NOT NULL,
`createdDate` TIMESTAMP NOT NULL,
`modifiedBy` VARCHAR(7),
`modifiedDate` TIMESTAMP,
FOREIGN key (`createdBy`) REFERENCES Employee(`employeeCode`),
FOREIGN key (`modifiedBy`) REFERENCES Employee(`employeeCode`)
)ENGINE = "InnoDB" DEFAULT charset="utf8";

CREATE TABLE `LeaveType`(
`leaveType` VARCHAR(30) NOT NULL PRIMARY KEY,
`criteria` BOOLEAN NOT NULL,
`porata` BOOLEAN NOT NULL,
`days` INT(2),
`enabled` BOOLEAN NOT NULL,
`createdBy` VARCHAR(7) NOT NULL,
`createdDate` TIMESTAMP NOT NULL,
`modifiedBy` VARCHAR(7),
`modifiedDate` TIMESTAMP,
FOREIGN key (`createdBy`) REFERENCES Employee(`employeeCode`),
FOREIGN key (`modifiedBy`) REFERENCES Employee(`employeeCode`)
)ENGINE = "InnoDB" DEFAULT charset="utf8";
  
INSERT INTO `LeaveType` (leaveType, criteria, porata, days, enabled, createdBy, createdDate)
  VALUES('Annual Leave', 0, 0, 12, 1, 'admin', now());
  
CREATE TABLE `LeaveCriteria`(
`criteriaId` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
`leaveType` VARCHAR(30) NOT NULL,
`yearFrom` INT(2) NOT NULL,
`yearTo` INT(2) NOT NULL,
`days` INT(2) NOT NULL,
`enabled` BOOLEAN NOT NULL,
`createdBy` VARCHAR(7) NOT NULL,
`createdDate` TIMESTAMP NOT NULL,
`modifiedBy` VARCHAR(7),
`modifiedDate` TIMESTAMP,
FOREIGN key (`leaveType`) REFERENCES LeaveType(`leaveType`),
FOREIGN key (`createdBy`) REFERENCES Employee(`employeeCode`),
FOREIGN key (`modifiedBy`) REFERENCES Employee(`employeeCode`)
)ENGINE = "InnoDB" DEFAULT charset = "utf8";
  
CREATE TABLE `LeaveEntitlement`(
`year` INT(4) NOT NULL,
`leaveType` VARCHAR(30) NOT NULL,
`employeeCode` VARCHAR(7) NOT NULL,
`entitlement` DECIMAL(3,1) NOT NULL,
`taken` DECIMAL(3,1) NOT NULL,
`createdBy` VARCHAR(7) NOT NULL,
`createdDate` TIMESTAMP NOT NULL,
`modifiedBy` VARCHAR(7),
`modifiedDate` TIMESTAMP,
PRIMARY KEY (`year`, `leaveType`, `employeeCode`),
FOREIGN key (`leaveType`) REFERENCES LeaveType(`leaveType`),
FOREIGN key (`employeeCode`) REFERENCES Employee(`employeeCode`),
FOREIGN key (`createdBy`) REFERENCES Employee(`employeeCode`),
FOREIGN key (`modifiedBy`) REFERENCES Employee(`employeeCode`)
)ENGINE = "InnoDB" DEFAULT charset = "utf8";
  
CREATE TABLE `LeaveApplication`(
`leaveId` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
`leaveType` VARCHAR(30) NOT NULL,
`dateFrom` DATE NOT NULL,
`dateTo` DATE NOT NULL,
`days` DECIMAL(3,1) NOT NULL,
`reason` VARCHAR(255) NOT NULL,
`status` VARCHAR(15) NOT NULL,
`createdBy` VARCHAR(7) NOT NULL,
`createdDate` TIMESTAMP NOT NULL,
`modifiedBy` VARCHAR(7),
`modifiedDate` TIMESTAMP,
FOREIGN key (`leaveType`) REFERENCES LeaveType(`leaveType`),
FOREIGN key (`createdBy`) REFERENCES Employee(`employeeCode`),
FOREIGN key (`modifiedBy`) REFERENCES Employee(`employeeCode`)
)ENGINE = "InnoDB" DEFAULT charset = "utf8";

CREATE TABLE `CFLeave`(
`year` INT(4) NOT NULL,
`employeeCode` VARCHAR(7) NOT NULL,
`days` DECIMAL(3,1) NOT NULL,
`createdBy` VARCHAR(7) NOT NULL,
`createdDate` TIMESTAMP NOT NULL,
`modifiedBy` VARCHAR(7),
`modifiedDate` TIMESTAMP,
PRIMARY KEY (`year`, `employeeCode`),
FOREIGN key (`createdBy`) REFERENCES Employee(`employeeCode`),
FOREIGN key (`modifiedBy`) REFERENCES Employee(`employeeCode`)
) ENGINE = "InnoDB" DEFAULT charset = "utf8";
  