create database if not exists `asisweb` default character
set
  utf8 collate utf8_general_ci;

use `asisweb`;

-- Table: `users` (Usuarios) (Docentes y administradores)
create table
  if not exists `users` (
    `user_id` int (11) not null auto_increment primary key,
    `first_name` varchar(100) not null,
    `last_name` varchar(100) not null,
    `email` varchar(255) not null unique key,
    `tel` varchar(15) not null unique key,
    `password` varchar(255) not null,
    `role` enum ('Docente', 'Administrador') not null default 'Docente',
    `status` enum ('Activo', 'Inactivo') not null default 'Inactivo',
    `created_at` datetime not null default current_timestamp,
    `updated_at` datetime not null default current_timestamp on update current_timestamp
  ) engine = InnoDB default charset = utf8;

-- Table: `password_resets` (Restablecimiento de contraseña)
create table
  if not exists `password_resets` (
    `reset_id` int (11) not null auto_increment primary key,
    `user_id` int (11) not null,
    `token` varchar(255) not null unique key,
    `used` tinyint (1) not null default 0,
    `created_at` datetime not null default current_timestamp,
    `used_at` datetime null on update current_timestamp,
    `expires_at` datetime null,
    foreign key (`user_id`) references `users` (`user_id`) on delete cascade
  ) engine = InnoDB default charset = utf8;

-- Table: `subjects` (Materias)
create table
  if not exists `subjects` (
    `subject_id` int (11) not null auto_increment primary key,
    `subject_name` varchar(100) not null unique key,
    `created_at` datetime not null default current_timestamp,
    `updated_at` datetime not null default current_timestamp on update current_timestamp
  ) engine = InnoDB default charset = utf8;

-- Table: `careers` (Carreras) (Carreras de los grupos)
create table
  if not exists `careers` (
    `career_id` int (11) not null auto_increment primary key,
    `career_name` varchar(100) not null unique key,
    `created_at` datetime not null default current_timestamp,
    `updated_at` datetime not null default current_timestamp on update current_timestamp
  ) engine = InnoDB default charset = utf8;

-- Table: `groups` (Grupos) (Grupos de los docentes)
create table
  if not exists `groups` (
    `group_id` int (11) not null auto_increment primary key,
    `tutor_id` int (11) not null,
    `classroom` varchar(2) not null,
    `career_id` int (11) not null,
    `group_semester` int (11) not null,
    `group_letter` char(1) not null,
    `period` varchar(6) not null,
    `created_at` datetime not null default current_timestamp,
    `updated_at` datetime not null default current_timestamp on update current_timestamp,
    foreign key (`tutor_id`) references `users` (`user_id`) on delete cascade,
    foreign key (`career_id`) references `careers` (`career_id`) on delete cascade
  ) engine = InnoDB default charset = utf8;

-- Table: `students` (Alumnos) (Alumnos de los grupos)
create table
  if not exists `students` (
    `control_number` varchar(14) not null primary key,
    `curp` varchar(18) not null unique key,
    `first_name` varchar(100) not null,
    `last_name` varchar(100) not null,
    `generation` varchar(12) not null,
    `created_at` datetime not null default current_timestamp,
    `updated_at` datetime not null default current_timestamp on update current_timestamp
  ) engine = InnoDB default charset = utf8;

-- Table: `group_list` (Listas de los grupos) (Alumnos de los grupos) (Relación muchos a muchos) (Tabla pivote)
create table
  if not exists `group_list` (
    `list_id` int (11) not null auto_increment primary key,
    `group_id` int (11) not null,
    `control_number` varchar(14) not null,
    `created_at` datetime not null default current_timestamp,
    `updated_at` datetime not null default current_timestamp on update current_timestamp,
    foreign key (`group_id`) references `groups` (`group_id`) on delete cascade,
    foreign key (`control_number`) references `students` (`control_number`) on delete cascade
  ) engine = InnoDB default charset = utf8;

-- Table: `schedule` (Horarios) (Horarios de los grupos) (Horarios de los docentes) (Horarios de las materias) (Horarios de las asistencias) (Horarios de las faltas de los docentes)
create table
  if not exists `schedule` (
    `schedule_id` int (11) not null auto_increment primary key,
    `user_id` int (11) not null,
    `group_id` int (11) not null,
    `subject_id` int (11) not null,
    `day` enum (
      'Lunes',
      'Martes',
      'Miércoles',
      'Jueves',
      'Viernes'
    ) not null,
    `start_time` time not null,
    `end_time` time not null,
    `created_at` datetime not null default current_timestamp,
    `updated_at` datetime not null default current_timestamp on update current_timestamp,
    foreign key (`user_id`) references `users` (`user_id`) on delete cascade,
    foreign key (`group_id`) references `groups` (`group_id`) on delete cascade,
    foreign key (`subject_id`) references `subjects` (`subject_id`) on delete cascade
  ) engine = InnoDB default charset = utf8;

-- Table: `attendance` (Asistencias) (Asistencias de los alumnos)
create table
  if not exists `attendance` (
    `attendance_id` int (11) not null auto_increment primary key,
    `control_number` varchar(14) not null,
    `status` enum ('Presente', 'Ausente', 'Retardo', 'Justificado') not null,
    `report_id` int (11) null,
    foreign key (`report_id`) references `reports` (`report_id`) on delete cascade
  ) engine = InnoDB default charset = utf8;

-- Table: `reports` (Reportes) (Reportes de los grupos)
create table
  if not exists `reports` (
    `report_id` int (11) not null auto_increment primary key,
    `datetime` datetime not null default current_timestamp,
    `schedule_id` int (11) not null,
    `created_at` datetime not null default current_timestamp,
    `updated_at` datetime not null default current_timestamp on update current_timestamp,
    foreign key (`schedule_id`) references `schedule` (`schedule_id`) on delete cascade
  ) engine = InnoDB default charset = utf8;

-- Trigger `password_reset_expiration` (Restablecimiento de contraseña) (Establece la fecha de expiración de los tokens en 5 minutos después de la creación)
CREATE TRIGGER `password_reset_expiration` BEFORE INSERT ON `password_resets` FOR EACH ROW
SET
  NEW.`expires_at` = DATE_ADD (NEW.`created_at`, INTERVAL 5 MINUTE);