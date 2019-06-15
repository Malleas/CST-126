
-- create user_info table
create table user_Info
(
    userId int auto_increment,
    userName char(50) not null,
    userRole int(1) not null,
    firstname char(50) not null,
    middleName char(50) null,
    lastName char(50) not null,
    nickName char(50) not null,
    email1 char(50) not null,
    email2 char(50) null,
    address1 char(50) null,
    address2 char(50) null,
    city char(50) null,
    state char(50) null,
    zipCode int(5) null,
    country char(50) null,
    userBanned char default 'n' null,
    userDeleted char default 'n' null,
    constraint userInfo_pk
        primary key (userId)
);

create unique index userInfo_email1_uindex
    on user_Info (email1);
create unique index userInfo_userName_uindex
    on user_Info (userName);

-- used to add FK for userRole once _roles table is needed
ALTER TABLE user_Info
Add FOREIGN KEY (userRole) REFERENCES _roles(roleId);

-- create _roles table un needed for milestone one but will need to add userRole to user_info per requirements at a later point
create table _roles
(
    roleId int(1) auto_increment,
    roleName char(50) not null,
    roleDescription char(50) not null,
    createdDate timestamp default current_timestamp null,
    createdBy int null,
    updatedDate timestamp default current_timestamp null,
    updatedBy int null,
    activeFlag char default 'y' null,
    constraint roles_pk
        primary key (roleId),
    constraint roles_user_info_userId_fk
        foreign key (createdBy) references user_info (userId),
    constraint roles_user_info_userId_fk_2
        foreign key (updatedBy) references user_info (userId)
);

create unique index roles_roleName_uindex
    on _roles (roleName);


