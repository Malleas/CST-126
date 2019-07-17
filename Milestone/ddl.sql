create schema cst126milestone collate utf8_general_ci;

create table user_info
(
    userId int auto_increment
        primary key,
    userName char(50) not null,
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
    zipCode char(5) null,
    country char(50) null,
    userBanned char default 'n' null,
    userDeleted char default 'n' null,
    password varchar(255) not null,
    confirmPassword varchar(255) not null,
    roleName char(50) default 'Spectator' not null,
    constraint user_info_email1_uindex
        unique (email1),
    constraint user_info_userName_uindex
        unique (userName)
);

create table posts
(
    post_id int auto_increment
        primary key,
    post_title varchar(255) not null,
    post_content longtext not null,
    post_date datetime default CURRENT_TIMESTAMP not null,
    post_accepted tinyint(1) default 0 null,
    post_denied varchar(10) null,
    post_author char(50) null,
    post_rate float default 1 not null,
    constraint posts_user_info_userName_fk
        foreign key (post_author) references user_info (userName)
            on update cascade on delete set null
);

create table comments
(
    comment_id int auto_increment
        primary key,
    comment_content longtext not null,
    comment_date datetime default CURRENT_TIMESTAMP not null,
    post_id int not null,
    constraint comments_posts_post_id_fk
        foreign key (post_id) references posts (post_id)
);

create table rate
(
    id int auto_increment
        primary key,
    post_id int not null,
    rate_date datetime default CURRENT_TIMESTAMP not null,
    rate tinyint(1) not null,
    constraint rate_posts_post_id_fk
        foreign key (post_id) references posts (post_id)
);

