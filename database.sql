create database if not exists `asisweb` default character set utf8 collate utf8_general_ci;
use `asisweb`;

-- Table: `users`
create table if not exists `users` (
  `user_id` int(11) not null auto_increment primary key,
  `first_name` varchar(100) not null,
  `last_name` varchar(100) not null,
  `email` varchar(255) not null unique key,
  `phone_number` varchar(10) not null unique key,
  `hashed_password` varchar(255) not null,
  `salt` varchar(32) not null,
  `active` tinyint(1) not null default 0,
  `admin` tinyint(1) not null default 0,
  `created_at` datetime not null default current_timestamp,
  `updated_at` datetime not null default current_timestamp on update current_timestamp
) engine=InnoDB default charset=utf8;

-- Table: `extra_emails`
create table if not exists `extra_emails` (
  `email_id` int(11) not null auto_increment primary key,
  `user_id` int(11) not null,
  `extra_email` varchar(255) not null unique key,
  `created_at` datetime not null default current_timestamp,
  `updated_at` datetime not null default current_timestamp on update current_timestamp,
  foreign key (`user_id`) references `users`(`user_id`) on delete cascade
) engine=InnoDB default charset=utf8;

-- Table: `extra_phone_numbers`
create table if not exists `extra_phone_numbers` (
  `phone_number_id` int(11) not null auto_increment primary key,
  `user_id` int(11) not null,
  `extra_phone_number` varchar(10) not null unique key,
  `created_at` datetime not null default current_timestamp,
  `updated_at` datetime not null default current_timestamp on update current_timestamp,
  foreign key (`user_id`) references `users`(`user_id`) on delete cascade
) engine=InnoDB default charset=utf8;
