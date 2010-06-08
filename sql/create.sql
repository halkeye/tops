DROP TABLE IF EXISTS eventTypes;
CREATE TABLE IF NOT EXISTS eventTypes (
    id int primary key auto_increment,
    name varchar(255), 
    nameKey varchar(255), 
    textColor varchar(10), 
    bgColor varchar(10)
);

DROP TABLE IF EXISTS days;
CREATE TABLE IF NOT EXISTS days (
    id int primary key auto_increment,
    day date not null default '0000-00-00'
);

DROP TABLE IF EXISTS rooms;
CREATE TABLE IF NOT EXISTS rooms (
    id int primary key auto_increment,
    name varchar(255) not null default ''
);

DROP TABLE IF EXISTS events;
CREATE TABLE IF NOT EXISTS events (
    id int primary key auto_increment,
    roomId int not null default 0,
    dayId int not null default 0,
    time varchar(4) not null default '0000',
    name varchar(255) not null default '', 
    length int not null default 0,
    eventType1 int not null default 0,
    eventType2 int not null default 0,
    eventType3 int not null default 0,
    eventType4 int not null default 0
);

