create schema proju;
use proju;

create table post(
    id int auto_increment not null,
    title varchar(30) not null,
    image varchar(50) not null,
    primary key (id)
);

create table comment(
    id int auto_increment not null,
    name varchar(30) not null,
    text varchar(200) not null,
    post_id int not null,
    primary key (id)
);

create table likes(
    id int auto_increment not null,
    comment ENUM('false','true') not null,
    ip varchar(20) not null,
    primary key (id)
);