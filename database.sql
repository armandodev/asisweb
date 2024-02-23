create database if not exists `asisweb` default character
set
  utf8 collate utf8_general_ci;

use `asisweb`;

-- Table: `users` (Docentes)
create table
  if not exists `users` (
    `user_id` int (11) not null auto_increment primary key,
    `first_name` varchar(100) not null,
    `last_name` varchar(100) not null,
    `email` varchar(255) not null unique key,
    `phone_number` varchar(10) not null unique key,
    `hashed_password` varchar(255) not null,
    `salt` varchar(32) not null,
    `role` enum ('Docente', 'Administrador') not null default 'Docente',
    `status` enum ('Activo', 'Inactivo') not null default 'Inactivo',
    `created_at` datetime not null default current_timestamp,
    `updated_at` datetime not null default current_timestamp on update current_timestamp
  ) engine = InnoDB default charset = utf8;

-- Table: `extra_emails` (Correos extra de los docentes)
create table
  if not exists `extra_emails` (
    `email_id` int (11) not null auto_increment primary key,
    `user_id` int (11) not null,
    `extra_email` varchar(255) not null unique key,
    `created_at` datetime not null default current_timestamp,
    `updated_at` datetime not null default current_timestamp on update current_timestamp,
    foreign key (`user_id`) references `users` (`user_id`) on delete cascade
  ) engine = InnoDB default charset = utf8;

-- Table: `extra_phone_numbers` (Teléfonos extra de los docentes)
create table
  if not exists `extra_phone_numbers` (
    `phone_number_id` int (11) not null auto_increment primary key,
    `user_id` int (11) not null,
    `extra_phone_number` varchar(10) not null unique key,
    `created_at` datetime not null default current_timestamp,
    `updated_at` datetime not null default current_timestamp on update current_timestamp,
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

-- Table: `careers` (Carreras)
create table
  if not exists `careers` (
    `career_id` int (11) not null auto_increment primary key,
    `career_name` varchar(100) not null unique key,
    `created_at` datetime not null default current_timestamp,
    `updated_at` datetime not null default current_timestamp on update current_timestamp
  ) engine = InnoDB default charset = utf8;

-- Table: `groups` (Grupos)
create table
  if not exists `groups` (
    `group_id` int (11) not null auto_increment primary key,
    `classroom` varchar(2) not null,
    `career_id` int (11) not null,
    `group_semester` int (11) not null,
    `group_letter` char(1) not null,
    `start_date` date not null,
    `end_date` date not null,
    `created_at` datetime not null default current_timestamp,
    `updated_at` datetime not null default current_timestamp on update current_timestamp,
    foreign key (`career_id`) references `careers` (`career_id`) on delete cascade
  ) engine = InnoDB default charset = utf8;

-- Table: `students` (Alumnos)
create table
  if not exists `students` (
    `control_number` varchar(14) not null primary key,
    `group_id` int (11) not null,
    `curp` varchar(18) not null unique key,
    `first_name` varchar(100) not null,
    `last_name` varchar(100) not null,
    `created_at` datetime not null default current_timestamp,
    `updated_at` datetime not null default current_timestamp on update current_timestamp,
    foreign key (`group_id`) references `groups` (`group_id`) on delete cascade
  ) engine = InnoDB default charset = utf8;

-- Table: `tutors` (Tutores de los alumnos)
create table
  if not exists `tutors` (
    `tutor_id` int (11) not null auto_increment primary key,
    `control_number` varchar(14) not null,
    `first_name` varchar(100) not null,
    `last_name` varchar(100) not null,
    `email` varchar(255) null unique key,
    `phone_number` varchar(10) not null unique key,
    `created_at` datetime not null default current_timestamp,
    `updated_at` datetime not null default current_timestamp on update current_timestamp,
    foreign key (`control_number`) references `students` (`control_number`) on delete cascade
  ) engine = InnoDB default charset = utf8;

-- Table: `tutor_extra_emails` (Correos extra de los tutores)
create table
  if not exists `tutor_extra_emails` (
    `email_id` int (11) not null auto_increment primary key,
    `tutor_id` int (11) not null,
    `extra_email` varchar(255) not null unique key,
    `created_at` datetime not null default current_timestamp,
    `updated_at` datetime not null default current_timestamp on update current_timestamp,
    foreign key (`tutor_id`) references `tutors` (`tutor_id`) on delete cascade
  ) engine = InnoDB default charset = utf8;

-- Table: `tutor_extra_phone_numbers` (Teléfonos extra de los tutores)
create table
  if not exists `tutor_extra_phone_numbers` (
    `phone_number_id` int (11) not null auto_increment primary key,
    `tutor_id` int (11) not null,
    `extra_phone_number` varchar(10) not null unique key,
    `created_at` datetime not null default current_timestamp,
    `updated_at` datetime not null default current_timestamp on update current_timestamp,
    foreign key (`tutor_id`) references `tutors` (`tutor_id`) on delete cascade
  ) engine = InnoDB default charset = utf8;

-- Table: `group_list` (Lista de alumnos por grupo)
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

-- Table: `schedule` (Horarios)
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

-- Table: `attendance` (Asistencias)
create table
  if not exists `attendance` (
    `attendance_id` int (11) not null auto_increment primary key,
    `schedule_id` int (11) not null,
    `control_number` varchar(14) not null,
    `datetime` datetime not null,
    `status` enum ('Presente', 'Ausente', 'Retardo', 'Justificado') not null,
    `created_at` datetime not null default current_timestamp,
    `updated_at` datetime not null default current_timestamp on update current_timestamp,
    foreign key (`schedule_id`) references `schedule` (`schedule_id`) on delete cascade,
    foreign key (`control_number`) references `students` (`control_number`) on delete cascade
  ) engine = InnoDB default charset = utf8;

-- Table: `teacher_absences` (Faltas de los docentes) (Días que no tomaron asistencia)
create table
  if not exists `teacher_absences` (
    `absence_id` int (11) not null auto_increment primary key,
    `user_id` int (11) not null,
    `schedule_id` int (11) not null,
    `date` date not null,
    `status` enum ('Revisado', 'Pendiente') not null,
    `reported_at` datetime not null default current_timestamp,
    `updated_at` datetime not null default current_timestamp on update current_timestamp,
    foreign key (`user_id`) references `users` (`user_id`) on delete cascade
  ) engine = InnoDB default charset = utf8;

-- Inserción de datos
INSERT INTO
  `subjects` (`subject_name`)
VALUES
  ("Tutorías 6"),
  ("Desarrolla Aplicaciones Móviles de Android"),
  ("Desarrolla Aplicaciones Móviles de iOS");

INSERT INTO
  `careers` (`career_name`)
VALUES
  ("Programación");

INSERT INTO
  `groups` (
    `classroom`,
    `career_id`,
    `group_semester`,
    `group_letter`,
    `start_date`,
    `end_date`
  )
VALUES
  ("14", 1, 6, "A", "2024-02-6", "2024-06-16");

INSERT INTO
  `schedule` (
    `user_id`,
    `group_id`,
    `subject_id`,
    `day`,
    `start_time`,
    `end_time`
  )
VALUES
  (1, 1, 1, "Lunes", "08:00:00", "09:00:00"),
  (1, 1, 1, "Martes", "08:00:00", "09:00:00"),
  (1, 1, 1, "Miércoles", "08:00:00", "09:00:00"),
  (1, 1, 1, "Jueves", "08:00:00", "09:00:00"),
  (1, 1, 1, "Viernes", "08:00:00", "09:00:00");