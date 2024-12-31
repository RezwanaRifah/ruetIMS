# RuetIMS

### Departments Table Creation Query
```sql
CREATE TABLE `rims`.`labs`(
    `Id` INT(11) NOT NULL AUTO_INCREMENT,
    `FullName` VARCHAR(100) NOT NULL,
    `ShortName` VARCHAR(50) NOT NULL,
    `Faculty` INT(11) NOT NULL,
    PRIMARY KEY(`Id`)
) ENGINE = InnoDB;
```

### Departments Table Data Insertion Query
```sql
INSERT INTO `departments`(
    `Id`,
    `FullName`,
    `ShortName`,
    `Faculty`
)
VALUES(
    NULL,
    'Electrical and Electronic Engineering',
    'EEE',
    '3'
),(
    NULL,
    'Computer Science and Engineering',
    'CSE',
    '3'
),(
    NULL,
    'Electrical and Computer Engineering',
    'ECE',
    '3'
),(
    NULL,
    'Electronics and Telecommunication Engineering',
    'ETE',
    '3'
),(
    NULL,
    'Mechanical Engineering',
    'ME',
    '5'
),(
    NULL,
    'Industrial and Production Engineering',
    'IPE',
    '5'
),(
    NULL,
    'Mechatronics Engineering',
    'MTE',
    '5'
),(
    NULL,
    'Materials Science and Engineering',
    'MSE',
    '5'
),(
    NULL,
    'Chemical Engineering',
    'ChE',
    '5'
),(
    NULL,
    'Glass and Ceramic Engineering',
    'GCE',
    '5'
),(
    NULL,
    'Civil Engineering',
    'CE',
    '11'
),(
    NULL,
    'Building Engineering and Construction Management',
    'BECM',
    '11'
),(
    NULL,
    'Urban and Regional Planning',
    'URP',
    '11'
),(NULL, 'Architecture', 'Arch', '11');
```

### Labs Table Creation Query
```sql
CREATE TABLE `rims`.`labs`(
    `Id` INT(11) NOT NULL AUTO_INCREMENT,
    `Name` VARCHAR(100) NOT NULL,
    `RoomNo` VARCHAR(50) NOT NULL,
    `DeptId` INT(11) NOT NULL,
    PRIMARY KEY(`Id`)
) ENGINE = InnoDB;
```

### Dummy Labs Data Insertion Query
```sql
INSERT INTO `labs` (`Id`, `Name`, `RoomNo`, `DeptId`) VALUES (NULL, 'Software Lab', '205', '2'), (NULL, 'Gaming Lab', '104', '2')
```

### Equipments Table Creation Query
```sql
CREATE TABLE `rims`.`equipments`(
    `Id` INT(11) NOT NULL AUTO_INCREMENT,
    `Name` VARCHAR(100) NOT NULL,
    `RoomNo` VARCHAR(50) NOT NULL,
    `Condition` BOOLEAN NOT NULL DEFAULT TRUE,
    PRIMARY KEY(`Id`)
) ENGINE = InnoDB;
```

### Dummy Equipments Data Insertion Query
#### You can insert multiple times to get more data
```sql
INSERT INTO `equipments`(`Id`, `Name`, `RoomNo`, `Condition`)
VALUES(NULL, 'AC', '101', '1'),(NULL, 'AC', '10', '1'),(NULL, 'Fan', '101', '1'),(NULL, 'Fan', '101', '1'),(NULL, 'Light', '101', '1'),(NULL, 'LED TV', '207', '1'),(NULL, 'Laptop', '207', '0'),(NULL, 'Laptop', '207', '1'),(NULL, 'LED TV', '205', '0'),(NULL, 'Table', '203', '0')
```


### Rooms Table Creation Query
```sql
CREATE TABLE `rims`.`rooms`(
    `RoomNo` VARCHAR(255) NOT NULL,
    `RoomName` VARCHAR(255) NOT NULL,
    `RoomType` VARCHAR(255) NOT NULL,
    `Capacity` INT(11) NOT NULL,
    `Department` VARCHAR(255) NOT NULL,
    PRIMARY KEY(`RoomNo`(255))
) ENGINE = InnoDB;
```