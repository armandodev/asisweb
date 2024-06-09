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
    `status` tinyint not null default 0,
    `full_time` tinyint not null default 0
  );

-- Crear la tabla para almacenar los códigos de ingreso sin contraseña
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

-- Trigger para el campo `expires_at` de la tabla `email_codes`
create trigger `email_codes_exp` before insert on `email_codes` for each row
set
  new.`expires_at` = date_add (new.`created_at`, interval 15 minute);

-- Tabla para almacenar las carreras
create table
  `careers` (
    `career_id` int not null auto_increment primary key,
    `career_name` varchar(100) not null,
    `abbreviation` varchar(20) not null
  );

-- Tabla para almacenar las asignaturas
create table
  `subjects` (
    `subject_id` int not null auto_increment primary key,
    `subject_name` varchar(150) not null,
    `initialism` varchar(20) not null
  );

-- Tabla para almacenar los grupos
create table
  `groups` (
    `group_id` int not null auto_increment primary key,
    `classroom` varchar(2) not null,
    `career_id` int not null,
    `group_semester` int not null,
    `group_letter` char not null,
    `period` varchar(6) not null,
    foreign key (`career_id`) references `careers` (`career_id`) on delete cascade
  );

-- Tabla para almacenar los horarios de los usuarios
create table
  `schedule` (
    `schedule_id` int not null auto_increment primary key,
    `user_id` int not null,
    `group_id` int default NULL,
    `subject_id` int not null,
    `day` enum (
      'Lunes',
      'Martes',
      'Miércoles',
      'Jueves',
      'Viernes'
    ) not null,
    `start_time` time not null,
    foreign key (`user_id`) references `users` (`user_id`) on delete cascade,
    foreign key (`group_id`) references `groups` (`group_id`) on delete cascade,
    foreign key (`subject_id`) references `subjects` (`subject_id`) on delete cascade
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

-- Insertar datos en la tabla de carreras
INSERT INTO
  `careers` (`career_name`, `abbreviation`)
VALUES
  ('Administración de Recursos Humanos', ''),
  ('Componente Básico y Propedeutico', ''),
  ('Contabilidad', ''),
  ('Electricidad', ''),
  ('Ofimática', ''),
  ('Programación', ''),
  (
    'Soporte y Mantenimiento de Equipo de Cómputo',
    ''
  ),
  ('Trabajo Social', '');

-- Insertar datos en la tabla de asignaturas
INSERT INTO
  `subjects` (`subject_name`, `initialism`)
VALUES
  (
    'Aplica el Método de Promoción Social Comunitario',
    ''
  ),
  (
    'Aplica la Metodología de Desarrollo Rápido de Aplicaciones con Programación Orientada a Eventos',
    ''
  ),
  (
    'Aplica la Metodología Espiral con Programación Orientada a Objetos',
    'AME'
  ),
  ('Biología', ''),
  ('Cálculo Integral', ''),
  ('Ciencia, Tecnología, Sociedad y Valores', ''),
  ('Ciencias Sociales I', ''),
  (
    'Clasifica los Elementos Básicos de la Red LAN',
    ''
  ),
  (
    'Construye Bases de Datos Para Aplicaciones Web',
    'CBDPW'
  ),
  (
    'Contribuye a la Integración y Desarrollo del Personal en la Organización',
    ''
  ),
  ('Cultura Digital I', ''),
  (
    'Desarrolla Aplicaciones Web con Conexión a Bases de Datos',
    ''
  ),
  ('Diseña Bases de Datos Ofimáticas', ''),
  ('Diseña la Red LAN', ''),
  (
    'Diseña Material Didáctico para la Orientación Social',
    ''
  ),
  (
    'Diseña y Mantiene los Sistemas de Iluminación',
    ''
  ),
  ('Elabora Proyectos de Orientación Social', ''),
  ('Ética', ''),
  ('Física II', ''),
  (
    'Genera Información Fiscal de las Personas Físicas',
    ''
  ),
  (
    'Genera Información Fiscal de las Personas Morales',
    ''
  ),
  ('Geometría Analítica', ''),
  (
    'Gestiona Información Mediante el uso de Hojas De Calculo',
    ''
  ),
  (
    'Gestiona Información Mediante el uso de Procesadores De Texto',
    ''
  ),
  (
    'Gestiona Información Mediante el uso de Sistemas Manejadores De Bases De Datos Ofimáticas',
    ''
  ),
  (
    'Gestiona Información Mediante el uso de Software de Presentaciones',
    ''
  ),
  ('Humanidades I', ''),
  (
    'Implementa y Mantiene los Sistemas de Energía Renovable',
    ''
  ),
  ('Inglés I', ''),
  ('Inglés III', ''),
  ('Inglés V', ''),
  ('La Materia y sus Interacciones', ''),
  ('Lengua y Comunicación I', ''),
  ('Mantiene los Generadores de CA y CC', ''),
  ('Mantiene los Motores de CA y CC', ''),
  (
    'MÓDULO II. APLICA METODOLOGÍAS DE DESARROLLO DE SOFTWARE CON HERRAMIENTAS DE PROGRAMACIÓN VISUAL',
    ''
  ),
  (
    'MÓDULO II. GESTIONA INFORMACIÓN DE MANERA LOCAL',
    ''
  ),
  (
    'MÓDULO II. INTEGRA EL CAPITAL HUMANO A LA Organización',
    ''
  ),
  (
    'MÓDULO II. MANTIENE HARDWARE Y SOFTWARE EN EL EQUIPO DE CÓMPUTO',
    ''
  ),
  (
    'MÓDULO II. MANTIENE LOS MOTORES Y GENERADORES DE CA Y CC',
    ''
  ),
  (
    'MÓDULO II. OPERA LOS PROCESOS CONTABLES DENTRO DE UN SISTEMA ELECTRÓNICO',
    ''
  ),
  (
    'MÓDULO II. PROMUEVE EN LA COMUNIDAD SERVICIOS Y PROGRAMAS INSTITUCIONALES',
    ''
  ),
  (
    'MÓDULO IV. APOYA EN LA ATENCIÓN INDIVIDUALIZADA',
    ''
  ),
  (
    'MÓDULO IV. CONTROLA LOS PROCESOS Y SERVICIOS DE HIGIENE Y SEGURIDAD DEL CAPITAL HUMANO EN LA Organización',
    ''
  ),
  (
    'MÓDULO IV. DESARROLLA SOFTWARE DE APLICACIÓN WEB CON ALMACENAMIENTO PERSISTENTE DE DATOS',
    ''
  ),
  (
    'MÓDULO IV. DETERMINA LAS CONTRIBUCIONES FISCALES DE PERSONAS FÍSICAS Y MORALES',
    ''
  ),
  ('MÓDULO IV. DISEÑA REDES DE COMPUTADORAS', ''),
  (
    'MÓDULO IV. DISEÑA Y GESTIONA BASES DE DATOS OFIMÁTICAS',
    ''
  ),
  (
    'MÓDULO IV. DISEÑA Y MANTIENE LOS SISTEMAS DE ILUMINACIÓN Y DE ENERGÍA RENOVABLE',
    ''
  ),
  (
    'ORIENTA AL INDIVIDUO Y LO VINCULA A REDES SOCIALES DE APOYO PARA LA ATENCIÓN INDIVIDUALIZADA',
    ''
  ),
  ('PENSAMIENTO MATEMÁTICO I', ''),
  (
    'REALIZA EL ESTUDIO SOCIAL PARA LA ATENCIÓN INDIVIDUALIZADA',
    ''
  ),
  ('REALIZA EL PROCESO DE ADMISIÓN Y EMPLEO', ''),
  (
    'REALIZA MANTENIMIENTO A LAS INSTALACIONES ELÉCTRICAS RESIDENCIALES, COMERCIALES E INDUSTRIALES',
    ''
  ),
  ('REALIZA MANTENIMIENTO CORRECTIVO', ''),
  ('REALIZA MANTENIMIENTO PREVENTIVO', ''),
  ('RECURSOS SOCIO-EMOCIONALES I', ''),
  (
    'REGISTRA INFORMACIÓN CONTABLE EN FORMA ELECTRÓNICA',
    ''
  ),
  (
    'REGISTRA INFORMACIÓN DE LOS RECURSOS FINANCIEROS',
    ''
  ),
  (
    'REGISTRA INFORMACIÓN DE LOS RECURSOS MATERIALES',
    ''
  ),
  (
    'SUPERVISA EL CUMPLIMIENTO DE LAS MEDIDAS DE HIGIENE Y SEGURIDAD EN LA Organización',
    ''
  ),
  (
    'SUPERVISA EL CUMPLIMIENTO DE TAREAS Y PROCESOS PARA EVALUAR LA PRODUCTIVIDAD EN LA Organización',
    ''
  ),
  ('Tutorías', '');

-- Insertar datos en la tabla de grupos
INSERT INTO
  `groups` (
    `classroom`,
    `career_id`,
    `group_semester`,
    `group_letter`,
    `period`
  )
VALUES
  ('1', 2, 1, 'A', '2023-1'),
  ('2', 2, 1, 'B', '2023-1'),
  ('3', 2, 1, 'C', '2023-1'),
  ('4', 2, 1, 'D', '2023-1'),
  ('5', 2, 1, 'E', '2023-1'),
  ('6', 2, 1, 'F', '2023-1'),
  ('7', 2, 1, 'G', '2023-1'),
  ('8', 2, 1, 'H', '2023-1'),
  ('9', 2, 1, 'I', '2023-1'),
  ('10', 2, 1, 'J', '2023-1'),
  ('11', 1, 3, 'A', '2023-1'),
  ('12', 3, 3, 'A', '2023-1'),
  ('13', 4, 3, 'A', '2023-1'),
  ('14', 5, 3, 'A', '2023-1'),
  ('15', 6, 3, 'A', '2023-1'),
  ('16', 7, 3, 'A', '2023-1'),
  ('17', 8, 3, 'A', '2023-1'),
  ('18', 8, 3, 'B', '2023-1'),
  ('19', 1, 5, 'A', '2023-1'),
  ('20', 3, 5, 'A', '2023-1'),
  ('21', 4, 5, 'A', '2023-1'),
  ('22', 5, 5, 'A', '2023-1'),
  ('23', 6, 5, 'A', '2023-1'),
  ('24', 7, 5, 'A', '2023-1'),
  ('25', 8, 5, 'A', '2023-1');

-- Insertar datos en la tabla de horarios de los usuarios
INSERT INTO
  `schedule` (
    `user_id`,
    `group_id`,
    `subject_id`,
    `day`,
    `start_time`
  )
VALUES
  (23, 23, 9, 'Lunes', '07:00:00'),
  (23, 23, 9, 'Lunes', '08:00:00'),
  (23, 15, 3, 'Lunes', '10:00:00'),
  (23, 15, 3, 'Lunes', '11:00:00'),
  (23, 23, 63, 'Martes', '07:00:00'),
  (23, 23, 9, 'Martes', '08:00:00'),
  (23, 15, 3, 'Martes', '9:00:00'),
  (23, 15, 3, 'Martes', '10:00:00'),
  (23, 15, 3, 'Miércoles', '8:00:00'),
  (23, 15, 3, 'Miércoles', '9:00:00'),
  (23, 23, 63, 'Jueves', '07:00:00'),
  (23, 3, 11, 'Jueves', '08:00:00'),
  (23, 3, 11, 'Jueves', '09:00:00'),
  (23, 3, 11, 'Jueves', '10:00:00'),
  (23, 15, 3, 'Jueves', '12:00:00'),
  (23, 23, 9, 'Viernes', '08:00:00'),
  (23, 23, 9, 'Viernes', '09:00:00'),
  (23, 23, 9, 'Viernes', '10:00:00'),
  (23, 15, 3, 'Viernes', '11:00:00'),
  (23, 15, 3, 'Viernes', '12:00:00');