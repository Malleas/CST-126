create table if not exists posts
(
    post_id      int auto_increment
        primary key,
    post_title   varchar(255)                       not null,
    post_content longtext                           not null,
    post_date    datetime default CURRENT_TIMESTAMP not null
);

create table if not exists roles
(
    roleId          int auto_increment
        primary key,
    roleName        char(50)                            not null,
    roleDescription varchar(255)                        not null,
    createdDate     timestamp default CURRENT_TIMESTAMP null,
    createdBy       int                                 null,
    updatedDate     timestamp default CURRENT_TIMESTAMP null,
    updatedBy       int                                 null,
    activeFlag      char      default 'y'               null
);

create table if not exists user_Info
(
    userId          int auto_increment
        primary key,
    userName        char(50)         not null,
    firstname       char(50)         not null,
    middleName      char(50)         null,
    lastName        char(50)         not null,
    nickName        char(50)         not null,
    email1          char(50)         not null,
    email2          char(50)         null,
    address1        char(50)         null,
    address2        char(50)         null,
    city            char(50)         null,
    state           char(50)         null,
    zipCode         char(5)          null,
    country         char(50)         null,
    userBanned      char default 'n' null,
    userDeleted     char default 'n' null,
    password        varchar(255)     not null,
    confirmPassword varchar(255)     not null,
    constraint userInfo_email1_uindex
        unique (email1),
    constraint userInfo_userName_uindex
        unique (userName)
);

