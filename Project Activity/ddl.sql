create schema activity1 collate utf8_general_ci;

create table if not exists users
(
    ID int auto_increment
        primary key,
    FIRST_NAME varchar(100) null,
    LAST_NAME varchar(100) null,
    USERNAME varchar(50) not null,
    PASSWORD varchar(50) not null
);

