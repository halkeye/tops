create table if not exists  eventTypes (
    id int primary key auto_increment,
    name varchar(255), 
    nameKey varchar(255), 
    textColor varchar(10), 
    bgColor varchar(10)
);

create table if not exists  rooms (
    id int primary key auto_increment,
    name varchar(255)
);

create table if not exists events (
    id int primary key auto_increment,
    roomId int not null default 0,
    eventDate date not null default '0000-00-00',
    time varchar(4) not null default '0000',
    name varchar(255) not null default '', 
    length int not null default 0,
    eventType1 int not null default 0,
    eventType2 int not null default 0,
    eventType3 int not null default 0,
    eventType4 int not null default 0
);

