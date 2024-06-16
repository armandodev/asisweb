-- Crear la base de datos
create database `asisweb`;

-- Usar la base de datos
use `asisweb`;

-- Crear la tabla de usuarios (docentes y administradores)
create table
  `users` (
    `user_id` int not null auto_increment primary key,
    `name` varchar(100) not null,
    `email` varchar(100) not null,
    `tel` varchar(15) not null,
    `password` varchar(255) not null,
    `role` tinyint not null default 0,
    `status` tinyint not null default 0
  );

create table
  `email_codes` (
    `code_id` int not null auto_increment primary key,
    `user_id` int not null,
    `code` int not null,
    `used` tinyint not null default 0,
    `created_at` datetime not null default current_timestamp(),
    `expires_at` datetime default NULL,
    foreign key (`user_id`) references `users` (`user_id`) on delete cascade
  );

create trigger `email_codes_exp` before insert on `email_codes` for each row
set
  new.`expires_at` = date_add(new.`created_at`, interval 15 minute);

create table
  `students` (
    `control_number` varchar(14) not null primary key,
    `curp` varchar(18) not null unique,
    `first_name` varchar(100) not null,
    `last_name` varchar(100) not null,
    `generation` varchar(12) not null
  );

create table
  `group_list` (
    `list_id` int (11) not null primary key,
    `group_id` int (11) not null,
    `control_number` varchar(14) not null unique
  );

-- Insertar datos en la tabla de usuarios
INSERT INTO
  `users` (
    `name`,
    `email`,
    `tel`,
    `password`,
    `role`,
    `status`
  )
VALUES
  (
    'Ali Alexis Gálvez Trejo',
    'alialexis@gmail.com',
    '353 000 0001',
    '1234567890',
    0,
    1
  ),
  (
    'Angelica Verónica Arceo Granados',
    'angelicaveronica@gmail.com',
    '353 000 0002',
    '1234567890',
    0,
    1
  ),
  (
    'Víctor Hugo Lupián Tlalpan',
    'victorhugo@gmail.com',
    '353 000 0003',
    '1234567890',
    0,
    1
  ),
  (
    'Maritza Mendoza Gálvez ',
    'maritza@gmail.com',
    '353 000 0004',
    '1234567890',
    0,
    1
  ),
  (
    'Roberto López Buenrostro',
    'roberto@gmail.com',
    '353 000 0005',
    '1234567890',
    0,
    1
  ),
  (
    'Francisco Javier Silva García',
    'franciscojavier@gmail.com',
    '353 000 0006',
    '1234567890',
    0,
    1
  ),
  (
    'Patricia del Carmen Gutiérrez González ',
    'patricialdelcarmen@gmail.com',
    '353 000 0007',
    '1234567890',
    0,
    1
  ),
  (
    'Eréndira Guadalupe Ibarra Rodríguez ',
    'erendiraguadalupe@gmail.com',
    '353 000 0008',
    '1234567890',
    0,
    1
  ),
  (
    'Victor Hugo Sánchez Carcova',
    'victorhugosc@gmail.com',
    '353 000 0009',
    '1234567890',
    0,
    1
  ),
  (
    'Mónica Amparo Buenrostro Bautista',
    'monicaamparo@gmail.com',
    '353 000 0010',
    '1234567890',
    0,
    1
  ),
  (
    'Susana Elena Gámez Rodríguez',
    'susanaelena@gmail.com',
    '353 000 0011',
    '1234567890',
    0,
    1
  ),
  (
    'Jesús Manzo Gálvez',
    'jesus@gmail.com',
    '353 000 0012',
    '1234567890',
    0,
    1
  ),
  (
    'Jose Eduardo Martínez Martínez ',
    'joseeduardo@gmail.com',
    '353 000 0013',
    '1234567890',
    0,
    1
  ),
  (
    'Alejandra Mendoza Chávez ',
    'alejandra@gmail.com',
    '353 000 0014',
    '1234567890',
    0,
    1
  ),
  (
    'Francisco Javier Vargas Silva',
    'franciscojaviervs@gmail.com',
    '353 000 0015',
    '1234567890',
    0,
    1
  ),
  (
    'Ernesto Amezcua Montes',
    'ernesto@gmail.com',
    '353 000 0016',
    '1234567890',
    0,
    1
  ),
  (
    'Martha Isabel Gutiérrez Marinez',
    'marthaisabel@gmail.com',
    '353 000 0017',
    '1234567890',
    0,
    1
  ),
  (
    'Eliseo Suárez Campos',
    'eliseo@gmail.com',
    '353 000 0018',
    '1234567890',
    0,
    1
  ),
  (
    'Silvia Cristina Navarrete Marentes',
    'silviacristina@gmail.com',
    '353 000 0019',
    '1234567890',
    0,
    1
  ),
  (
    'Ana Rosalia Reyes Torres',
    'anarosalia@gmail.com',
    '353 000 0020',
    '1234567890',
    0,
    1
  ),
  (
    'Julio César Cervantes Valencia',
    'juliocesar@gmail.com',
    '353 000 0021',
    '1234567890',
    0,
    1
  ),
  (
    'Rosa Maria Mejía Acevedo',
    'rosamaria@gmail.com',
    '353 000 0022',
    '1234567890',
    0,
    1
  ),
  (
    'Gabriel Arturo Chávez Nuñez',
    'gabrielarturo@gmail.com',
    '353 000 0023',
    '1234567890',
    1,
    1
  ),
  (
    'Luis Alberto Sánchez Malta',
    'luisalberto@gmail.com',
    '353 000 0024',
    '1234567890',
    0,
    1
  ),
  (
    'Vidal Alcazar Cervantes',
    'vidal@gmail.com',
    '353 000 0025',
    '1234567890',
    0,
    1
  );