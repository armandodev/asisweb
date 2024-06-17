create database `asisweb`;

use `asisweb`;

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

create table
  `email_codes` (
    `code_id` int not null auto_increment primary key,
    `user_id` int not null references `users` (`user_id`) on delete cascade,
    `code` int not null,
    `used` tinyint not null default 0,
    `created_at` datetime not null default current_timestamp(),
    `expires_at` datetime default null
  );

create trigger `email_codes_exp` before insert on `email_codes` for each row
set
  new.`expires_at` = date_add(new.`created_at`, interval 5 minute);

create table
  `careers` (
    `career_id` int not null auto_increment primary key,
    `career_name` varchar(100) not null,
    `abbreviation` varchar(20) not null
  );

create table
  `groups` (
    `group_id` int not null primary key auto_increment,
    `classroom` varchar(2) not null,
    `career_id` int not null,
    `group_semester` int not null,
    `group_letter` char(1) not null,
    `period` varchar(6) not null
  );

create table
  `subjects` (
    `subject_id` int not null auto_increment primary key,
    `subject_name` varchar(150) not null,
    `initialism` varchar(20) not null
  );

CREATE TABLE
  `schedule` (
    `schedule_id` int not null auto_increment primary key,
    `user_id` int not null references `users` (`user_id`) on delete cascade,
    `group_id` int not null references `groups` (`group_id`) on delete cascade,
    `subject_id` int not null references `subjects` (`subject_id`) on delete cascade,
    `day` enum (
      'Lunes',
      'Martes',
      'Miércoles',
      'Jueves',
      'Viernes'
    ) not null,
    `start_time` time not null
  );

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
    `list_id` int not null primary key,
    `group_id` int not null,
    `control_number` varchar(14) not null unique
  );

create table
  `attendance` (
    `attendance_id` int not null auto_increment primary key,
    `control_number` varchar(14) not null references `students` (`control_number`) on delete cascade,
    `status` enum ('Presente', 'Ausente', 'Retardo', 'Justificado') not null,
    `report_id` int not null references `reports` (`report_id`) on delete cascade
  );

create table
  `reports` (
    `report_id` int not null auto_increment primary key,
    `group_id` int not null references `groups` (`group_id`) on delete cascade,
    `subject_id` int not null references `subjects` (`subject_id`) on delete cascade,
    `user_id` int not null references `users` (`user_id`) on delete cascade
  );

INSERT INTO
  `users` (
    `name`,
    `email`,
    `tel`,
    `password`,
    `role`,
    `status`,
    `full_time`
  )
VALUES
  (
    'Ali Alexis Gálvez Trejo',
    'alialexis@gmail.com',
    '353 000 0001',
    '1234567890',
    0,
    1,
    0
  ),
  (
    'Angelica Verónica Arceo Granados',
    'angelicaveronica@gmail.com',
    '353 000 0002',
    '1234567890',
    0,
    1,
    0
  ),
  (
    'Víctor Hugo Lupián Tlalpan',
    'victorhugo@gmail.com',
    '353 000 0003',
    '1234567890',
    0,
    1,
    0
  ),
  (
    'Maritza Mendoza Gálvez ',
    'maritza@gmail.com',
    '353 000 0004',
    '1234567890',
    0,
    1,
    0
  ),
  (
    'Roberto López Buenrostro',
    'roberto@gmail.com',
    '353 000 0005',
    '1234567890',
    0,
    1,
    0
  ),
  (
    'Francisco Javier Silva García',
    'franciscojavier@gmail.com',
    '353 000 0006',
    '1234567890',
    0,
    1,
    0
  ),
  (
    'Patricia del Carmen Gutiérrez González ',
    'patricialdelcarmen@gmail.com',
    '353 000 0007',
    '1234567890',
    0,
    1,
    0
  ),
  (
    'Eréndira Guadalupe Ibarra Rodríguez ',
    'erendiraguadalupe@gmail.com',
    '353 000 0008',
    '1234567890',
    0,
    1,
    0
  ),
  (
    'Victor Hugo Sánchez Carcova',
    'victorhugosc@gmail.com',
    '353 000 0009',
    '1234567890',
    0,
    1,
    0
  ),
  (
    'Mónica Amparo Buenrostro Bautista',
    'monicaamparo@gmail.com',
    '353 000 0010',
    '1234567890',
    0,
    1,
    0
  ),
  (
    'Susana Elena Gámez Rodríguez',
    'susanaelena@gmail.com',
    '353 000 0011',
    '1234567890',
    0,
    1,
    0
  ),
  (
    'Jesús Manzo Gálvez',
    'jesus@gmail.com',
    '353 000 0012',
    '1234567890',
    0,
    1,
    0
  ),
  (
    'Jose Eduardo Martínez Martínez ',
    'joseeduardo@gmail.com',
    '353 000 0013',
    '1234567890',
    0,
    1,
    0
  ),
  (
    'Alejandra Mendoza Chávez ',
    'alejandra@gmail.com',
    '353 000 0014',
    '1234567890',
    0,
    1,
    0
  ),
  (
    'Francisco Javier Vargas Silva',
    'franciscojaviervs@gmail.com',
    '353 000 0015',
    '1234567890',
    0,
    1,
    0
  ),
  (
    'Ernesto Amezcua Montes',
    'ernesto@gmail.com',
    '353 000 0016',
    '1234567890',
    0,
    1,
    0
  ),
  (
    'Martha Isabel Gutiérrez Marinez',
    'marthaisabel@gmail.com',
    '353 000 0017',
    '1234567890',
    0,
    1,
    0
  ),
  (
    'Eliseo Suárez Campos',
    'eliseo@gmail.com',
    '353 000 0018',
    '1234567890',
    0,
    1,
    0
  ),
  (
    'Silvia Cristina Navarrete Marentes',
    'silviacristina@gmail.com',
    '353 000 0019',
    '1234567890',
    0,
    1,
    0
  ),
  (
    'Ana Rosalia Reyes Torres',
    'anarosalia@gmail.com',
    '353 000 0020',
    '1234567890',
    0,
    1,
    0
  ),
  (
    'Julio César Cervantes Valencia',
    'juliocesar@gmail.com',
    '353 000 0021',
    '1234567890',
    0,
    1,
    0
  ),
  (
    'Rosa Maria Mejía Acevedo',
    'rosamaria@gmail.com',
    '353 000 0022',
    '1234567890',
    0,
    1,
    0
  ),
  (
    'Gabriel Arturo Chávez Nuñez',
    'gabrielarturo@gmail.com',
    '353 000 0023',
    '1234567890',
    1,
    1,
    1
  ),
  (
    'Luis Alberto Sánchez Malta',
    'luisalberto@gmail.com',
    '353 000 0024',
    '1234567890',
    0,
    1,
    0
  ),
  (
    'Vidal Alcazar Cervantes',
    'vidal@gmail.com',
    '353 000 0025',
    '1234567890',
    0,
    1,
    0
  );

INSERT INTO
  `careers`
VALUES
  (1, 'Administración de Recursos Humanos', ''),
  (2, 'Componente Básico y Propedeutico', ''),
  (3, 'Contabilidad', ''),
  (4, 'Electricidad', ''),
  (5, 'Ofimática', ''),
  (6, 'Programación', ''),
  (
    7,
    'Soporte y Mantenimiento de Equipo de Cómputo',
    ''
  ),
  (8, 'Trabajo Social', '');

INSERT INTO
  `groups`
VALUES
  (1, '1', 2, 1, 'A', '2023-1'),
  (2, '2', 2, 1, 'B', '2023-1'),
  (3, '3', 2, 1, 'C', '2023-1'),
  (4, '4', 2, 1, 'D', '2023-1'),
  (5, '5', 2, 1, 'E', '2023-1'),
  (6, '6', 2, 1, 'F', '2023-1'),
  (7, '7', 2, 1, 'G', '2023-1'),
  (8, '8', 2, 1, 'H', '2023-1'),
  (9, '9', 2, 1, 'I', '2023-1'),
  (10, '10', 2, 1, 'J', '2023-1'),
  (11, '11', 1, 3, 'A', '2023-1'),
  (12, '12', 3, 3, 'A', '2023-1'),
  (13, '13', 4, 3, 'A', '2023-1'),
  (14, '14', 5, 3, 'A', '2023-1'),
  (15, '15', 6, 3, 'A', '2023-1'),
  (16, '16', 7, 3, 'A', '2023-1'),
  (17, '17', 8, 3, 'A', '2023-1'),
  (18, '18', 8, 3, 'B', '2023-1'),
  (19, '19', 1, 5, 'A', '2023-1'),
  (20, '20', 3, 5, 'A', '2023-1'),
  (21, '21', 4, 5, 'A', '2023-1'),
  (22, '22', 5, 5, 'A', '2023-1'),
  (23, '23', 6, 5, 'A', '2023-1'),
  (24, '24', 7, 5, 'A', '2023-1'),
  (25, '25', 8, 5, 'A', '2023-1');

INSERT INTO
  `subjects`
VALUES
  (
    1,
    'Aplica el Método de Promoción Social Comunitario',
    ''
  ),
  (
    2,
    'Aplica la Metodología de Desarrollo Rápido de Aplicaciones con Programación Orientada a Eventos',
    ''
  ),
  (
    3,
    'Aplica la Metodología Espiral con Programación Orientada a Objetos',
    'AME'
  ),
  (4, 'Biología', ''),
  (5, 'Cálculo Integral', ''),
  (6, 'Ciencia, Tecnología, Sociedad y Valores', ''),
  (7, 'Ciencias Sociales I', ''),
  (
    8,
    'Clasifica los Elementos Básicos de la Red LAN',
    ''
  ),
  (
    9,
    'Construye Bases de Datos Para Aplicaciones Web',
    'CBDPW'
  ),
  (
    10,
    'Contribuye a la Integración y Desarrollo del Personal en la Organización',
    ''
  ),
  (11, 'Cultura Digital I', ''),
  (
    12,
    'Desarrolla Aplicaciones Web con Conexión a Bases de Datos',
    ''
  ),
  (13, 'Diseña Bases de Datos Ofimáticas', ''),
  (14, 'Diseña la Red LAN', ''),
  (
    15,
    'Diseña Material Didáctico para la Orientación Social',
    ''
  ),
  (
    16,
    'Diseña y Mantiene los Sistemas de Iluminación',
    ''
  ),
  (17, 'Elabora Proyectos de Orientación Social', ''),
  (18, 'Ética', ''),
  (19, 'Física II', ''),
  (
    20,
    'Genera Información Fiscal de las Personas Físicas',
    ''
  ),
  (
    21,
    'Genera Información Fiscal de las Personas Morales',
    ''
  ),
  (22, 'Geometría Analítica', ''),
  (
    23,
    'Gestiona Información Mediante el uso de Hojas De Calculo',
    ''
  ),
  (
    24,
    'Gestiona Información Mediante el uso de Procesadores De Texto',
    ''
  ),
  (
    25,
    'Gestiona Información Mediante el uso de Sistemas Manejadores De Bases De Datos Ofimáticas',
    ''
  ),
  (
    26,
    'Gestiona Información Mediante el uso de Software de Presentaciones',
    ''
  ),
  (27, 'Humanidades I', ''),
  (
    28,
    'Implementa y Mantiene los Sistemas de Energía Renovable',
    ''
  ),
  (29, 'Inglés I', ''),
  (30, 'Inglés III', ''),
  (31, 'Inglés V', ''),
  (32, 'La Materia y sus Interacciones', ''),
  (33, 'Lengua y Comunicación I', ''),
  (34, 'Mantiene los Generadores de CA y CC', ''),
  (35, 'Mantiene los Motores de CA y CC', ''),
  (
    36,
    'MÓDULO II. APLICA METODOLOGÍAS DE DESARROLLO DE SOFTWARE CON HERRAMIENTAS DE PROGRAMACIÓN VISUAL',
    ''
  ),
  (
    37,
    'MÓDULO II. GESTIONA INFORMACIÓN DE MANERA LOCAL',
    ''
  ),
  (
    38,
    'MÓDULO II. INTEGRA EL CAPITAL HUMANO A LA Organización',
    ''
  ),
  (
    39,
    'MÓDULO II. MANTIENE HARDWARE Y SOFTWARE EN EL EQUIPO DE CÓMPUTO',
    ''
  ),
  (
    40,
    'MÓDULO II. MANTIENE LOS MOTORES Y GENERADORES DE CA Y CC',
    ''
  ),
  (
    41,
    'MÓDULO II. OPERA LOS PROCESOS CONTABLES DENTRO DE UN SISTEMA ELECTRÓNICO',
    ''
  ),
  (
    42,
    'MÓDULO II. PROMUEVE EN LA COMUNIDAD SERVICIOS Y PROGRAMAS INSTITUCIONALES',
    ''
  ),
  (
    43,
    'MÓDULO IV. APOYA EN LA ATENCIÓN INDIVIDUALIZADA',
    ''
  ),
  (
    44,
    'MÓDULO IV. CONTROLA LOS PROCESOS Y SERVICIOS DE HIGIENE Y SEGURIDAD DEL CAPITAL HUMANO EN LA Organización',
    ''
  ),
  (
    45,
    'MÓDULO IV. DESARROLLA SOFTWARE DE APLICACIÓN WEB CON ALMACENAMIENTO PERSISTENTE DE DATOS',
    ''
  ),
  (
    46,
    'MÓDULO IV. DETERMINA LAS CONTRIBUCIONES FISCALES DE PERSONAS FÍSICAS Y MORALES',
    ''
  ),
  (47, 'MÓDULO IV. DISEÑA REDES DE COMPUTADORAS', ''),
  (
    48,
    'MÓDULO IV. DISEÑA Y GESTIONA BASES DE DATOS OFIMÁTICAS',
    ''
  ),
  (
    49,
    'MÓDULO IV. DISEÑA Y MANTIENE LOS SISTEMAS DE ILUMINACIÓN Y DE ENERGÍA RENOVABLE',
    ''
  ),
  (
    50,
    'ORIENTA AL INDIVIDUO Y LO VINCULA A REDES SOCIALES DE APOYO PARA LA ATENCIÓN INDIVIDUALIZADA',
    ''
  ),
  (51, 'PENSAMIENTO MATEMÁTICO I', ''),
  (
    52,
    'REALIZA EL ESTUDIO SOCIAL PARA LA ATENCIÓN INDIVIDUALIZADA',
    ''
  ),
  (53, 'REALIZA EL PROCESO DE ADMISIÓN Y EMPLEO', ''),
  (
    54,
    'REALIZA MANTENIMIENTO A LAS INSTALACIONES ELÉCTRICAS RESIDENCIALES, COMERCIALES E INDUSTRIALES',
    ''
  ),
  (55, 'REALIZA MANTENIMIENTO CORRECTIVO', ''),
  (56, 'REALIZA MANTENIMIENTO PREVENTIVO', ''),
  (57, 'RECURSOS SOCIO-EMOCIONALES I', ''),
  (
    58,
    'REGISTRA INFORMACIÓN CONTABLE EN FORMA ELECTRÓNICA',
    ''
  ),
  (
    59,
    'REGISTRA INFORMACIÓN DE LOS RECURSOS FINANCIEROS',
    ''
  ),
  (
    60,
    'REGISTRA INFORMACIÓN DE LOS RECURSOS MATERIALES',
    ''
  ),
  (
    61,
    'SUPERVISA EL CUMPLIMIENTO DE LAS MEDIDAS DE HIGIENE Y SEGURIDAD EN LA Organización',
    ''
  ),
  (
    62,
    'SUPERVISA EL CUMPLIMIENTO DE TAREAS Y PROCESOS PARA EVALUAR LA PRODUCTIVIDAD EN LA Organización',
    ''
  ),
  (63, 'Tutorías', '');

INSERT INTO
  `schedule`
VALUES
  (1, 23, 23, 9, 'Lunes', '07:00:00'),
  (2, 23, 23, 9, 'Lunes', '08:00:00'),
  (3, 23, 15, 3, 'Lunes', '10:00:00'),
  (4, 23, 15, 3, 'Lunes', '11:00:00'),
  (5, 23, 23, 63, 'Martes', '07:00:00'),
  (6, 23, 23, 9, 'Martes', '08:00:00'),
  (7, 23, 15, 3, 'Martes', '09:00:00'),
  (8, 23, 15, 3, 'Martes', '10:00:00'),
  (9, 23, 15, 3, 'Miércoles', '08:00:00'),
  (10, 23, 15, 3, 'Miércoles', '09:00:00'),
  (11, 23, 23, 63, 'Jueves', '07:00:00'),
  (12, 23, 3, 11, 'Jueves', '08:00:00'),
  (13, 23, 3, 11, 'Jueves', '09:00:00'),
  (14, 23, 3, 11, 'Jueves', '10:00:00'),
  (15, 23, 15, 3, 'Jueves', '12:00:00'),
  (16, 23, 23, 9, 'Viernes', '08:00:00'),
  (17, 23, 23, 9, 'Viernes', '09:00:00'),
  (18, 23, 23, 9, 'Viernes', '10:00:00'),
  (19, 23, 15, 3, 'Viernes', '11:00:00'),
  (20, 23, 15, 3, 'Viernes', '12:00:00');

INSERT INTO
  `students` (
    `control_number`,
    `curp`,
    `first_name`,
    `last_name`,
    `generation`
  )
VALUES
  (
    '19316061210278',
    'CXCA040223MMNMJRA5',
    'ARAISA GUADALUPE',
    'CAMPOS CEJA',
    '2019-2022'
  ),
  (
    '19316061210297',
    'NOGJ040514HMNTTSA1',
    'JESUS SANTIAGO',
    'NIETO GUTIERREZ',
    '2019-2022'
  ),
  (
    '19316061210416',
    'GUGN040512MMNDZTA2',
    'NATALI MICHELLE',
    'GUDIÑO GUIZAR',
    '2019-2022'
  ),
  (
    '20316050120230',
    'ZATJ050818HMNRRSA5',
    'JESUS EDUARDO',
    'ZARAGOZA TORRES',
    '2020-2023'
  ),
  (
    '20316050120250',
    'AAHF050213MQTVRTA2',
    'FATIMA SUSANA',
    'AVALOS HERNANDEZ',
    '2020-2023'
  ),
  (
    '20316050120338',
    'AAGP041216HMNYTLA8',
    'PAULO SANTIAGO',
    'AYALA GUTIERREZ',
    '2020-2023'
  ),
  (
    '20316061210052',
    'GUHJ050831HMNTRNA7',
    'JUAN PABLO',
    'GUTIERREZ HERNANDEZ',
    '2020-2023'
  ),
  (
    '20316061210079',
    'ROCJ050609HMNDHSA4',
    'JESUS ALEJANDRO',
    'RODRIGUEZ CHAVARRIA',
    '2020-2023'
  ),
  (
    '20316061210095',
    'CASE051112MMNSVVA7',
    'EVELYN GUADALUPE',
    'CASTILLO SAAVEDRA',
    '2020-2023'
  ),
  (
    '20316061210113',
    'GUNX051004MMNLTNA2',
    'XENIA ATZIMBA',
    'GUILLEN NIETO',
    '2020-2023'
  ),
  (
    '20316061210135',
    'SASE050208HMNNNDA1',
    'EDUARDO',
    'SANCHEZ SANDOVAL',
    '2020-2023'
  ),
  (
    '20316061210146',
    'AASY050311MMNVNMA8',
    'YAMILET',
    'AVALOS SANCHEZ',
    '2020-2023'
  ),
  (
    '20316061210157',
    'GURJ050416HMNTDSA2',
    'JESUS',
    'GUTIERREZ RODRIGUEZ',
    '2020-2023'
  ),
  (
    '20316061210166',
    'TOAA051012HMNRVNA5',
    'JOSE ANGEL',
    'TORRES AVALOS',
    '2020-2023'
  ),
  (
    '20316061210169',
    'MAFG050904MMNCLDA3',
    'MARIA GUADALUPE',
    'MACIAS FLORES',
    '2020-2023'
  ),
  (
    '20316061210172',
    'LOBF050526MMNPRTA2',
    'FATIMA ESTEFANIA',
    'LOPEZ BARRAGAN',
    '2020-2023'
  ),
  (
    '20316061210173',
    'MAMF050530MMNGRTA7',
    'FATIMA MONTSERRAT',
    'MAGALLON MORENO',
    '2020-2023'
  ),
  (
    '20316061210175',
    'EICL051029HMNNMSA9',
    'LUIS ANDRES',
    'ENCISO CAMPOS',
    '2020-2023'
  ),
  (
    '20316061210221',
    'MERB050403HJCJMRA9',
    'BRAYAN YAHIR',
    'MEJIA RAMIREZ',
    '2020-2023'
  ),
  (
    '20316061210222',
    'CEGA050608MMNRLLA2',
    'ALONDRA NICOL',
    'CERVANTES GIL',
    '2020-2023'
  ),
  (
    '20316061210226',
    'SAOE050126HMNNCDA8',
    'EDGAR FABIAN',
    'SANCHEZ OCHOA',
    '2020-2023'
  ),
  (
    '20316061210229',
    'ZAFW051126MJCPLNA1',
    'WENDY ADRIANA',
    'ZAPIEN FLORES',
    '2020-2023'
  ),
  (
    '20316061210254',
    'GIFC050323MMNLRLA3',
    'CLAUDIA LUCIA',
    'GIL FARIAS',
    '2020-2023'
  ),
  (
    '20316061210258',
    'AICA051213HMNVSDA3',
    'ADRIAN',
    'AVILA CASILLAS',
    '2020-2023'
  ),
  (
    '20316061210266',
    'DIRY031215MMNZDLA6',
    'YULIANA',
    'DIAZ RODRIGUEZ',
    '2020-2023'
  ),
  (
    '20316061210267',
    'MAGN041116MMNRNTA4',
    'NATALIA MONTSERRAT',
    'MARAVILLA GONZALEZ',
    '2020-2023'
  ),
  (
    '20316061210272',
    'GIMD050429MMNRRNA0',
    'DENISE GUADALUPE',
    'GRIMALDO MARTINEZ',
    '2020-2023'
  ),
  (
    '20316061210282',
    'GORR051207HMNMDCA1',
    'RICARDO FABIAN',
    'GOMEZ RODRIGUEZ',
    '2020-2023'
  ),
  (
    '21316050120160',
    'DIVR060330HMNZLMA9',
    'RAMIRO EMMANUEL',
    'DIAZ VALENCIA',
    '2021-2024'
  ),
  (
    '21316050120236',
    'COGN060226MMNNRTB7',
    'NATALIA YURITZIA',
    'CONTRERAS GARCIA',
    '2021-2024'
  ),
  (
    '21316050120238',
    'SICV050523MMNLSLA1',
    'VALERIA',
    'SILVA CASTELLANOS',
    '2021-2024'
  ),
  (
    '21316050120295',
    'GUGM060310MMNTNLA5',
    'MELANIE DANIELA',
    'GUTIERREZ GONZALEZ',
    '2021-2024'
  ),
  (
    '21316061210001',
    'AECR060417HMNCHDA0',
    'RODOLFO RAFAEL',
    'ACEVEDO CHAVEZ',
    '2021-2024'
  ),
  (
    '21316061210002',
    'AEXG060802MNERXDA8',
    'GUADALUPE',
    'ARCEO',
    '2021-2024'
  ),
  (
    '21316061210004',
    'AASJ060424HMNVLMA5',
    'JAIME',
    'AVALOS SALCEDO',
    '2021-2024'
  ),
  (
    '21316061210005',
    'AASD061128MMNVGLA3',
    'DULCE MARIA',
    'AVALOS SEGURA',
    '2021-2024'
  ),
  (
    '21316061210007',
    'AIMA061124MMNVGBA0',
    'MARIA ABIGAIL',
    'AVILA MAGAÑA',
    '2021-2024'
  ),
  (
    '21316061210009',
    'AAGS060126HMNYRNA2',
    'SANTIAGO',
    'AYALA GARCIA',
    '2021-2024'
  ),
  (
    '21316061210010',
    'AANC060531HMNYXRA7',
    'CRISTIAN DONOVAN',
    'AYALA NUÑEZ',
    '2021-2024'
  ),
  (
    '21316061210011',
    'AARF060227HMNYMRA9',
    'FRANCISCO JAVIER',
    'AYALA RAMIREZ',
    '2021-2024'
  ),
  (
    '21316061210012',
    'AARD061023MMNYVNA0',
    'DANIELA JULIANA',
    'AYALA RIVAS',
    '2021-2024'
  ),
  (
    '21316061210013',
    'BAVV060926HJCRCCA4',
    'VICTOR',
    'BARRAGAN VICTOR',
    '2021-2024'
  ),
  (
    '21316061210014',
    'CATS061008HMNMRLA4',
    'SAULO ESAU',
    'CAMPOS TORRES',
    '2021-2024'
  ),
  (
    '21316061210015',
    'CACU061013HMNRRLA7',
    'ULISES SAUL',
    'CARDENAS CORONA',
    '2021-2024'
  ),
  (
    '21316061210016',
    'CERF060312HMNJNRA5',
    'FERNANDO DAMIAN',
    'CEJA RENTERIA',
    '2021-2024'
  ),
  (
    '21316061210017',
    'CEMA060803HMNRRRA7',
    'JOSE ARMANDO',
    'CERNA MARTINEZ',
    '2021-2024'
  ),
  (
    '21316061210019',
    'CXCO060911HMNHSSA7',
    'OSCAR JESUS',
    'CHAVEZ CISNEROS',
    '2021-2024'
  ),
  (
    '21316061210020',
    'CAGJ060411MMNHTNA0',
    'JENIFER',
    'CHAVEZ GUTIERREZ',
    '2021-2024'
  ),
  (
    '21316061210021',
    'CAOC060713MMNHCLA8',
    'CLAUDIA XIMENA',
    'CHAVEZ OCHOA',
    '2021-2024'
  ),
  (
    '21316061210024',
    'EURA060809MMNSNSA4',
    'ASHLEE RUBI',
    'ESQUIVEL RENTERIA',
    '2021-2024'
  ),
  (
    '21316061210025',
    'FACJ051117HMNJRNA8',
    'JUAN PABLO',
    'FAJARDO CARDENAS',
    '2021-2024'
  ),
  (
    '21316061210026',
    'FOEL060323MMNLSZA1',
    'LIZANDRA',
    'FLORES ESTRADA',
    '2021-2024'
  ),
  (
    '21316061210028',
    'FUOA060821MMNRRNA9',
    'ANA CITLALI',
    'FRUTOS OROZCO',
    '2021-2024'
  ),
  (
    '21316061210032',
    'GARF060901MMNRDTA3',
    'FATIMA MELISSA',
    'GARCIA RODRIGUEZ',
    '2021-2024'
  ),
  (
    '21316061210033',
    'GOFB060315MMNNRRA7',
    'BRENDA YURIDIA',
    'GONZALEZ FRUTOS',
    '2021-2024'
  ),
  (
    '21316061210034',
    'GAHA060130HNERGNA7',
    'ANDREW',
    'GRANADOS HIGAREDA',
    '2021-2024'
  ),
  (
    '21316061210035',
    'GUZV061022MGTDPNA5',
    'VANIA MICHEL',
    'GUDIÑO ZAPIEN',
    '2021-2024'
  ),
  (
    '21316061210036',
    'GUIL060720MMNTBZA7',
    'LIZETH GUADALUPE',
    'GUTIERREZ IBARRA',
    '2021-2024'
  ),
  (
    '21316061210037',
    'GUVD060912HMNZZNA2',
    'JOSE DANIEL',
    'GUZMAN VAZQUEZ',
    '2021-2024'
  ),
  (
    '21316061210038',
    'GUVM060912HMNZZRA2',
    'MARIO EDUARDO',
    'GUZMAN VAZQUEZ',
    '2021-2024'
  ),
  (
    '21316061210039',
    'IAFF050612HMNBRRA3',
    'JOSE FRANCISCO',
    'IBARRA FRANCO',
    '2021-2024'
  ),
  (
    '21316061210041',
    'LORA060617HMNPDRA8',
    'JOSE ARMANDO',
    'LOPEZ RODRIGUEZ',
    '2021-2024'
  ),
  (
    '21316061210042',
    'LUSS060810MMNPNTA0',
    'STEPHANIE',
    'LUPIAN SANCHEZ',
    '2021-2024'
  ),
  (
    '21316061210043',
    'MAHE060315MMNNGLA6',
    'MARIA ELENA',
    'MANZO HIGAREDA',
    '2021-2024'
  ),
  (
    '21316061210044',
    'MOHA060427MMNRRNA3',
    'ANDREA',
    'MORENO HERNANDEZ',
    '2021-2024'
  ),
  (
    '21316061210045',
    'MUOJ050806MMNXRRA1',
    'JAREDI ESMERALDA',
    'MUÑOZ OROZCO',
    '2021-2024'
  ),
  (
    '21316061210046',
    'NAGR060222MMNVNSA5',
    'ROSA CELENE',
    'NAVARRETE GONZALEZ',
    '2021-2024'
  ),
  (
    '21316061210047',
    'NUHF060907HMNXRRA8',
    'JOSE FRANCISCO',
    'NUÑEZ HERRERA',
    '2021-2024'
  ),
  (
    '21316061210048',
    'OOSA061017HMNCNNA9',
    'JOSE ANGEL',
    'OCHOA SANCHEZ',
    '2021-2024'
  ),
  (
    '21316061210049',
    'PEAG060921HMCXVMA2',
    'GAMALIEL',
    'PEÑA AVALOS',
    '2021-2024'
  ),
  (
    '21316061210050',
    'RASA061118MMNMNNA0',
    'MARIA ANGELA',
    'RAMIREZ SANDOVAL',
    '2021-2024'
  ),
  (
    '21316061210051',
    'ROOF061224MMNCRRA4',
    'FRANEA GUADALUPE',
    'ROCHA ORTEGA',
    '2021-2024'
  ),
  (
    '21316061210052',
    'ROVJ060312HMNDLRA4',
    'JORGE OSWALDO',
    'RODRIGUEZ VALADES',
    '2021-2024'
  ),
  (
    '21316061210053',
    'ROGA060719HMNSNNA5',
    'ANGEL EDUARDO',
    'ROSAS GONZALEZ',
    '2021-2024'
  ),
  (
    '21316061210055',
    'SAVA060107MMNNVNA4',
    'ANA LILIANA',
    'SANCHEZ VIVAS',
    '2021-2024'
  ),
  (
    '21316061210057',
    'TOPL030930HMNRRSA9',
    'LUIS GERARDO',
    'TORRES PEREZ',
    '2021-2024'
  ),
  (
    '21316061210058',
    'VALG060120HMNLPRA8',
    'GERARDO',
    'VALENCIA LOPEZ',
    '2021-2024'
  ),
  (
    '21316061210060',
    'AALO060211HMNLPSA6',
    'OSVALDO',
    'ALCAZAR LOPEZ',
    '2021-2024'
  ),
  (
    '21316061210061',
    'AACM061107HMNYSGA7',
    'MIGUEL ANGEL',
    'AYALA CASTILLO',
    '2021-2024'
  ),
  (
    '21316061210062',
    'CAGK061120MMNBLRA6',
    'KAREN',
    'CABEZAS GALLEGOS',
    '2021-2024'
  ),
  (
    '21316061210064',
    'CAAY061124MMNRVLA3',
    'YULEIDI GABRIELA',
    'CARDENAS AVALOS',
    '2021-2024'
  ),
  (
    '21316061210065',
    'CABA050131MMNRLLA8',
    'ALEJANDRA',
    'CARDENAS BALTAZAR',
    '2021-2024'
  ),
  (
    '21316061210066',
    'AADR060907HMNNZLA2',
    'RAUL ANGEL',
    'ANDRADE DIAZ',
    '2021-2024'
  ),
  (
    '21316061210069',
    'FIGJ050329MMNGLCA6',
    'JACQUELINE GUADALUPE',
    'FIGUEROA GIL',
    '2021-2024'
  ),
  (
    '21316061210071',
    'GAOJ061123HMNRCNA4',
    'JUAN MANUEL',
    'GARCIA OCHOA',
    '2021-2024'
  ),
  (
    '21316061210072',
    'GURK060209MMNTJNA3',
    'KENIA SARAHI',
    'GUTIERREZ REJON',
    '2021-2024'
  ),
  (
    '21316061210074',
    'GUSR060818MMNTGSA4',
    'MARIA DEL ROSARIO',
    'GUTIERREZ SEGURA',
    '2021-2024'
  ),
  (
    '21316061210075',
    'GOLJ060101HMNNPVA5',
    'JAVIER',
    'GONZALEZ LOPEZ',
    '2021-2024'
  ),
  (
    '21316061210076',
    'HEGP061127HMNRMLA7',
    'PAOLO CESAR',
    'HERNANDEZ GOMEZ',
    '2021-2024'
  ),
  (
    '21316061210077',
    'SACS060427MMNNRNA2',
    'SONIA',
    'SANCHEZ CORONA',
    '2021-2024'
  ),
  (
    '21316061210078',
    'HEPJ060825HMNRLNA3',
    'JONATHAN',
    'HERNANDEZ PULIDO',
    '2021-2024'
  ),
  (
    '21316061210079',
    'SEAK060212MMNGRRA8',
    'KARLA DAYANA',
    'SEGURA ARROYO',
    '2021-2024'
  ),
  (
    '21316061210080',
    'SEGJ060419HMNGLSA7',
    'JESUS NOE',
    'SEGURA GIL',
    '2021-2024'
  ),
  (
    '21316061210081',
    'VANK061205HMNLVVA2',
    'KEVIN FABIAN',
    'VALDOVINOS NAVARRETE',
    '2021-2024'
  ),
  (
    '21316061210082',
    'LEBC051213MMNNTRA5',
    'MARIA CARMEN',
    'LEON BAUTISTA',
    '2021-2024'
  ),
  (
    '21316061210084',
    'VIMJ060412HMNLCSA3',
    'JESUS ALFONSO',
    'VILLANUEVA MACIAS',
    '2021-2024'
  ),
  (
    '21316061210085',
    'MECY060220MMNNHLA5',
    'YELITZZA ESTEFANIA',
    'MENDEZ CHAVARRIA',
    '2021-2024'
  ),
  (
    '21316061210086',
    'MORK060725MJCNJRA5',
    'KARLA GUADALUPE',
    'MONTAÑO ROJAS',
    '2021-2024'
  ),
  (
    '21316061210087',
    'ZUGJ061203HMNXDSA8',
    'JESUS ADRIAN',
    'ZUÑIGA GUDIÑO',
    '2021-2024'
  ),
  (
    '21316061210088',
    'NAXP061215MNEVXMA2',
    'PAMELA',
    'NAVARRO',
    '2021-2024'
  ),
  (
    '21316061210089',
    'NUHA061120HMNXRLA3',
    'ALAN RICARDO',
    'NUÑEZ HERNANDEZ',
    '2021-2024'
  ),
  (
    '21316061210091',
    'AIAE060202MMNVYVA2',
    'EVELYN',
    'AVILA AYALA',
    '2021-2024'
  ),
  (
    '21316061210092',
    'AAZY060127MMNVPJA8',
    'YAJAHIRA',
    'AVALOS ZAPIEN',
    '2021-2024'
  ),
  (
    '21316061210093',
    'CAGI060924HMNSTVA6',
    'IVAN JESUS',
    'CASTAÑEDA GUTIERREZ',
    '2021-2024'
  ),
  (
    '21316061210094',
    'CAVA041017HMNRLLA0',
    'ALEJANDRO',
    'CARDENAS VILLANUEVA',
    '2021-2024'
  ),
  (
    '21316061210095',
    'CXCA060609MMNSMRA4',
    'ARACELI',
    'CASTILLO CAMARENA',
    '2021-2024'
  ),
  (
    '21316061210097',
    'CEYF060303MMNJXLA1',
    'FLOR MAGALI',
    'CEJA YEO',
    '2021-2024'
  ),
  (
    '21316061210098',
    'LOAL060303HMNPYSA9',
    'LUIS CARLOS',
    'LOPEZ AYALA',
    '2021-2024'
  ),
  (
    '21316061210101',
    'SAHJ060723HMNNRSA7',
    'JESUS SANTIAGO',
    'SANCHEZ HERNANDEZ',
    '2021-2024'
  ),
  (
    '21316061210102',
    'TOCA060720MMNRHNA3',
    'ANDREA LETICIA',
    'TORRES CHAVEZ',
    '2021-2024'
  ),
  (
    '21316061210103',
    'CEAN061226MMNJVTA4',
    'NATALIA',
    'CEJA AVALOS',
    '2021-2024'
  ),
  (
    '21316061210104',
    'GACS060624HMNRHNA0',
    'SANTIAGO',
    'GARCIA CHAVEZ',
    '2021-2024'
  ),
  (
    '21316061210105',
    'GAMF060311MMNRGTA3',
    'FATIMA PAOLA',
    'GRANADOS MAGALLON',
    '2021-2024'
  ),
  (
    '21316061210107',
    'MERX060517MMNNNMA1',
    'XIMENA',
    'MENDEZ RENTERIA',
    '2021-2024'
  ),
  (
    '21316061210108',
    'MUGE060505MMNNDGA0',
    'EUGENIA',
    'MUNGUIA GUDIÑO',
    '2021-2024'
  ),
  (
    '21316061210109',
    'SAZY060713MMNNMDA5',
    'YADIRA GUADALUPE',
    'SANDOVAL ZAMORA',
    '2021-2024'
  ),
  (
    '21316061210111',
    'VITR060709HJCLRBA1',
    'ROBERTO CARLOS',
    'VILLANUEVA TRUJILLO',
    '2021-2024'
  ),
  (
    '21316061210113',
    'PIAL060806MMNNRYA1',
    'LYTZI DANIELA',
    'PINEDA ARTEAGA',
    '2021-2024'
  ),
  (
    '21316061210115',
    'SAAF061210MMNNVRA6',
    'FERNANDA GUADALUPE',
    'SANTILLAN AVALOS',
    '2021-2024'
  ),
  (
    '21316061210116',
    'GOHD060626MMNNRNA8',
    'DENISSE MARGARITA',
    'GONZALEZ HERNANDEZ',
    '2021-2024'
  ),
  (
    '21316061210117',
    'RAGA061005MMNZLLA0',
    'ALEXA DANIELA',
    'RAZO GALVEZ',
    '2021-2024'
  ),
  (
    '21316061210119',
    'OOSV060410MMNCNLA6',
    'VALERIA JACQUELINE',
    'OCHOA SANCHEZ',
    '2021-2024'
  ),
  (
    '21316061210120',
    'AAOI061006MMNVSTA2',
    'ITZEL',
    'AVALOS OSEGUERA',
    '2021-2024'
  ),
  (
    '21316061210121',
    'MASV061107HMNDLCA3',
    'VICTOR DANIEL',
    'MADRIGAL SILVA',
    '2021-2024'
  ),
  (
    '21316061210123',
    'HIPM060916MMNGDLA8',
    'MELANI',
    'HIGAREDA PADILLA',
    '2021-2024'
  ),
  (
    '21316061210124',
    'SAAJ061217HMNNYRA1',
    'JARED EMMANUEL',
    'SANCHEZ AYALA',
    '2021-2024'
  ),
  (
    '21316061210125',
    'NUSE061205MMNXLRA2',
    'ERENDIRA GUADALUPE',
    'NUÑEZ SILVA',
    '2021-2024'
  ),
  (
    '21316061210126',
    'NUGF061027MMNXLTA3',
    'FATIMA',
    'NUÑEZ GALVEZ',
    '2021-2024'
  ),
  (
    '21316061210128',
    'BAOF060316MJCSRRA0',
    'MARIA FERNANDA',
    'BASULTO ORTEGA',
    '2021-2024'
  ),
  (
    '21316061210131',
    'AECM060609MMNRRRA1',
    'MARIANA GUADALUPE',
    'ARCEO CERVANTES',
    '2021-2024'
  ),
  (
    '21316061210132',
    'GUNC060417HMNTXHA7',
    'CHRISTOPHER',
    'GUTIERREZ NUÑEZ',
    '2021-2024'
  ),
  (
    '21316061210133',
    'ZASS060924HMNPNNA1',
    'SANTIAGO',
    'ZAPIEN SANCHEZ',
    '2021-2024'
  ),
  (
    '21316061210134',
    'ROAJ060708MMNDVCA2',
    'JACQUELINE',
    'RODRIGUEZ AVALOS',
    '2021-2024'
  ),
  (
    '21316061210135',
    'DIAK050625MMNZYRA2',
    'KARLA REGINA',
    'DIAZ AYALA',
    '2021-2024'
  ),
  (
    '21316061210136',
    'RECJ060807HMNYJRA9',
    'JORGE SANTIAGO',
    'REYES CEJA',
    '2021-2024'
  ),
  (
    '21316061210137',
    'MASE051006MMNNRVA8',
    'EVELYN ALEJANDRA',
    'MANZO SORIA',
    '2021-2024'
  ),
  (
    '21316061210138',
    'ZAAF060531MMNPLTA3',
    'FATIMA JAZMIN',
    'ZAPIEN ALVAREZ',
    '2021-2024'
  ),
  (
    '21316061210139',
    'NASL061203HMNVNSA1',
    'LUIS ANGEL',
    'NAVARRETE SANCHEZ',
    '2021-2024'
  ),
  (
    '21316061210141',
    'SAOG051222HMNVLRA5',
    'GERARDO JAVIER',
    'SAAVEDRA OLIVEROS',
    '2021-2024'
  ),
  (
    '21316061210142',
    'SAEK060210MMNNCRA9',
    'KARLA ELIZABETH',
    'SANCHEZ ECHEGOYEN',
    '2021-2024'
  ),
  (
    '21316061210143',
    'OOBJ060702HMNCRSA4',
    'JESUS EDUARDO',
    'OCHOA BARRAGAN',
    '2021-2024'
  ),
  (
    '21316061210144',
    'AAZA050506MMNVRNA1',
    'ANA BELEN',
    'AVALOS ZARAGOZA',
    '2021-2024'
  ),
  (
    '21316061210145',
    'BUMJ061202HMNNNLA0',
    'JOSE JULIAN',
    'BUENROSTRO MANZO',
    '2021-2024'
  ),
  (
    '21316061210146',
    'GUTJ060228HMNDFRA1',
    'JORDI CESAR',
    'GUDIÑO TAFOYA',
    '2021-2024'
  ),
  (
    '21316061210147',
    'VIHA060104MMNCGNA0',
    'ANA PAOLA',
    'VICTOR HIGAREDA',
    '2021-2024'
  ),
  (
    '21316061210148',
    'HECY060215MMNRHRA4',
    'YURIDIA',
    'HERNANDEZ CHAVEZ',
    '2021-2024'
  ),
  (
    '21316061210149',
    'FONA060706MMNLVLA4',
    'ALEXA YARET',
    'FLORES NAVARRO',
    '2021-2024'
  ),
  (
    '21316061210151',
    'IAVJ060703HMNBRSA5',
    'JESUS YAEL',
    'IBARRA VARGAS',
    '2021-2024'
  ),
  (
    '21316061210153',
    'HESI061002HMNRNVA8',
    'IVAN ALEXANDER',
    'HERNANDEZ SANCHEZ',
    '2021-2024'
  ),
  (
    '21316061210154',
    'TOSA060218MJCRLLA1',
    'ALICIA DEL CARMEN',
    'TORRES SALAZAR',
    '2021-2024'
  ),
  (
    '21316061210155',
    'CACE060611MMNBHRA4',
    'ERICKA',
    'CABEZAS CHAVEZ',
    '2021-2024'
  ),
  (
    '21316061210158',
    'GAAG060812HMNLRSA6',
    'GUSTAVO ANGEL',
    'GALVEZ ARCEO',
    '2021-2024'
  ),
  (
    '21316061210159',
    'RERF060123MMNYMRA4',
    'FRANEA PAULINA',
    'REYES RAMIREZ',
    '2021-2024'
  ),
  (
    '21316061210160',
    'HEFJ061004HMNRLNA4',
    'JUAN CARLOS',
    'HERNANDEZ FLORES',
    '2021-2024'
  ),
  (
    '21316061210161',
    'CAMD060922MMNBGRA1',
    'DORA ALICIA',
    'CABEZAS MAGAÑA',
    '2021-2024'
  ),
  (
    '21316061210163',
    'FORR060622HMNLDGA2',
    'ROGELIO',
    'FLORES RODRIGUEZ',
    '2021-2024'
  ),
  (
    '21316061210164',
    'MELA061001MJCNPNA2',
    'ANGELINA',
    'MENDOZA LOPEZ',
    '2021-2024'
  ),
  (
    '21316061210166',
    'VIME060316HMNLNDA7',
    'EDUARDO',
    'VILLASEÑOR MENDOZA',
    '2021-2024'
  ),
  (
    '21316061210168',
    'AASJ060108MMNLSLA8',
    'JULISSA GUADALUPE',
    'ALCAZAR SOSA',
    '2021-2024'
  ),
  (
    '21316061210169',
    'GAMA060902MNERLNA1',
    'ANA PAOLA',
    'GRANADOS MELGOZA',
    '2021-2024'
  ),
  (
    '21316061210170',
    'SAOM060127MMNNRRA7',
    'MARIELA JUDITH',
    'SANCHEZ ORNELAS',
    '2021-2024'
  ),
  (
    '21316061210171',
    'GAJC060603HMNRRSA0',
    'CESAR GABRIEL',
    'GARCIA JARA',
    '2021-2024'
  ),
  (
    '21316061210172',
    'EIGL060726MMNLRLA4',
    'LEILANI GUADALUPE',
    'ELISEA GRANADOS',
    '2021-2024'
  ),
  (
    '21316061210173',
    'COGL060829MMNRRZA3',
    'LIZETH',
    'CORTES GRANADOS',
    '2021-2024'
  ),
  (
    '21316061210174',
    'FALA061230HMNJPDA6',
    'ADRIAN',
    'FAJARDO LOPEZ',
    '2021-2024'
  ),
  (
    '21316061210175',
    'OOZJ060114MMNCRNA0',
    'JENIFER GUADALUPE',
    'OCHOA ZARATE',
    '2021-2024'
  ),
  (
    '21316061210176',
    'MACB050314MMNNJRA0',
    'BRENDA LIZBETH',
    'MANZO CEJA',
    '2021-2024'
  ),
  (
    '21316061210179',
    'AUCB060427HMNGJRA3',
    'BRYAN GIOVANNI',
    'AGUILAR CEJA',
    '2021-2024'
  ),
  (
    '21316061210181',
    'HETR060328MMNRRTA3',
    'RUTH YARED',
    'HERNANDEZ TREJO',
    '2021-2024'
  ),
  (
    '21316061210182',
    'AIPC060724HMNVRRA3',
    'CARLOS ABRAHAM',
    'AVILA PEREZ',
    '2021-2024'
  ),
  (
    '21316061210183',
    'FOOS060626MMNLRRA3',
    'SARA NOEMI',
    'FLORES ORTIZ',
    '2021-2024'
  ),
  (
    '21316061210184',
    'MAHJ060530HMNCGNA3',
    'JONATHAN JAVIER',
    'MACIEL HIGAREDA',
    '2021-2024'
  ),
  (
    '21316061210185',
    'OOHS041105HMNCGNA7',
    'SANTIAGO',
    'OCHOA HIGAREDA',
    '2021-2024'
  ),
  (
    '21316061210187',
    'MOGM060227MMNRNNA1',
    'MONICA',
    'MORENO GONZALEZ',
    '2021-2024'
  ),
  (
    '21316061210188',
    'GOCR060610MMNMHCA9',
    'ROCIO GUADALUPE',
    'GOMEZ CHAVEZ',
    '2021-2024'
  ),
  (
    '21316061210189',
    'RAOE061009MNEMCSA9',
    'ESTEFANIE',
    'RAMIREZ OCHOA',
    '2021-2024'
  ),
  (
    '21316061210190',
    'CECK061023MMNRJRA9',
    'KAREN DANIELA',
    'CERNA CEJA',
    '2021-2024'
  ),
  (
    '21316061210191',
    'VEGB060704HMNGDRA0',
    'BRYAN RAUL',
    'VEGA GODOY',
    '2021-2024'
  ),
  (
    '21316061210192',
    'SAOA060508HMNNCNA3',
    'ANGEL JARED',
    'SANCHEZ OCHOA',
    '2021-2024'
  ),
  (
    '21316061210193',
    'TOHY060217MMNRRZA7',
    'YAZMIN ALEJANDRA',
    'DEL TORO HERNANDEZ',
    '2021-2024'
  ),
  (
    '21316061210195',
    'HEAL060922MMCRYZA6',
    'LUZ XIMENA',
    'HERNANDEZ AYALA',
    '2021-2024'
  ),
  (
    '21316061210196',
    'PECD061030HMNRRGA9',
    'DIEGO NOE',
    'PEREZ CERNA',
    '2021-2024'
  ),
  (
    '21316061210197',
    'JAMJ060425HMNRNSA7',
    'JESUS ARTURO',
    'JAUREGUI MANZO',
    '2021-2024'
  ),
  (
    '21316061210198',
    'MUFD061119MMNNRNA6',
    'DANIELA',
    'MUNGUIA FRAYLE',
    '2021-2024'
  ),
  (
    '21316061210199',
    'TENR060926HMNLVLA9',
    'RAUL ALEJANDRO',
    'TELLEZ NAVARRO',
    '2021-2024'
  ),
  (
    '21316061210201',
    'GORM060609MMNNNLA6',
    'MELANIE AIDEE',
    'GONZALEZ RENTERIA',
    '2021-2024'
  ),
  (
    '21316061210202',
    'CEBA061204MMNRRNA3',
    'ANA ROCIO',
    'CERVANTES BARRAGAN',
    '2021-2024'
  ),
  (
    '21316061210203',
    'GUGJ060420HNEDTVA0',
    'JOVANY EDUARDO',
    'GUDINO GUTIERREZ',
    '2021-2024'
  ),
  (
    '21316061210205',
    'SASG061231HMNNNLA5',
    'GUILLERMO',
    'SANDOVAL SANCHEZ',
    '2021-2024'
  ),
  (
    '21316061210206',
    'GOWE060210MMNMTMA5',
    'EMILIA',
    'GOMEZ WUITRON',
    '2021-2024'
  ),
  (
    '21316061210207',
    'CECF060923MMNRSRA7',
    'MARIA FERNANDA',
    'CERVANTES CASTELLANOS',
    '2021-2024'
  ),
  (
    '21316061210208',
    'EIBF041219MMNLRTA9',
    'FATIMA VANESSA',
    'ELISEA BARAJAS',
    '2021-2024'
  ),
  (
    '21316061210209',
    'TOGR050118MMNRNSA4',
    'ROSA XIMENA',
    'TORO GONZALEZ',
    '2021-2024'
  ),
  (
    '21316061210211',
    'NUHE040905HMNXGDA0',
    'EDGAR FABIAN',
    'NUÑEZ HIGAREDA',
    '2021-2024'
  ),
  (
    '21316061210212',
    'DIZD061028MMNZMLA8',
    'DELAIMY ITZEL',
    'DIAZ ZAMORA',
    '2021-2024'
  ),
  (
    '21316061210213',
    'REGN060221MMNYNYA8',
    'NAYDELIN ELIZABETH',
    'REYES GONZALEZ',
    '2021-2024'
  ),
  (
    '21316061210216',
    'GAOP060927MMNRRLA9',
    'PAOLA MARIA',
    'GARCIA ORTEGA',
    '2021-2024'
  ),
  (
    '21316061210217',
    'MAAP051204MMNNVLA5',
    'PAOLA SOFIA',
    'MANZO AVALOS',
    '2021-2024'
  ),
  (
    '21316061210218',
    'GALL060217HMNRPSA9',
    'LUIS ALEJANDRO',
    'GARCIA LOPEZ',
    '2021-2024'
  ),
  (
    '21316061210220',
    'PARA061126MMNRDNA0',
    'ANGELA ISABEL',
    'PARTIDA RODRIGUEZ',
    '2021-2024'
  ),
  (
    '21316061210223',
    'GASM061124HMNRNGA3',
    'MIGUEL ANGEL',
    'GARCIA SANCHEZ',
    '2021-2024'
  ),
  (
    '21316061210224',
    'JAGS050426HDFRTNA8',
    'SANTIAGO DE JESUS',
    'JARDINEZ GUTIERREZ',
    '2021-2024'
  ),
  (
    '21316061210225',
    'SAVJ061206MMNNGQA7',
    'JAQUELINE',
    'SANCHEZ VEGA',
    '2021-2024'
  ),
  (
    '21316061210226',
    'CAOJ061122HMNBNNA6',
    'JONATHAN DAVID',
    'CABEZAS ONOFRE',
    '2021-2024'
  ),
  (
    '21316061210229',
    'LOZD060602HMNZRGA6',
    'DIEGO',
    'LOZA ZARAGOZA',
    '2021-2024'
  ),
  (
    '21316061210231',
    'AAOY060418HMNYCHA9',
    'YAHIR',
    'AYALA OCHOA',
    '2021-2024'
  ),
  (
    '21316061210235',
    'CASJ060227HMNHNSA0',
    'JOSE DE JESUS',
    'CHAPA SANCHEZ',
    '2021-2024'
  ),
  (
    '21316061210237',
    'MAHS060908HMNRGRA2',
    'SERGIO',
    'MARTINEZ HIGAREDA',
    '2021-2024'
  ),
  (
    '21316061210238',
    'GAOC060917HMNLNRA3',
    'COREY GUILLERMO',
    'GALINDO ONOFRE',
    '2021-2024'
  ),
  (
    '21316061210242',
    'ROOF060202MMNDCTA7',
    'FATIMA',
    'RODRIGUEZ OCHOA',
    '2021-2024'
  ),
  (
    '21316061210244',
    'MAMY050307MMNRNZA8',
    'YAZMIN GUADALUPE',
    'MARTINEZ MENDOZA',
    '2021-2024'
  ),
  (
    '21316061210247',
    'GOGO060512HMNMLCA7',
    'OCTAVIO',
    'GOMEZ GALVEZ',
    '2021-2024'
  ),
  (
    '21316061210252',
    'SAHJ020723MMCNGSA3',
    'JOSELINE',
    'SANCHEZ HIGAREDA',
    '2021-2024'
  ),
  (
    '21316061210253',
    'SAHJ041008MDFNGSA2',
    'JESSICA',
    'SANCHEZ HIGAREDA',
    '2021-2024'
  ),
  (
    '21316061210254',
    'FOSB060207HMNLNRA4',
    'BRAULIO CESAR',
    'FLORES SANCHEZ',
    '2021-2024'
  ),
  (
    '21316061210255',
    'LOAJ061020MMNPYCA8',
    'JOCELYN',
    'LOPEZ AYAR',
    '2021-2024'
  ),
  (
    '21316061210257',
    'BAFM060611HMNRLRA3',
    'JOSE MARIA',
    'BARRAGAN FLORES',
    '2021-2024'
  ),
  (
    '21316061210259',
    'OEGE060225HMNRLDA0',
    'EDUARDO SAID',
    'ORNELAS GALVEZ',
    '2021-2024'
  ),
  (
    '21316061210266',
    'EICA060422HMNSJNA2',
    'ANGEL JULIAN',
    'ESPINOZA CEJA',
    '2021-2024'
  ),
  (
    '21316061210267',
    'SAPJ060813MMNNRNA0',
    'JENNIFER JOCELYN',
    'SANCHEZ PRADO',
    '2021-2024'
  ),
  (
    '21316061210268',
    'HEPF050328MMNRNTA5',
    'FATIMA GUADALUPE',
    'HERNANDEZ PANTOJA',
    '2021-2024'
  ),
  (
    '21316061210271',
    'SEOP060713MMNGCMA6',
    'PAMELA RENATA',
    'SEGURA OCHOA',
    '2021-2024'
  ),
  (
    '21316061210279',
    'CECJ061014HMNRRRA9',
    'JORGE ARMANDO',
    'CERAS CARDENAS',
    '2021-2024'
  ),
  (
    '21316061210281',
    'AAOO040525HMNYCMA6',
    'OMAR HABIB',
    'AYALA OCHOA',
    '2021-2024'
  ),
  (
    '21316061210282',
    'RECJ060825HMNNZNA4',
    'JUAN JESUS',
    'RENTERIA CAZARES',
    '2021-2024'
  ),
  (
    '21316061210286',
    'GORJ061129HMNNMSA4',
    'JOSUE FERNANDO',
    'GONZALEZ RAMIREZ',
    '2021-2024'
  ),
  (
    '21316061210287',
    'AAME061225MMNLXSA5',
    'ESTEPHANY JOSELINE',
    'ALVAREZ MUÑOZ',
    '2021-2024'
  ),
  (
    '21316061210290',
    'AALF061114MMNLPRA1',
    'MARIA FERNANDA',
    'ALCAZAR LOPEZ',
    '2021-2024'
  ),
  (
    '21316061210291',
    'PEAG061202MMNRVDA9',
    'MARIA GUADALUPE',
    'PEREZ AVILA',
    '2021-2024'
  ),
  (
    '21316061210292',
    'GAOO060510HMNRCSA1',
    'OSCAR ARTURO',
    'GRANADOS OCHOA',
    '2021-2024'
  ),
  (
    '21316061210297',
    'TOGN060125MMNRRDA1',
    'NIDIA LETICIA',
    'TORRES GRANADOS',
    '2021-2024'
  ),
  (
    '21316061210298',
    'BAMK060704MDFNCRA5',
    'KARLA',
    'BAENA MACIAS',
    '2021-2024'
  ),
  (
    '22316050120109',
    'SAOB070703MGTNCKA7',
    'BEKA ARIADNE',
    'SANTILLAN OCHOA',
    '2022-2025'
  ),
  (
    '22316050120336',
    'VACE060122HMNLJDA7',
    'JOSE EDUARDO',
    'VALENCIA CEJA',
    '2022-2025'
  ),
  (
    '22316061210001',
    'AEGE070402MMNMNSA6',
    'ESTRELLA JAZMIN',
    'AMEZCUA GONZALEZ',
    '2022-2025'
  ),
  (
    '22316061210002',
    'AEVJ070703HMNNLSA6',
    'JESUS ALFREDO',
    'ANGELES VALENCIA',
    '2022-2025'
  ),
  (
    '22316061210003',
    'BUOL070818HMNNRSA7',
    'LUIS FERNANDO',
    'BUENROSTRO ORTEGA',
    '2022-2025'
  ),
  (
    '22316061210004',
    'CAGE071214HMNRNMA1',
    'EMILIANO',
    'CARDENAS GONZALEZ',
    '2022-2025'
  ),
  (
    '22316061210006',
    'CEEJ070225HMNRSNA6',
    'JUAN MANUEL',
    'CERDA ESCOBAR',
    '2022-2025'
  ),
  (
    '22316061210010',
    'GACL070303HMNRBSA5',
    'LUIS EDUARDO',
    'GARCIA CABEZAS',
    '2022-2025'
  ),
  (
    '22316061210011',
    'GAHJ070613HDFRGNA1',
    'JUAN JESUS',
    'GARCIA HIGAREDA',
    '2022-2025'
  ),
  (
    '22316061210013',
    'GICR070512HMNRJDA7',
    'RODRIGO',
    'GRIMALDO CEJA',
    '2022-2025'
  ),
  (
    '22316061210015',
    'LECH070613HPLCJGA5',
    'HUGO',
    'LECHUGA CEJA',
    '2022-2025'
  ),
  (
    '22316061210018',
    'MAGF070318HMNNNBA9',
    'FABIAN',
    'MANZO GONZALEZ',
    '2022-2025'
  ),
  (
    '22316061210019',
    'MELM070804HMNDPNA9',
    'MANUEL SALVADOR',
    'MEDINA LUPIAN',
    '2022-2025'
  ),
  (
    '22316061210022',
    'NUHA070313HMNXRLA3',
    'ALEJANDRO',
    'NUÑEZ HERNANDEZ',
    '2022-2025'
  ),
  (
    '22316061210024',
    'OIGA071001HMNLRBA8',
    'ABRAHAM JOSUE',
    'OLIVEROS GRANADOS',
    '2022-2025'
  ),
  (
    '22316061210025',
    'OOHI070822HMNRGSA7',
    'ISAIAS',
    'OROPEZA HIGAREDA',
    '2022-2025'
  ),
  (
    '22316061210026',
    'PACE070503HMNRHDA2',
    'JOSE EDUARDO',
    'PARDO CHAVEZ',
    '2022-2025'
  ),
  (
    '22316061210028',
    'ROMA070501HMNDNRA5',
    'AARON FRANCISCO',
    'RODRIGUEZ MUNGUIA',
    '2022-2025'
  ),
  (
    '22316061210029',
    'SAAK070918HMNLRVA5',
    'KEVIN DANIEL',
    'SALINAS ARCEO',
    '2022-2025'
  ),
  (
    '22316061210030',
    'SAIJ071125MMNNBLA6',
    'JULIANA MARLEN',
    'SANCHEZ IBARRA',
    '2022-2025'
  ),
  (
    '22316061210033',
    'ROCJ070129HMNDVSA3',
    'JESUS ALBERTO',
    'RODRIGUEZ CUEVAS',
    '2022-2025'
  ),
  (
    '22316061210034',
    'YOBC070413HMNSNSA5',
    'CESAR ISAAC',
    'YOSEFF BUENROSTRO',
    '2022-2025'
  ),
  (
    '22316061210035',
    'LOMS071118HMNPRRA0',
    'SERGIO ANTONIO',
    'LOPEZ MARTINEZ',
    '2022-2025'
  ),
  (
    '22316061210036',
    'BUTN070205HMNNRSA0',
    'NESTOR FERNANDO',
    'BUENROSTRO TORO',
    '2022-2025'
  ),
  (
    '22316061210040',
    'FANJ070907HMNRVSA1',
    'JESUS ALEJANDRO',
    'FARIAS NAVARRO',
    '2022-2025'
  ),
  (
    '22316061210042',
    'SATA070809HMNNRRA9',
    'ARMANDO SILVESTRE',
    'SANCHEZ TORO',
    '2022-2025'
  ),
  (
    '22316061210044',
    'SISA071022HMNLNBA9',
    'ABRAHAM ALEJANDRO',
    'SILVA SANCHEZ',
    '2022-2025'
  ),
  (
    '22316061210045',
    'AUHJ060810HNENYLA1',
    'JOEL YAIR',
    'ANGULO HOYOS',
    '2022-2025'
  ),
  (
    '22316061210048',
    'RITJ070720HMNVRRA3',
    'JORGE ADRIAN',
    'RIVAS TORRES',
    '2022-2025'
  ),
  (
    '22316061210050',
    'CURK070324HMNRDVA3',
    'KEVIN',
    'CRUZ RODRIGUEZ',
    '2022-2025'
  ),
  (
    '22316061210051',
    'HERC071202HMNRMRA5',
    'CRISTIAN ALEXIS',
    'HERNANDEZ RAMIREZ',
    '2022-2025'
  ),
  (
    '22316061210053',
    'GOVB070212HMNNLRA8',
    'BRANDON',
    'GONZALEZ VALENCIA',
    '2022-2025'
  ),
  (
    '22316061210055',
    'HETG071223HMNRRRA0',
    'GERARDO ISRAEL',
    'HERNANDEZ TORO',
    '2022-2025'
  ),
  (
    '22316061210056',
    'CEMM070525MMNJRNA9',
    'MONSERRAT',
    'CEJA MARTINEZ',
    '2022-2025'
  ),
  (
    '22316061210057',
    'CAVP070321MMNHLRA8',
    'PERLA MONTSERRAT',
    'CHAVEZ VALENCIA',
    '2022-2025'
  ),
  (
    '22316061210058',
    'TOVJ070321HMNRLRA9',
    'JORGE',
    'TORRES VILLASEÑOR',
    '2022-2025'
  ),
  (
    '22316061210059',
    'ZAGE071219MMNPNSA2',
    'ESMERALDA',
    'ZAPIEN GONZALEZ',
    '2022-2025'
  ),
  (
    '22316061210060',
    'CABF070210HJCSRRB6',
    'FERNANDO',
    'CASILLAS BARAJAS',
    '2022-2025'
  ),
  (
    '22316061210061',
    'RECF071012HMNYSRA7',
    'FRANCISCO DANIEL',
    'REYES CASTILLO',
    '2022-2025'
  ),
  (
    '22316061210062',
    'AAFJ060310HGTLLVA1',
    'JAVIER ALEJANDRO',
    'ALANIS FLORES',
    '2022-2025'
  ),
  (
    '22316061210063',
    'NUTD070413HMNXLMA4',
    'DAMIAN SANTIAGO',
    'NUÑEZ TELLEZ',
    '2022-2025'
  ),
  (
    '22316061210064',
    'CABI070626HOCHRTA7',
    'ITURIEL JESUS',
    'CHAVEZ BARRIGA',
    '2022-2025'
  ),
  (
    '22316061210065',
    'OOFA070306HNECLNA3',
    'ANDREW DANIEL',
    'OCHOA FLORES',
    '2022-2025'
  ),
  (
    '22316061210067',
    'TAEJ071015HJCPSSA9',
    'JESUS GERARDO',
    'TAPIA ESQUEDA',
    '2022-2025'
  ),
  (
    '22316061210068',
    'MACJ070527HMNNRNA4',
    'JUAN ANGEL',
    'MANCILLA CARBAJAL',
    '2022-2025'
  ),
  (
    '22316061210069',
    'AEAK061124HMNMLRA9',
    'KAROL CARLOS',
    'AMEZCUA ALVAREZ',
    '2022-2025'
  ),
  (
    '22316061210070',
    'VAMM060916MMNLNRA2',
    'MARTHA GUADALUPE',
    'VALDOVINOS MANZO',
    '2022-2025'
  ),
  (
    '22316061210072',
    'ZAEE071224HMNPSSA6',
    'ESAU',
    'ZAPIEN ESTRADA',
    '2022-2025'
  ),
  (
    '22316061210084',
    'GUFG070402HMNDLRA1',
    'GERARDO RAFAEL',
    'GUDIÑO FLORES',
    '2022-2025'
  ),
  (
    '22316061210085',
    'PUCF070223MMNLBTA1',
    'FATIMA ISABEL',
    'PULIDO CABEZAS',
    '2022-2025'
  ),
  (
    '22316061210086',
    'ROOA071106MMNDLNA7',
    'ANGELA BELEN',
    'RODRIGUEZ OLIVEROS',
    '2022-2025'
  ),
  (
    '22316061210087',
    'AEFM070109HMNCLRA3',
    'JOSE MAURICIO',
    'ACEVEDO FLORIANO',
    '2022-2025'
  ),
  (
    '22316061210088',
    'ROFM070316HMNDLGA8',
    'MIGUEL ANGEL',
    'RODRIGUEZ FLORES',
    '2022-2025'
  ),
  (
    '22316061210089',
    'PECV070126MMNRRLA3',
    'VALERIA',
    'PEREZ CORONA',
    '2022-2025'
  ),
  (
    '22316061210090',
    'HEGA070223MMNRRLA7',
    'ALMA LUCIA',
    'HERNANDEZ GARCIA',
    '2022-2025'
  ),
  (
    '22316061210092',
    'HERL070217HMNRMSA4',
    'LUIS FERNANDO',
    'HERNANDEZ RAMIREZ',
    '2022-2025'
  ),
  (
    '22316061210095',
    'CAMN071226MMNHGTA1',
    'NATALIA JAQUELINE',
    'CHAVEZ MAGAÑA',
    '2022-2025'
  ),
  (
    '22316061210096',
    'SANO070507HMNNXSA0',
    'OSCAR DANIEL',
    'SANCHEZ NUÑEZ',
    '2022-2025'
  ),
  (
    '22316061210098',
    'CACK070626MMNRHMA9',
    'KIMBERLY',
    'CARDENAS CHAVEZ',
    '2022-2025'
  ),
  (
    '22316061210099',
    'NIRA070325MMNTDLA0',
    'ALONDRA ISABEL',
    'NIETO RODRIGUEZ',
    '2022-2025'
  ),
  (
    '22316061210101',
    'HINS070824MMNGVRA0',
    'SARA MARIA',
    'HIGAREDA NAVARRETE',
    '2022-2025'
  ),
  (
    '22316061210102',
    'CEMK070409HMNJCVA1',
    'KEVIN LIZANDRO',
    'CEJA MACIEL',
    '2022-2025'
  ),
  (
    '22316061210103',
    'ROZJ070131HMNSLHA1',
    'JHON DIEGO',
    'ROSAS ZALAPA',
    '2022-2025'
  ),
  (
    '22316061210104',
    'EUHM071224HMNSRRA9',
    'MARIO',
    'ESQUIVEL HERNANDEZ',
    '2022-2025'
  ),
  (
    '22316061210109',
    'LUML070902MMNPCZA6',
    'LIZETH',
    'LUPIAN MACIAS',
    '2022-2025'
  ),
  (
    '22316061210111',
    'MAHB070420HMNNRRA3',
    'BRAULIO ALEXIS',
    'MANZO HERNANDEZ',
    '2022-2025'
  ),
  (
    '22316061210112',
    'VIAJ071126MMNVLNA4',
    'JENSY GUADALUPE',
    'VIVAS ALONSO',
    '2022-2025'
  ),
  (
    '22316061210113',
    'VIAD071126MMNVLFA8',
    'DAFNE GUADALUPE',
    'VIVAS ALONSO',
    '2022-2025'
  ),
  (
    '22316061210114',
    'FOML070705MMNLRSA3',
    'LESLI GUADALUPE',
    'FLORES MARIN',
    '2022-2025'
  ),
  (
    '22316061210115',
    'MAVN071005HMNGCXA1',
    'NOE EMMANUEL',
    'MAGALLON VICENCIO',
    '2022-2025'
  ),
  (
    '22316061210116',
    'JAAM070816HMNRYGA9',
    'MIGUEL SANTIAGO',
    'JAUREGUI AYALA',
    '2022-2025'
  ),
  (
    '22316061210117',
    'AAOV070705MMNLNNA3',
    'VANESA',
    'ALVAREZ ONOFRE',
    '2022-2025'
  ),
  (
    '22316061210118',
    'MOCC071226HMNRJHA3',
    'CHRISTHOPER',
    'MORALES CEJA',
    '2022-2025'
  ),
  (
    '22316061210122',
    'AARE070605MMNYVSA2',
    'ESTEFANIA ALEJANDRA',
    'AYALA RIVERA',
    '2022-2025'
  ),
  (
    '22316061210123',
    'PATF071018MMNRBTA0',
    'FATIMA MARIANA',
    'PARTIDA TABARES',
    '2022-2025'
  ),
  (
    '22316061210124',
    'HECA070727HMNRHDA8',
    'ADOLFO DE JESUS',
    'HERNANDEZ CHAVARRIA',
    '2022-2025'
  ),
  (
    '22316061210127',
    'CAVD070131MMNHGYA4',
    'DAYANA TERESA',
    'CHAVEZ VEGA',
    '2022-2025'
  ),
  (
    '22316061210128',
    'BAFF070302HMNRLRA9',
    'FERNANDO JOSUE',
    'BARRERA FLORES',
    '2022-2025'
  ),
  (
    '22316061210129',
    'COCJ070926HMNYSRA5',
    'JORGE ALBERTO',
    'COYT CASTILLO',
    '2022-2025'
  ),
  (
    '22316061210130',
    'AATD071119MMNVRLA7',
    'DULCE RUBI',
    'AVALOS TORRES',
    '2022-2025'
  ),
  (
    '22316061210133',
    'AEGJ070616MMNRRLA7',
    'JULISSA',
    'ARCEO GRIMALDO',
    '2022-2025'
  ),
  (
    '22316061210134',
    'CATL070708MMNMMLA0',
    'LILIANA',
    'CAMPOS TAMAYO',
    '2022-2025'
  ),
  (
    '22316061210136',
    'OONB061122MMNRGRA7',
    'BRENDA',
    'OROZCO NEGRETE',
    '2022-2025'
  ),
  (
    '22316061210137',
    'ROGA051208MMNDRLA6',
    'ALONDRA',
    'RODRIGUEZ GUERRERO',
    '2022-2025'
  ),
  (
    '22316061210138',
    'GIGB041118MMNRLRA2',
    'BRENDA GUADALUPE',
    'GRIMALDO GALLEGOS',
    '2022-2025'
  ),
  (
    '22316061210139',
    'TOCN071124MMNRRHA7',
    'NAHOMY YANZEL',
    'TORRES CORTEZ',
    '2022-2025'
  ),
  (
    '22316061210140',
    'GOBA061003HMNMRNA5',
    'ANGEL LEZTAD',
    'GOMEZ BARRERA',
    '2022-2025'
  ),
  (
    '22316061210141',
    'ROHJ070712HMNDRSA6',
    'JESUS',
    'RODRIGUEZ HERNANDEZ',
    '2022-2025'
  ),
  (
    '22316061210142',
    'MUMJ070423HMNNRRA9',
    'JORGE LUIS',
    'MUNGUIA MARIN',
    '2022-2025'
  ),
  (
    '22316061210143',
    'CXGA070921HMNDRLA3',
    'ALEXIS',
    'CADENAS GARCIA',
    '2022-2025'
  ),
  (
    '22316061210144',
    'SIZA071229HMNLPLA0',
    'ALEXIS EMMANUEL',
    'SILVA ZAPIEN',
    '2022-2025'
  ),
  (
    '22316061210145',
    'ROCE070703HMNDHRA9',
    'ERIC DAVID',
    'RODRIGUEZ CHAVARRIA',
    '2022-2025'
  ),
  (
    '22316061210146',
    'SAVJ070207HMNNLSA1',
    'JESUS GUSTAVO',
    'SANDOVAL VALLEJO',
    '2022-2025'
  ),
  (
    '22316061210147',
    'GAJJ070717HMNRMVA0',
    'JAVIER ARMANDO',
    'GARCIA JIMENEZ',
    '2022-2025'
  ),
  (
    '22316061210148',
    'PACL070707HMNSBSA0',
    'LUIS ERNESTO',
    'PASALLO CABEZAS',
    '2022-2025'
  ),
  (
    '22316061210149',
    'HERD071009HMNRVGA5',
    'DIEGO ALONSO',
    'HERNANDEZ RIVERA',
    '2022-2025'
  ),
  (
    '22316061210150',
    'HIEJ071114HMNGSSA8',
    'JESUS EDUARDO',
    'HIGAREDA ESPINOZA',
    '2022-2025'
  ),
  (
    '22316061210151',
    'AACJ070812HMNVSNA3',
    'JONATHAN SALVADOR',
    'AVALOS CASTRO',
    '2022-2025'
  ),
  (
    '22316061210152',
    'GAMC070321HMNRNSA0',
    'CESAR OMAR',
    'GARCIA MANZO',
    '2022-2025'
  ),
  (
    '22316061210153',
    'RAME070502HMNMGMA2',
    'EMMANUEL',
    'RAMIREZ MAGAÑA',
    '2022-2025'
  ),
  (
    '22316061210154',
    'BUSS070302HMNNNRA5',
    'SERGIO',
    'BUENROSTRO SANCHEZ',
    '2022-2025'
  ),
  (
    '22316061210155',
    'CECA070104HMNRRDA7',
    'ADAN',
    'CERVANTES CORONA',
    '2022-2025'
  ),
  (
    '22316061210156',
    'FORE070906HMNLMRA8',
    'ERICK FERNANDO',
    'FLORES RAMIREZ',
    '2022-2025'
  ),
  (
    '22316061210157',
    'AACB070602HDFYHRA4',
    'BRUNO',
    'AYALA CHAVARRIA',
    '2022-2025'
  ),
  (
    '22316061210158',
    'LUML070209HMNNRSA2',
    'LUIS EDUARDO',
    'LUNA MORENO',
    '2022-2025'
  ),
  (
    '22316061210159',
    'MALU070124HMNNPLA5',
    'JOSE ULISES',
    'MANZO LOPEZ',
    '2022-2025'
  ),
  (
    '22316061210160',
    'ZASA070716HMNPNNA7',
    'JOSE ANTONIO',
    'ZAPIEN SANCHEZ',
    '2022-2025'
  ),
  (
    '22316061210167',
    'GAMA070828HMNRRLA6',
    'ALAN',
    'GARCIA MORENO',
    '2022-2025'
  ),
  (
    '22316061210170',
    'VEGJ070906HMNGDNA2',
    'JONATHAN EDUARDO',
    'VEGA GODOY',
    '2022-2025'
  ),
  (
    '22316061210172',
    'AEEX061216MMNMSMA2',
    'XIMENA LIZBETH',
    'AMEZCUA ESCALERA',
    '2022-2025'
  ),
  (
    '22316061210174',
    'MUHX061022MMNNRMA6',
    'XIMENA',
    'MUNGUIA HERNANDEZ',
    '2022-2025'
  ),
  (
    '22316061210175',
    'NUGE070619MMNXNMA9',
    'EMILY ALEXA',
    'NUÑEZ GONZALEZ',
    '2022-2025'
  ),
  (
    '22316061210176',
    'EIGD070413MMNSDSA7',
    'DISLERY DENISSE',
    'ESPINOZA GUDIÑO',
    '2022-2025'
  ),
  (
    '22316061210177',
    'AIGD070624MMNVRNA1',
    'DANIELA MONTSERRAT',
    'AVIÑA GARCIA',
    '2022-2025'
  ),
  (
    '22316061210178',
    'OOOF070809HMNNCRA5',
    'FERNANDO',
    'ONOFRE OCHOA',
    '2022-2025'
  ),
  (
    '22316061210179',
    'OOHJ060905MMNCGCA8',
    'JOCELYN',
    'OCHOA HIGAREDA',
    '2022-2025'
  ),
  (
    '22316061210180',
    'HEAA070207MMNRLNA9',
    'ANGELA MAGALY',
    'HERRERA ALVAREZ',
    '2022-2025'
  ),
  (
    '22316061210181',
    'MAGK070301MMNCRRA1',
    'KAREN VANESSA',
    'MACIAS GARCIA',
    '2022-2025'
  ),
  (
    '22316061210182',
    'ROMB070314MMNDNRA5',
    'BERENICE',
    'RODRIGUEZ MENDEZ',
    '2022-2025'
  ),
  (
    '22316061210184',
    'GUNV070923MMNTVNA5',
    'VANESSA LIZBETH',
    'GUTIERREZ NAVARRO',
    '2022-2025'
  ),
  (
    '22316061210185',
    'JAAJ071213MDFRLZA2',
    'JAZMIN',
    'JARAMILLO ALMARAZ',
    '2022-2025'
  ),
  (
    '22316061210186',
    'YEMJ070819HMNXRSA8',
    'JESUS',
    'YEO MORENO',
    '2022-2025'
  ),
  (
    '22316061210188',
    'SAHM071107MMNNRNA5',
    'MONTSERRAT',
    'SANCHEZ HORTA',
    '2022-2025'
  ),
  (
    '22316061210190',
    'PENA070131HMNRXNA2',
    'ANGEL ISIDRO',
    'PRECIADO NUÑEZ',
    '2022-2025'
  ),
  (
    '22316061210191',
    'GUMA070405MJCZNNA1',
    'ANALINE MIROSLAVA',
    'GUZMAN MANZO',
    '2022-2025'
  ),
  (
    '22316061210193',
    'PEBB070605MMNRXRA3',
    'BRITTANY MICHEL',
    'PEREZ BAÑALES',
    '2022-2025'
  ),
  (
    '22316061210195',
    'CICC070202MMNHRCA4',
    'CECILIA',
    'CHIA CERVANTES',
    '2022-2025'
  ),
  (
    '22316061210199',
    'MOFV051113MMNRRLA1',
    'VALERIA VIRIDIANA',
    'MORENO FARIAS',
    '2022-2025'
  ),
  (
    '22316061210200',
    'AAFV070320MMNVLNA5',
    'VANIA MARGARITA',
    'AVALOS FLORES',
    '2022-2025'
  ),
  (
    '22316061210201',
    'GOCA060709MMNNJNA1',
    'ANDREA GUADALUPE',
    'GONZALEZ CEJA',
    '2022-2025'
  ),
  (
    '22316061210203',
    'GUGE070409MMNTLNA2',
    'ENEIDA SHANTAL',
    'GUTIERREZ GALVEZ',
    '2022-2025'
  ),
  (
    '22316061210205',
    'AEJA071121MMNLMNA5',
    'ANDREA GUADALUPE',
    'ALEJO JIMENEZ',
    '2022-2025'
  ),
  (
    '22316061210206',
    'AAAV071103MMNYGRA8',
    'VERONICA CAROLINA',
    'AYALA AGUILERA',
    '2022-2025'
  ),
  (
    '22316061210207',
    'EUMJ070527MMNSRCA4',
    'JOSELYNE',
    'ESQUIVEL MORENO',
    '2022-2025'
  ),
  (
    '22316061210208',
    'GUSF070422HMNTNLA0',
    'FELIPE DE JESUS',
    'GUTIERREZ SANCHEZ',
    '2022-2025'
  ),
  (
    '22316061210209',
    'NACB070716MMNVHLA8',
    'BLANCA ISABEL',
    'NAVARRO CHAVEZ',
    '2022-2025'
  ),
  (
    '22316061210210',
    'OOVL070501HMNCLSA4',
    'LUIS ANTONIO',
    'OCHOA VILLANUEVA',
    '2022-2025'
  ),
  (
    '22316061210212',
    'MAZI071220MMNNRRA4',
    'IARHETSI',
    'MANZO ZARAGOZA',
    '2022-2025'
  ),
  (
    '22316061210213',
    'OOGM071117MMNCRRA8',
    'MARLEN',
    'OCHOA GARNICA',
    '2022-2025'
  ),
  (
    '22316061210214',
    'NXCA070424MMNVMYA4',
    'AYLIN BERENICE',
    'NAVARRETE CAMPOS',
    '2022-2025'
  ),
  (
    '22316061210215',
    'GAMJ070505MMNLNDA0',
    'JUDITH ALEJANDRA',
    'GALVEZ MANZO',
    '2022-2025'
  ),
  (
    '22316061210216',
    'NACJ060203HMNVHSA9',
    'JOSE DE JESUS',
    'NAVARRETE CHAVEZ',
    '2022-2025'
  ),
  (
    '22316061210217',
    'SAZM071009MMNNPCA5',
    'MICHELLE',
    'SANCHEZ ZEPEDA',
    '2022-2025'
  ),
  (
    '22316061210218',
    'MAMS070713MMCGCTA2',
    'STEPHANIE',
    'MAGALLON MACIAS',
    '2022-2025'
  ),
  (
    '22316061210219',
    'MENE070811MMNLVSA2',
    'ESMERALDA',
    'MELENDEZ NAVARRO',
    '2022-2025'
  ),
  (
    '22316061210220',
    'BIGA071226HMNRRNA2',
    'JOSE ANGEL',
    'BRISEÑO GUERRA',
    '2022-2025'
  ),
  (
    '22316061210222',
    'SEGE071205MMNGRSA7',
    'ESTEFANIA',
    'SEGURA GRILMALDO',
    '2022-2025'
  ),
  (
    '22316061210224',
    'SAAR070108HMNNVMA7',
    'RAMIRO',
    'SANCHEZ AVALOS',
    '2022-2025'
  ),
  (
    '22316061210225',
    'GURJ070618MMNDMSA5',
    'MARIA DE JESUS',
    'GUDIÑO RAMOS',
    '2022-2025'
  ),
  (
    '22316061210226',
    'GAGJ071001MMNRTSA4',
    'JESSICA JAZMIN',
    'GARCIA GUTIERREZ',
    '2022-2025'
  ),
  (
    '22316061210227',
    'NAGJ070602HMNVLSA1',
    'JESUS EDUARDO',
    'NAVARRO GALVEZ',
    '2022-2025'
  ),
  (
    '22316061210228',
    'GABD071231MVZRTNA2',
    'DANNA LIZA',
    'GARCIA BAUTISTA',
    '2022-2025'
  ),
  (
    '22316061210229',
    'LOZL070621HMNZRSA3',
    'LUIS ARMANDO',
    'LOZA ZARAGOZA',
    '2022-2025'
  ),
  (
    '22316061210230',
    'CACX070405MMNHHMA5',
    'XIMENA',
    'CHAVEZ CHAVEZ',
    '2022-2025'
  ),
  (
    '22316061210231',
    'AARL071130MMNYDLA5',
    'LILIANA LIZETH',
    'AYALA RODRIGUEZ',
    '2022-2025'
  ),
  (
    '22316061210232',
    'RIAB070814HMNVNRA6',
    'BRAYAM RICARDO',
    'RIVAS ANAYA',
    '2022-2025'
  ),
  (
    '22316061210234',
    'SACM071206MMNLHRA2',
    'MARIANA',
    'SALDAÑA CHAVEZ',
    '2022-2025'
  ),
  (
    '22316061210235',
    'SAOF070422MMNNRBA2',
    'FABIOLA LIZETH',
    'SANCHEZ ORNELAS',
    '2022-2025'
  ),
  (
    '22316061210236',
    'SAMJ071021MMNNNZA6',
    'JAZMIN',
    'SANCHEZ MENDEZ',
    '2022-2025'
  ),
  (
    '22316061210237',
    'BIHA070318MMNRGNA7',
    'ANA ALEJANDRA',
    'BRISEÑO HIGAREDA',
    '2022-2025'
  ),
  (
    '22316061210238',
    'FASD071212MMNRNNA9',
    'DANIELA GUADALUPE',
    'FARIAS SANCHEZ',
    '2022-2025'
  ),
  (
    '22316061210239',
    'GIEP070309MMNLSLA5',
    'PAOLA JUDITH',
    'GIL ESPINOZA',
    '2022-2025'
  ),
  (
    '22316061210240',
    'CESG071221MMNJNDA4',
    'MARIA GUADALUPE',
    'CEJA SANCHEZ',
    '2022-2025'
  ),
  (
    '22316061210241',
    'CAVA070906MJCRGYA8',
    'AYARI MONTSERRAT',
    'CARRILLO VEGA',
    '2022-2025'
  ),
  (
    '22316061210242',
    'TOMA070313MMNRRLA9',
    'ALONDRA TERESA',
    'TORO MIRELES',
    '2022-2025'
  ),
  (
    '22316061210243',
    'IAFA060221MMNBLNA1',
    'ANA MICHELLE',
    'IBARRA FLORES',
    '2022-2025'
  ),
  (
    '22316061210249',
    'OOAK070514MMNCLRA7',
    'KARLA',
    'OCHOA ALVAREZ',
    '2022-2025'
  ),
  (
    '22316061210252',
    'CACM070907MMNBJRA6',
    'MARIANA GUADALUPE',
    'CABEZAS CEJA',
    '2022-2025'
  ),
  (
    '22316061210254',
    'DIAT070424MMNZVNA4',
    'TANIA MONTSERRAT',
    'DIAZ AVILA',
    '2022-2025'
  ),
  (
    '22316061210255',
    'VIHS070609MMNCTRA1',
    'SARAHI',
    'VICTOR HUITRON',
    '2022-2025'
  ),
  (
    '22316061210256',
    'GIHA070219MMNLTNA8',
    'ANGHELA LIZETH',
    'GIL HUITRON',
    '2022-2025'
  ),
  (
    '22316061210257',
    'MOOJ070616MMNRLNA2',
    'JENNIFER EDITH',
    'MORALES OLIVARES',
    '2022-2025'
  ),
  (
    '22316061210259',
    'COXL070615MNERXSA4',
    'LISETH',
    'CORTES',
    '2022-2025'
  ),
  (
    '22316061210262',
    'HERR071110MMNRNNA5',
    'MARIA RENATA',
    'HERNANDEZ RINCON',
    '2022-2025'
  ),
  (
    '22316061210263',
    'GAZK070830MMNRPRA1',
    'KAREN FERNANDA',
    'GARCIA ZAPIEN',
    '2022-2025'
  ),
  (
    '22316061210265',
    'MAHF070402MMNRGRA8',
    'MARIA FERNANDA',
    'MARTINEZ HIGAREDA',
    '2022-2025'
  ),
  (
    '22316061210266',
    'NAGM070922MMNVRRA8',
    'MARIANA',
    'NAVARRETE GARCIA',
    '2022-2025'
  ),
  (
    '22316061210267',
    'PAGS070831MMNDRSA1',
    'SUSANA',
    'PADILLA GARCIA',
    '2022-2025'
  ),
  (
    '22316061210268',
    'DUVA070618MJCRZLA0',
    'ALLISON YOSELIN',
    'DUARTE VAZQUEZ',
    '2022-2025'
  ),
  (
    '22316061210269',
    'HEBC071125MMNRRRA7',
    'CRISTINA GUADALUPE',
    'HERNANDEZ BERROSPE',
    '2022-2025'
  ),
  (
    '22316061210270',
    'FOCF070811MMNLHRA5',
    'FERNANDA JAZMIN',
    'FLORES CHAVEZ',
    '2022-2025'
  ),
  (
    '22316061210271',
    'MEOJ070906HMNDCRA2',
    'JORGE GUADALUPE',
    'MEDINA OCHOA',
    '2022-2025'
  ),
  (
    '22316061210272',
    'GASF060111MMNRGRA9',
    'FRANEA VANESSA',
    'GARCIA SEGURA',
    '2022-2025'
  ),
  (
    '22316061210273',
    'NACX071221MMNVHMA8',
    'XIMENA GUADALUPE',
    'NAVARRETE CHAVEZ',
    '2022-2025'
  ),
  (
    '22316061210275',
    'DIMF071113MMNZNTA2',
    'FATIMA YULIANA',
    'DIAZ MENDOZA',
    '2022-2025'
  ),
  (
    '22316061210276',
    'HILG070903MMNGPLA0',
    'GLORIA JACQUELINE',
    'HIGAREDA LUPIAN',
    '2022-2025'
  ),
  (
    '22316061210277',
    'GORM070906MMNNDNA1',
    'MONTSERRAT',
    'GONZALEZ RODRIGUEZ',
    '2022-2025'
  ),
  (
    '22316061210278',
    'AAHF071214MMNLRTA7',
    'FATIMA GUADALUPE',
    'ALVARADO HERNANDEZ',
    '2022-2025'
  ),
  (
    '22316061210279',
    'PAOK070606HMNGLVA3',
    'KEVIN SAID',
    'PAGE OLIVARES',
    '2022-2025'
  ),
  (
    '22316061210280',
    'MOTL070709MMNRFSA0',
    'LESLIE GUADALUPE',
    'MORENO TAFOLLA',
    '2022-2025'
  ),
  (
    '22316061210281',
    'FOMG070911MMNLRNA0',
    'GENESIS',
    'FLORES MIRANDA',
    '2022-2025'
  ),
  (
    '22316061210282',
    'SACK070318MMNNSRA7',
    'KAREN ARIANA',
    'SANDOVAL CISNEROS',
    '2022-2025'
  ),
  (
    '22316061210284',
    'FOAJ070923MMNLYCA4',
    'MARIA JACQUELINE',
    'FLORES AYALA',
    '2022-2025'
  ),
  (
    '22316061210285',
    'MAAA070613HMNCVNA5',
    'ANTONIO DE JESUS',
    'MACIEL AVALOS',
    '2022-2025'
  ),
  (
    '22316061210286',
    'MAHF070305MMNNTTA5',
    'FATIMA YARELI',
    'MANZO HUITRON',
    '2022-2025'
  ),
  (
    '22316061210288',
    'PERA071018MMNRJLA4',
    'MARIA ALONDRA',
    'PEREZ ROJAS',
    '2022-2025'
  ),
  (
    '22316061210289',
    'SASM070405MMNNRNA0',
    'MONICA NAYELI',
    'SANDOVAL SUAREZ',
    '2022-2025'
  ),
  (
    '22316061210290',
    'NAGF070602HMNVLRA4',
    'FRANCISCO JAVIER',
    'NAVARRO GALVEZ',
    '2022-2025'
  ),
  (
    '22316061210294',
    'LIGA070528MJCRRRA5',
    'ARLETTE SARAHY',
    'LIRA GRANADOS',
    '2022-2025'
  ),
  (
    '22316061210295',
    'VAOR071007HMNLCMA1',
    'RAMON GILBERTO',
    'VALENCIA OCHOA',
    '2022-2025'
  ),
  (
    '22316061210296',
    'MASC060612MMNDNRA9',
    'MARIA DEL CARMEN',
    'MADRID SANCHEZ',
    '2022-2025'
  ),
  (
    '22316061210297',
    'MASC071222MMNDNRA8',
    'CARLA GUADALUPE',
    'MADRID SANCHEZ',
    '2022-2025'
  ),
  (
    '22316061210298',
    'CASI070509MMNSNNA9',
    'INGRID REGINA',
    'CASTELLANOS SANCHEZ',
    '2022-2025'
  ),
  (
    '22316061210299',
    'CESS070511MMNRRFA7',
    'SOFIA GUADALUPE',
    'CERVANTES SUAREZ',
    '2022-2025'
  ),
  (
    '22316061210300',
    'GOSM041225HMNNNRA3',
    'JOSE MARIA',
    'GONZALEZ SANDOVAL',
    '2022-2025'
  ),
  (
    '22316061210301',
    'NACM070514MMNVBRA6',
    'MARICELA',
    'NAVARRETE CABEZAS',
    '2022-2025'
  ),
  (
    '22316061210302',
    'OOCM071017MMNCRRA3',
    'MARIANA',
    'OCHOA CERVANTES',
    '2022-2025'
  ),
  (
    '22316061210303',
    'CORN060111MDFRMDA4',
    'NADIA PAOLA',
    'CORTES RAMOS',
    '2022-2025'
  ),
  (
    '22316061210304',
    'GUNA070906MMNTRRA9',
    'ARIADNA YAMILE',
    'GUTIERREZ NARANJO',
    '2022-2025'
  ),
  (
    '22316061210305',
    'CAFC070501MJCRRRA2',
    'CARMEN PATRICIA',
    'CARDENAS FERMIN',
    '2022-2025'
  ),
  (
    '22316061210306',
    'NEGV071102MMNGRLA7',
    'VALERIA GUADALUPE',
    'NEGRETE GRANADOS',
    '2022-2025'
  ),
  (
    '22316061210310',
    'CUNX060718MJCRVMA7',
    'XIOMARA VALERIA',
    'CRUZ NAVARRETE',
    '2022-2025'
  ),
  (
    '22316061210312',
    'GARL071018MMNRMZA0',
    'LIZBETH MARIANA',
    'GARCIA RAMIREZ',
    '2022-2025'
  ),
  (
    '22316061210314',
    'MEXK071017MNEJXY19',
    'KAYLEI NICHOLE',
    'MEJIA GALVAN',
    '2022-2025'
  ),
  (
    '22316061210315',
    'CASR050921HMNBNLA9',
    'RAUL',
    'CABEZAS SANCHEZ',
    '2022-2025'
  ),
  (
    '22316061210317',
    'EAGM060214MMNSNYA6',
    'MAYRA GUADALUPE',
    'ESTRADA GONZALEZ',
    '2022-2025'
  ),
  (
    '22316061210318',
    'RIMP060309MMNVCLA7',
    'PAOLA GUADALUPE',
    'RIVAS MACIEL',
    '2022-2025'
  ),
  (
    '22316061210319',
    'BAGR070627HJCTNBA0',
    'ROBERTO',
    'BAUTISTA GONZALEZ',
    '2022-2025'
  ),
  (
    '22316061210320',
    'DOSC070112HTCMNRA3',
    'CARLOS DANIEL',
    'DOMINGUEZ SANCHEZ',
    '2022-2025'
  ),
  (
    '22316061210323',
    'SEVJ060505HMNGCSA2',
    'JESUS ALBERTO',
    'SEGURA VICTOR',
    '2022-2025'
  ),
  (
    '22316061210324',
    'MAOB051001HMNNLRA2',
    'BRANDON',
    'MANZO OLIVEROS',
    '2022-2025'
  ),
  (
    '22316061210326',
    'AACM060914MMNLSRA2',
    'MEREDITH REGINA',
    'ALCARAZ CASTELLANOS',
    '2022-2025'
  ),
  (
    '22316061210328',
    'COMJ070516HMNRJNA9',
    'JUAN IGNACIO',
    'CORREA MEJIA',
    '2022-2025'
  ),
  (
    '22316061210330',
    'CEMR071111HMNRGFA4',
    'RAFAEL',
    'CERVANTES MAGAÑA',
    '2022-2025'
  ),
  (
    '22316061210332',
    'RAMJ070322MMNMNNA8',
    'JENNIFER',
    'RAMIREZ MENDOZA',
    '2022-2025'
  ),
  (
    '22316061210336',
    'OEAF070922MJCRLTA4',
    'FATIMA ISABEL',
    'ORTEGA ALVAREZ',
    '2022-2025'
  ),
  (
    '22316061210337',
    'CASA060603HMNHRLA1',
    'ALBERTO',
    'CHAVEZ SUAREZ',
    '2022-2025'
  ),
  (
    '22316061210338',
    'ZAGE071207MMNPRSA1',
    'ESMERALDA BELEN',
    'ZAPIEN GUERRERO',
    '2022-2025'
  ),
  (
    '22316061210341',
    'MASJ070516HMNNGSA1',
    'JOSE DE JESUS',
    'MANZO SEGURA',
    '2022-2025'
  ),
  (
    '22316061210342',
    'CASA070314MMNRNLA7',
    'ALEJANDRA MONTSERRAT',
    'CARDENAS SANCHEZ',
    '2022-2025'
  ),
  (
    '22316061210343',
    'GIAR070717HMNRLLA0',
    'RAUL ISAAC',
    'GIRARTE ALMEIDA',
    '2022-2025'
  ),
  (
    '22316061210344',
    'OONA071008MMNCVLA3',
    'ALONDRA JANET',
    'OCHOA NAVARRETE',
    '2022-2025'
  ),
  (
    '22316061210345',
    'PERK070716MMNRDRA0',
    'KARLA XIMENA',
    'PEREZ RODRIGUEZ',
    '2022-2025'
  ),
  (
    '22316061210347',
    'VAGE070315HMNLTDA7',
    'EDGAR JOSUE',
    'VALADES GUTIERREZ',
    '2022-2025'
  ),
  (
    '22316061210348',
    'OOCL071213HMNCRSA9',
    'LUIS ANGEL',
    'OCHOA CRUZ',
    '2022-2025'
  ),
  (
    '22316061210349',
    'PIAE060306HMNRMRA1',
    'ERNESTO SANTIAGO',
    'PRIETO AMEZCUA',
    '2022-2025'
  ),
  (
    '23316061210001',
    'AARH070623HJCNYGB7',
    'HUGO',
    'ANAYA REYES',
    '2023-2026'
  ),
  (
    '23316061210002',
    'AAMJ080927HMNNNNA3',
    'JUAN JESUS',
    'ANDRADE MANZO',
    '2023-2026'
  ),
  (
    '23316061210003',
    'CAOJ080612HMNSCSA3',
    'JESUS',
    'CASILLAS OCEGUEDA',
    '2023-2026'
  ),
  (
    '23316061210004',
    'FIMA080202MJCGRLA2',
    'ALLISSON GUADALUPE',
    'FIGUEROA MARTINEZ',
    '2023-2026'
  ),
  (
    '23316061210005',
    'FOGN080502MMNLRTA2',
    'NATALIA GUADALUPE',
    'FLORES GARCIA',
    '2023-2026'
  ),
  (
    '23316061210006',
    'FOML080815HMNLNSA9',
    'LUIS ANGEL',
    'FLORES MENDEZ',
    '2023-2026'
  ),
  (
    '23316061210007',
    'GAAJ080313HMNRYSA8',
    'JESUS RODRIGO',
    'GARCIA AYALA',
    '2023-2026'
  ),
  (
    '23316061210008',
    'HEGC081118MMNRNCA5',
    'CECILIA',
    'HERNANDEZ GONZALEZ',
    '2023-2026'
  ),
  (
    '23316061210009',
    'HEAM080729MMNRRCA8',
    'MICHELLE',
    'HERNANDEZ ARTEAGA',
    '2023-2026'
  ),
  (
    '23316061210010',
    'HEGA080722MMNRNRA7',
    'ARELY BERENICE',
    'HERRERA GONZALEZ',
    '2023-2026'
  ),
  (
    '23316061210011',
    'HIHM080329HJCGGRA9',
    'MARIO GABRIEL',
    'HIGAREDA HIGAREDA',
    '2023-2026'
  ),
  (
    '23316061210012',
    'IABA081006HMNBTLA4',
    'ALEXIS LEONARDO',
    'IBARRA BAUTISTA',
    '2023-2026'
  ),
  (
    '23316061210013',
    'LOMA080401HNEPDBA2',
    'ABNER IVAN',
    'LOPEZ MADRIGAL',
    '2023-2026'
  ),
  (
    '23316061210014',
    'LUCB080627MMNPHRA5',
    'BRYANA AYLEN',
    'LUPIAN CHAVARRIA',
    '2023-2026'
  ),
  (
    '23316061210015',
    'MADK080505MMNCZMA4',
    'KIMBERLY MONTSERRAT',
    'MACIAS DIAZ',
    '2023-2026'
  ),
  (
    '23316061210016',
    'MAMJ080915MMNGJCA9',
    'JOCELYN GUADALUPE',
    'MAGAÑA MEJIA',
    '2023-2026'
  ),
  (
    '23316061210017',
    'MAHJ080820MMNRRCA9',
    'JACQUELINE ARACELI',
    'MARTINEZ HERNANDEZ',
    '2023-2026'
  ),
  (
    '23316061210018',
    'MADJ081003MMNRLSA9',
    'MARIA JOSE',
    'MARTINEZ DELGADO',
    '2023-2026'
  ),
  (
    '23316061210019',
    'MEHE080321HMNRRRA4',
    'ERGUIN JAVIER',
    'MERCADO HURTADO',
    '2023-2026'
  ),
  (
    '23316061210020',
    'MUCO080419HBCXSLA7',
    'OLIVER',
    'MUÑIZ CASILLAS',
    '2023-2026'
  ),
  (
    '23316061210021',
    'NUGM080106MMNXRNA5',
    'MONTSERRAT',
    'NUÑEZ GUERRERO',
    '2023-2026'
  ),
  (
    '23316061210022',
    'NUHB080812HMNXRRA8',
    'BRYAN',
    'NUÑEZ HERRERA',
    '2023-2026'
  ),
  (
    '23316061210023',
    'OOFD080827HNECLYA5',
    'DYLAN',
    'OCHOA FLORES',
    '2023-2026'
  ),
  (
    '23316061210024',
    'OOFA080827HNECLLA2',
    'ALAN',
    'OCHOA FLORES',
    '2023-2026'
  ),
  (
    '23316061210025',
    'OOFJ080409HMNNLNA5',
    'JUAN MANUEL',
    'ONOFRE FLORES',
    '2023-2026'
  ),
  (
    '23316061210026',
    'OIAL080528MMNRVSA5',
    'LESLIE GUADALUPE',
    'ORTIZ AVILA',
    '2023-2026'
  ),
  (
    '23316061210027',
    'QUVS080802HMNRVRA0',
    'SERGIO',
    'QUIRINO VIVAS',
    '2023-2026'
  ),
  (
    '23316061210028',
    'RAGD081103HMNMNNA2',
    'DANIEL',
    'RAMIREZ GONZALEZ',
    '2023-2026'
  ),
  (
    '23316061210029',
    'RECO080510HMNNZSA8',
    'OSWALDO',
    'RENTERIA CAZARES',
    '2023-2026'
  ),
  (
    '23316061210030',
    'ROCE071114HMNDRMA8',
    'EMILIO',
    'RODRIGUEZ CORTEZ',
    '2023-2026'
  ),
  (
    '23316061210031',
    'SAVA081219MMNNCNA7',
    'ANA PAOLA',
    'SANCHEZ VICTOR',
    '2023-2026'
  ),
  (
    '23316061210032',
    'SEVD080618HMNGNGA3',
    'DIEGO',
    'SEGURA VENEGAS',
    '2023-2026'
  ),
  (
    '23316061210033',
    'SURV080629MMNRSLA5',
    'VALERIA YAELI',
    'SUAREZ RIOS',
    '2023-2026'
  ),
  (
    '23316061210034',
    'TADL080718MMNFZSA0',
    'LESLIE YARETZI',
    'TAFOLLA DIAZ',
    '2023-2026'
  ),
  (
    '23316061210035',
    'ZAGB080322HMNPMRA6',
    'BRAULIO FERNANDO',
    'ZAPIEN GOMEZ',
    '2023-2026'
  ),
  (
    '23316061210036',
    'AEAA080522MMNMYNA8',
    'ANGELA MARIA',
    'AMEZCUA AYALA',
    '2023-2026'
  ),
  (
    '23316061210037',
    'AEGL080515HMNMTSA2',
    'JOSE LUIS',
    'AMEZCUA GUTIERREZ',
    '2023-2026'
  ),
  (
    '23316061210038',
    'AUAL080409MMNNMSA1',
    'LESLIE',
    'ANGULO AMEZCUA',
    '2023-2026'
  ),
  (
    '23316061210039',
    'AACK081217MMNVHMA5',
    'KIMBERLY',
    'AVALOS CHAVEZ',
    '2023-2026'
  ),
  (
    '23316061210040',
    'AAMD080514HMNVRNA9',
    'DANIEL',
    'AVALOS MARTINEZ',
    '2023-2026'
  ),
  (
    '23316061210041',
    'AIPG080410MMNVMDA5',
    'MARIA GUADALUPE',
    'AVILA PIMENTEL',
    '2023-2026'
  ),
  (
    '23316061210042',
    'AAVL080731MMNYNZA0',
    'LIZETH',
    'AYALA VENEGAS',
    '2023-2026'
  ),
  (
    '23316061210043',
    'BAGJ080521HMNRRNA4',
    'JUAN PABLO',
    'BARRERA GRIMALDO',
    '2023-2026'
  ),
  (
    '23316061210044',
    'BEGA080131HMNCRNA5',
    'ANGEL DANIEL',
    'BECERRA GARCIA',
    '2023-2026'
  ),
  (
    '23316061210045',
    'CAGC081103HMNMRRA0',
    'CARLOS JESUS',
    'CAMARENA GARCIA',
    '2023-2026'
  ),
  (
    '23316061210046',
    'CAVJ080131HMNRCNA8',
    'JUAN PABLO',
    'CARDENAS VICTOR',
    '2023-2026'
  ),
  (
    '23316061210047',
    'CACG081217MMNSSDA2',
    'GUADALUPE',
    'CASTAÑEDA CASTELLANOS',
    '2023-2026'
  ),
  (
    '23316061210048',
    'CASE081125MMNSVSA0',
    'ESTEFANIA',
    'CASTILLO SAAVEDRA',
    '2023-2026'
  ),
  (
    '23316061210049',
    'CORJ080420HMNNCNA8',
    'JUAN PABLO',
    'CONTRERAS ROCHA',
    '2023-2026'
  ),
  (
    '23316061210050',
    'AIZD070602HMNVPGA8',
    'DIEGO',
    'AVILA ZAPIEN',
    '2023-2026'
  ),
  (
    '23316061210051',
    'HAGJ050524HJCRNSA9',
    'JESUS ANTONIO',
    'HERNANDEZ GONZALEZ',
    '2023-2026'
  ),
  (
    '23316061210052',
    'ROEJ080305HMNJSSA4',
    'JOSEHP KEVIN',
    'ROJAS ESTRADA',
    '2023-2026'
  ),
  (
    '23316061210053',
    'DIAJ081022MMNZMHA4',
    'JOHANA SARAHI',
    'DIAZ AMEZCUA',
    '2023-2026'
  ),
  (
    '23316061210054',
    'TOSM080402HMNRNGA7',
    'MIGUEL ANGEL',
    'DEL TORO SANCHEZ',
    '2023-2026'
  ),
  (
    '23316061210055',
    'FOEJ080107HMNLLSA4',
    'JOSE DE JESUS',
    'FLORES EULLOQUI',
    '2023-2026'
  ),
  (
    '23316061210056',
    'FUVG080220MMNRNDA6',
    'MARIA GUADALUPE',
    'FRUTOS VENEGAS',
    '2023-2026'
  ),
  (
    '23316061210057',
    'GAAD081113HMNYLNA7',
    'DANIEL',
    'GAYTAN ALVARADO',
    '2023-2026'
  ),
  (
    '23316061210058',
    'GAEO080411HMNRSSA5',
    'OSBORNE SANTIAGO',
    'GRANADOS ESTRADA',
    '2023-2026'
  ),
  (
    '23316061210059',
    'HEVJ060920HMNRGSA3',
    'JESUS IVAN',
    'HERNANDEZ VEGA',
    '2023-2026'
  ),
  (
    '23316061210060',
    'MAFR080507MMNGLSA3',
    'ROSA ITZEL',
    'MAGAÑA FLORES',
    '2023-2026'
  ),
  (
    '23316061210061',
    'MAGE080530MMNRLVA1',
    'EVELYN GUADALUPE',
    'MARTINEZ GALVEZ',
    '2023-2026'
  ),
  (
    '23316061210062',
    'MEMS080920HMNRNMA0',
    'SAMUEL',
    'MERLAN MENDOZA',
    '2023-2026'
  ),
  (
    '23316061210063',
    'MUSL080106MMNXNZA1',
    'LIZBETH GUADALUPE',
    'MUÑIZ SANCHEZ',
    '2023-2026'
  ),
  (
    '23316061210064',
    'OOOF070410MMNCCTA9',
    'FATIMA GUADALUPE',
    'OCHOA OCHOA',
    '2023-2026'
  ),
  (
    '23316061210065',
    'OAME080408MMNRGSA9',
    'MARIA ESPERANZA',
    'ORDAZ MAGAÑA',
    '2023-2026'
  ),
  (
    '23316061210066',
    'PAVE080219MASDCSA3',
    'EISLEEN DARELI',
    'PADILLA VICTOR',
    '2023-2026'
  ),
  (
    '23316061210067',
    'RAMR080528HMNMNBA0',
    'RUBEN ALEXIS',
    'RAMIREZ MENDOZA',
    '2023-2026'
  ),
  (
    '23316061210068',
    'RAOJ080922HMNMRSA3',
    'JESUS SALVADOR',
    'RAMIREZ ORTEGA',
    '2023-2026'
  ),
  (
    '23316061210069',
    'RIGF080207MBCVNBA0',
    'FABIOLA',
    'RIVERA GONZALEZ',
    '2023-2026'
  ),
  (
    '23316061210070',
    'FESJ081230MMNLNTA0',
    'JETZABEL',
    'FELIX SANCHEZ',
    '2023-2026'
  ),
  (
    '23316061210071',
    'SEEP071114MMNGSLA9',
    'PAOLA',
    'SEGURA ESCALERA',
    '2023-2026'
  ),
  (
    '23316061210072',
    'TESJ070510HMNLNSA5',
    'JESUS ANTONIO',
    'TELLEZ SANTILLAN',
    '2023-2026'
  ),
  (
    '23316061210073',
    'VXCA080316HMNLJRA0',
    'ARMANDO DANIEL',
    'VALDOVINOS CEJA',
    '2023-2026'
  ),
  (
    '23316061210074',
    'VASJ080512HMNZNNA9',
    'JUAN CARLOS',
    'VAZQUEZ SANDOVAL',
    '2023-2026'
  ),
  (
    '23316061210075',
    'VEGJ070112HMNGLRA9',
    'JORGE JOSUE',
    'VEGA GIL',
    '2023-2026'
  ),
  (
    '23316061210076',
    'VEGJ080220MMNGLLA4',
    'JULIETA',
    'VEGA GIL',
    '2023-2026'
  ),
  (
    '23316061210077',
    'VEVD081009HMNGLGA2',
    'DIEGO URBANO',
    'VEGA VALDOVINOS',
    '2023-2026'
  ),
  (
    '23316061210078',
    'VIME070827HMNVNMA8',
    'EMMANUEL',
    'VIVAS MANRIQUES',
    '2023-2026'
  ),
  (
    '23316061210079',
    'AUGF081021MMNGNTA7',
    'FATIMA',
    'AGUILERA GONZALEZ',
    '2023-2026'
  ),
  (
    '23316061210080',
    'AUOC080918HMNGCSA5',
    'CESAR',
    'AGUIRRE OCHOA',
    '2023-2026'
  ),
  (
    '23316061210081',
    'AACS060421HMNLSRA9',
    'SERGIO ANGEL',
    'ALVARADO CASTILLO',
    '2023-2026'
  ),
  (
    '23316061210082',
    'AEAJ080918HMNRVNA7',
    'JUAN MANUEL',
    'ARCEO AVALOS',
    '2023-2026'
  ),
  (
    '23316061210083',
    'AADB080926HMNVZRA4',
    'BRYAN ALEXANDER',
    'AVALOS DIAZ',
    '2023-2026'
  ),
  (
    '23316061210084',
    'AARC080831HMNYDRA2',
    'CRISTIAN GIOVANNI',
    'AYALA RODRIGUEZ',
    '2023-2026'
  ),
  (
    '23316061210085',
    'CAGE080916MMNDRLA3',
    'MARIA ELENA',
    'CADENAS GARCIA',
    '2023-2026'
  ),
  (
    '23316061210086',
    'CAMJ061111HNERRNA5',
    'JUAN MARTIN',
    'CARDENAS MARTINEZ',
    '2023-2026'
  ),
  (
    '23316061210087',
    'CAGD080705MMNSDNA3',
    'DANIELA',
    'CASTAÑEDA GUDIÑO',
    '2023-2026'
  ),
  (
    '23316061210088',
    'CEGJ080101HMNJRSA9',
    'JESUS ALBERTO',
    'CEJA GRANADOS',
    '2023-2026'
  ),
  (
    '23316061210089',
    'CEHH081008HMNJRCA0',
    'HECTOR',
    'CEJA HERRERA',
    '2023-2026'
  ),
  (
    '23316061210090',
    'CEHN080106MMNJTYA2',
    'NAYELI',
    'CEJA HUITRON',
    '2023-2026'
  ),
  (
    '23316061210091',
    'CEBK081030MMNNCRA9',
    'KAROL ITALIA',
    'CENICERO BECERRA',
    '2023-2026'
  ),
  (
    '23316061210092',
    'CEMS080719HMNRJLA0',
    'SALVADOR',
    'CERVANTES MUJICA',
    '2023-2026'
  ),
  (
    '23316061210093',
    'CAMD080311MMNHRLA3',
    'DULCE MARIA',
    'CHAVEZ MARIN',
    '2023-2026'
  ),
  (
    '23316061210094',
    'CORS060912HMNNVRA6',
    'SERGIO IGNACIO',
    'CONTRERAS RIVAS',
    '2023-2026'
  ),
  (
    '23316061210095',
    'FAGJ080827HMNRLRA8',
    'JORGE ARMANDO',
    'FARIAS GIL',
    '2023-2026'
  ),
  (
    '23316061210096',
    'GARA080113HNTLDNA9',
    'ANGEL SALVADOR',
    'GALVAN RODRIGUEZ',
    '2023-2026'
  ),
  (
    '23316061210097',
    'GABX081213MMNRSMA1',
    'XIMENA GUADALUPE',
    'GARCIA BUSTOS',
    '2023-2026'
  ),
  (
    '23316061210098',
    'GAGD080829HMNRRGA0',
    'DIEGO',
    'GARCIA GARCIA',
    '2023-2026'
  ),
  (
    '23316061210099',
    'GIRJ081205HMNRMRA0',
    'JORGE EDUARDO',
    'GIRARTE RAMIREZ',
    '2023-2026'
  ),
  (
    '23316061210100',
    'GOWR080818MMNMTSA0',
    'ROSA ISELA',
    'GOMEZ WUITRON',
    '2023-2026'
  ),
  (
    '23316061210101',
    'GUDA081101MMNZZLA6',
    'ALEJANDRA SOFIA',
    'GUZMAN DIAZ',
    '2023-2026'
  ),
  (
    '23316061210102',
    'GUGD080226MMNZTNA7',
    'DANA PAOLA',
    'GUZMAN GUTIERREZ',
    '2023-2026'
  ),
  (
    '23316061210103',
    'GURR080721HMNZZCA9',
    'RICARDO',
    'GUZMAN RUIZ',
    '2023-2026'
  ),
  (
    '23316061210104',
    'HEME080901MMNRRSA5',
    'ESPERANZA YARETZI',
    'HERNANDEZ MARTINEZ',
    '2023-2026'
  ),
  (
    '23316061210105',
    'HICL081009HMNGNSA7',
    'LUIS ROBERTO',
    'HIGAREDA CANELA',
    '2023-2026'
  ),
  (
    '23316061210106',
    'JAMM080725MMNRNYA5',
    'MAYRA GUADALUPE',
    'JAUREGUI MANZO',
    '2023-2026'
  ),
  (
    '23316061210107',
    'MAAJ081206MMNRYLA6',
    'JULIANA',
    'MARTINEZ AYAR',
    '2023-2026'
  ),
  (
    '23316061210108',
    'MUAC080730MMNJNLA8',
    'CLAUDIA VERONICA',
    'MUJICA ANAYA',
    '2023-2026'
  ),
  (
    '23316061210109',
    'NASC081209HMNVNRA9',
    'CRISTOPHER ALEXANDER',
    'NAVARRETE SANCHEZ',
    '2023-2026'
  ),
  (
    '23316061210110',
    'OOSL080710HMNCNSA8',
    'JOSE LUIS',
    'OCHOA SANCHEZ',
    '2023-2026'
  ),
  (
    '23316061210111',
    'RAFA080520HMNMLNA6',
    'JOSE ANTONIO',
    'RAMIREZ FLORES',
    '2023-2026'
  ),
  (
    '23316061210112',
    'ROOJ060908HJCDRSA2',
    'JESUS EDUARDO',
    'RODRIGUEZ ORDAZ',
    '2023-2026'
  ),
  (
    '23316061210113',
    'SANF081002MMNNVRA6',
    'FRANEA',
    'SANCHEZ NAVARRO',
    '2023-2026'
  ),
  (
    '23316061210114',
    'SETO080618MMNGRLA0',
    'OLGA LIDIA',
    'SEGURA TORO',
    '2023-2026'
  ),
  (
    '23316061210115',
    'UIGK070411MMNRRRA2',
    'KARLA',
    'URBINA GRANADOS',
    '2023-2026'
  ),
  (
    '23316061210116',
    'VAGD080129MMNLNNA3',
    'DIANA MARIA',
    'VALENZUELA GONZALEZ',
    '2023-2026'
  ),
  (
    '23316061210117',
    'VEEC081212MMNGSMA6',
    'CAMILA RAEMA',
    'VEGA ESPINOZA',
    '2023-2026'
  ),
  (
    '23316061210118',
    'AASG080701MNELGDA7',
    'GUADALUPE VIRIDIANA',
    'ALANIS SEGURA',
    '2023-2026'
  ),
  (
    '23316061210119',
    'AIGN080224MMNVRDA2',
    'NAIDELINE MONTSERRAT',
    'AVILA GARCIA',
    '2023-2026'
  ),
  (
    '23316061210120',
    'AIGV080305MMNVRNA7',
    'VANESSA GUADALUPE',
    'AVILA GARCIA',
    '2023-2026'
  ),
  (
    '23316061210121',
    'AALR080618HMNYPDA6',
    'RODOLFO',
    'AYALA LOPEZ',
    '2023-2026'
  ),
  (
    '23316061210122',
    'BEVD080711MMNNVNA7',
    'DENICE',
    'BENAVIDES VIVAS',
    '2023-2026'
  ),
  (
    '23316061210123',
    'BEFF080327MMNRLTA7',
    'FATIMA YANELI',
    'BERROCAL FLORES',
    '2023-2026'
  ),
  (
    '23316061210124',
    'CAAR080624HMNBLMA5',
    'RAMON EDUARDO',
    'CABEZAS ALCALA',
    '2023-2026'
  ),
  (
    '23316061210125',
    'CAGG080327HMNBLVA5',
    'GIOVANNI',
    'CABEZAS GIL',
    '2023-2026'
  ),
  (
    '23316061210126',
    'CEAA081013MMNJVLA9',
    'ALONDRA IVETTE',
    'CEJA AVALOS',
    '2023-2026'
  ),
  (
    '23316061210127',
    'CEHK070104MMNJGRA5',
    'KAREN DANIELA',
    'CEJA HIGAREDA',
    '2023-2026'
  ),
  (
    '23316061210128',
    'CESD080221MMNRNLA9',
    'DULCE MARIA',
    'CERVANTES SANTOYO',
    '2023-2026'
  ),
  (
    '23316061210129',
    'DIRJ080915MMNZMLA0',
    'JULISSA',
    'DIAZ RAMIREZ',
    '2023-2026'
  ),
  (
    '23316061210130',
    'EICP080617MMNSJLA5',
    'PILAR GUADALUPE',
    'ESPINOZA CEJA',
    '2023-2026'
  ),
  (
    '23316061210131',
    'FUFM081109MMNRLYA8',
    'MAYRA ROCIO',
    'FRUTOS FLORES',
    '2023-2026'
  ),
  (
    '23316061210132',
    'GARC071205HMNRDRA0',
    'CRISTIAN SANTIAGO',
    'GARCIA RODRIGUEZ',
    '2023-2026'
  ),
  (
    '23316061210133',
    'GOFO070315HJCNRSA8',
    'OSCAR EMILIANO',
    'GONZALEZ FARIAS',
    '2023-2026'
  ),
  (
    '23316061210134',
    'GOGJ080702HMNNLNA1',
    'JONATHAN JULIAN',
    'GONZALEZ GALVEZ',
    '2023-2026'
  ),
  (
    '23316061210135',
    'GIXB080718MNERXRA3',
    'BRIANNA',
    'GRIMALDO',
    '2023-2026'
  ),
  (
    '23316061210136',
    'GUHE080521HMNRRRA1',
    'ERICK JULIAN',
    'GUERRERO HORTA',
    '2023-2026'
  ),
  (
    '23316061210137',
    'HEAM080222MMNRGRA6',
    'MARTHA',
    'HERNANDEZ AGUILAR',
    '2023-2026'
  ),
  (
    '23316061210138',
    'HEGK080213MMNRRMA1',
    'KIMBERLY GUADALUPE',
    'HERRERA GARCIA',
    '2023-2026'
  ),
  (
    '23316061210139',
    'LOOS080123HMNPCLA1',
    'JOSE SAUL',
    'LOPEZ OCHOA',
    '2023-2026'
  ),
  (
    '23316061210140',
    'MATD081108HMNRRGA2',
    'DIEGO',
    'MARTINEZ TORRE',
    '2023-2026'
  ),
  (
    '23316061210141',
    'MOMD080707MMNRGYA1',
    'DAYANAN CAMILA',
    'MORAN MAGALLON',
    '2023-2026'
  ),
  (
    '23316061210142',
    'MUSA080422MMNXNNA8',
    'MARIA DE LOS ANGELES',
    'MUÑIZ SANCHEZ',
    '2023-2026'
  ),
  (
    '23316061210143',
    'MURA071217HMNXMRA1',
    'AARON',
    'MUÑOZ RAMIREZ',
    '2023-2026'
  ),
  (
    '23316061210144',
    'NAFY080511MMNVRRA9',
    'YURITZI GUADALUPE',
    'NAVA FRUTOS',
    '2023-2026'
  ),
  (
    '23316061210145',
    'NAEJ071007HMNVLRA5',
    'JORGE',
    'NAVARRETE EULLOQUE',
    '2023-2026'
  ),
  (
    '23316061210146',
    'OOHD080626MMNCRNA5',
    'DIANA CAMILA',
    'OCHOA HERNANDEZ',
    '2023-2026'
  ),
  (
    '23316061210147',
    'OIVD080413MJCRLRA3',
    'DAIRA SAMMAI',
    'ORTIZ VILLA',
    '2023-2026'
  ),
  (
    '23316061210148',
    'OONL080708HMNSVSA1',
    'LUIS FABIAN',
    'OSORIO NAVARRETE',
    '2023-2026'
  ),
  (
    '23316061210149',
    'PUID080822MMNLBNA6',
    'DANIELA GUADALUPE',
    'PULIDO IBARRA',
    '2023-2026'
  ),
  (
    '23316061210150',
    'RARF080227MMNMMRA4',
    'FERNANDA ANAHI',
    'RAMIREZ RAMIREZ',
    '2023-2026'
  ),
  (
    '23316061210151',
    'RARJ080614HJCMDVA8',
    'JOVANI',
    'RAMIREZ RODRIGUEZ',
    '2023-2026'
  ),
  (
    '23316061210152',
    'REOP081114MMNYRLA7',
    'PAULINA JAZMIN',
    'REYES ORTEGA',
    '2023-2026'
  ),
  (
    '23316061210153',
    'ROLK080514MMNDNNA6',
    'KENIA ANGELLI',
    'RODRIGUEZ LEON',
    '2023-2026'
  ),
  (
    '23316061210154',
    'SEAE080725MMNGVRA4',
    'ERICKA JOCELINE',
    'SEGURA AVALOS',
    '2023-2026'
  ),
  (
    '23316061210155',
    'SIRJ081011MMNLBZA9',
    'JAZMIN GUADALUPE',
    'SILVERIO RUBIO',
    '2023-2026'
  ),
  (
    '23316061210156',
    'VEMA081216MMNGCLA3',
    'ALIXON ROBERTA',
    'VEGA MACIAS',
    '2023-2026'
  ),
  (
    '23316061210157',
    'AAAS081212MMNLYRA2',
    'SARAHI GUADALUPE',
    'ALARCON AYALA',
    '2023-2026'
  ),
  (
    '23316061210158',
    'AAGJ080803MMNLRCA9',
    'JOCELYN',
    'ALCALA GARCIA',
    '2023-2026'
  ),
  (
    '23316061210159',
    'AAAA081024MMNLYNA6',
    'ANDREA',
    'ALCAZAR AYALA',
    '2023-2026'
  ),
  (
    '23316061210160',
    'AAGJ080819MMNLNMA5',
    'JIMENA',
    'ALCAZAR GONZALEZ',
    '2023-2026'
  ),
  (
    '23316061210161',
    'AEAO080203HMNMYSA9',
    'OSCAR DANIEL',
    'AMEZCUA AYALA',
    '2023-2026'
  ),
  (
    '23316061210162',
    'AAPA080103MMNNRLA4',
    'ALEXANDRA',
    'ANDRADE PEREZ',
    '2023-2026'
  ),
  (
    '23316061210163',
    'AOZV080709MMNROLA2',
    'VALERIA LIZZETH',
    'ARROYO ZEPEDA',
    '2023-2026'
  ),
  (
    '23316061210164',
    'AASJ080724HMNVNSA7',
    'JOSE DE JESUS',
    'AVALOS SANCHEZ',
    '2023-2026'
  ),
  (
    '23316061210165',
    'BAGF080124HMNRTRA8',
    'FRANCISCO',
    'BARRAGAN GUTIERREZ',
    '2023-2026'
  ),
  (
    '23316061210166',
    'BOTO080602HMNNRSA2',
    'OSCAR UBALDO',
    'BONILLA TORRES',
    '2023-2026'
  ),
  (
    '23316061210167',
    'GOBA080620HMNNNLA3',
    'JOSE ALFREDO',
    'BUENROSTRO GONZALEZ',
    '2023-2026'
  ),
  (
    '23316061210168',
    'CELB081013MMNRPRA6',
    'BRENDA GUDALUPE',
    'CERVANTES LOPEZ',
    '2023-2026'
  ),
  (
    '23316061210169',
    'CAVA081102MMNHGLA8',
    'ALEXA MICHELLE',
    'CHAVEZ VEGA',
    '2023-2026'
  ),
  (
    '23316061210170',
    'CICA070831MMNSHDA8',
    'ADRIANA LIZETH',
    'CISNEROS CHAVEZ',
    '2023-2026'
  ),
  (
    '23316061210171',
    'CIPC080207MMNSRYA3',
    'CYNTHIA PAULINA',
    'CISNEROS PEREZ',
    '2023-2026'
  ),
  (
    '23316061210172',
    'FUND080810MMNRXNA5',
    'DANAE GUADALUPE',
    'FRUTOS NUÑEZ',
    '2023-2026'
  ),
  (
    '23316061210173',
    'GAZG080623MMNRPBA4',
    'MARIA GABRIELA',
    'GARCIA ZAPIEN',
    '2023-2026'
  ),
  (
    '23316061210174',
    'GIGA080813HMNRRLA8',
    'ALEJANDRO DE JESUS',
    'GIRARTE GUERERO',
    '2023-2026'
  ),
  (
    '23316061210175',
    'GOAA080527MHNMCLA6',
    'ALFREDO',
    'GOMEZ AVALOS',
    '2023-2026'
  ),
  (
    '23316061210176',
    'GOLF080601MMNNMRA2',
    'MARIA FERNANDA',
    'GONZALEZ LOMELI',
    '2023-2026'
  ),
  (
    '23316061210177',
    'GAMS080731MMNRLFA8',
    'SOFIA BERENICE',
    'GRANADOS MELGOZA',
    '2023-2026'
  ),
  (
    '23316061210178',
    'GUAB080731HMNDVRA5',
    'BRYAN EDUARDO',
    'GUDIÑO AVALOS',
    '2023-2026'
  ),
  (
    '23316061210179',
    'GUMV080509MMNDNLA5',
    'VALERIA',
    'GUDIÑO MANZO',
    '2023-2026'
  ),
  (
    '23316061210180',
    'JICJ081016MMNMRCA9',
    'JOCELYNE ADRIANA',
    'JIMENEZ CARDENAS',
    '2023-2026'
  ),
  (
    '23316061210181',
    'MENM080429MMNLVRA4',
    'MARLENE',
    'MELGOZA NAVARRO',
    '2023-2026'
  ),
  (
    '23316061210182',
    'MOBJ080205HMNRTNA0',
    'JUAN FRANCISCO',
    'MORENO BAUTISTA',
    '2023-2026'
  ),
  (
    '23316061210183',
    'NAGH080926HMNVRGA0',
    'HUGO EMILIANO',
    'NAVARRO GARIBAY',
    '2023-2026'
  ),
  (
    '23316061210184',
    'OOZR080611MMNRMBA1',
    'RUBI',
    'OROZCO ZAMORA',
    '2023-2026'
  ),
  (
    '23316061210185',
    'OISW080418MMNRGNA4',
    'WENDY ITZEL',
    'ORTIZ SEGURA',
    '2023-2026'
  ),
  (
    '23316061210186',
    'OIGF080928MMNVZRA2',
    'MARIA FERNANDA',
    'OVIEDO GUZMAN',
    '2023-2026'
  ),
  (
    '23316061210187',
    'PAMI081116HMNLRVA8',
    'IVAN JONATHAN',
    'PALOMERA MARTINEZ',
    '2023-2026'
  ),
  (
    '23316061210188',
    'PECM081002MMNRRNA9',
    'MONTSERRAT GUADALUPE',
    'PEREZ CERVANTES',
    '2023-2026'
  ),
  (
    '23316061210189',
    'PAVE080206HMNRLMA2',
    'EMMANUEL',
    'PRADO VILLANUEVA',
    '2023-2026'
  ),
  (
    '23316061210190',
    'ROCD070618HMNDJGA8',
    'DIEGO ARMANDO',
    'RODRIGUEZ CEJA',
    '2023-2026'
  ),
  (
    '23316061210191',
    'RUMP080912MMCBXLA0',
    'PAULINA',
    'RUBIO MUÑOZ',
    '2023-2026'
  ),
  (
    '23316061210192',
    'SIVG081215HMNLGBA7',
    'GABRIEL RAFAEL',
    'SILVA VEGA',
    '2023-2026'
  ),
  (
    '23316061210193',
    'ZELS080117MMNPNNA6',
    'SANDRA PAULINA',
    'ZEPEDA LEON',
    '2023-2026'
  ),
  (
    '23316061210194',
    'AEFA080721MMNMJNA9',
    'ANGELES',
    'AMEZQUITA FAJARDO',
    '2023-2026'
  ),
  (
    '23316061210195',
    'AEFJ080503HMNRLNA0',
    'JUAN PABLO',
    'ARCEO FLORES',
    '2023-2026'
  ),
  (
    '23316061210196',
    'AAGR080423MMNYNXA2',
    'MARIA ROXANA',
    'AYALA GONZALEZ',
    '2023-2026'
  ),
  (
    '23316061210197',
    'CABJ080305MMNBLCA8',
    'JOCELIN AMAIRANY',
    'CABEZAS BALTIERRA',
    '2023-2026'
  ),
  (
    '23316061210198',
    'CAQV080228HMNBNCA3',
    'VICTOR MANUEL',
    'CABEZAS QUINTERO',
    '2023-2026'
  ),
  (
    '23316061210199',
    'CAMY080422HMNSNLA3',
    'YAEL',
    'CASTAÑEDA MENDEZ',
    '2023-2026'
  ),
  (
    '23316061210200',
    'CADS080623HMNSZNA8',
    'SANTIAGO OSVALDO',
    'CASTILLEJO DIAZ',
    '2023-2026'
  ),
  (
    '23316061210201',
    'CEMJ080909HMNRRSA8',
    'JESUS FERNANDO',
    'CERRITEÑO MARTINEZ',
    '2023-2026'
  ),
  (
    '23316061210202',
    'EICM080316MMNLNNA5',
    'MONICA ESTRELLA',
    'ELIAS CANELA',
    '2023-2026'
  ),
  (
    '23316061210203',
    'FOCD071003MMNLJNA0',
    'DANA XIMENA',
    'FLORES CEJA',
    '2023-2026'
  ),
  (
    '23316061210204',
    'GAAD080930MMNLGNA8',
    'DANNA PAOLA',
    'GALLEGOS AGUILAR',
    '2023-2026'
  ),
  (
    '23316061210205',
    'GARB080915MMNRCRA1',
    'BRITTANY GUADALUPE',
    'GARCIA ROCHA',
    '2023-2026'
  ),
  (
    '23316061210206',
    'GOSD080319HMNMNNA1',
    'DANIEL IVAN',
    'GOMEZ SANDOVAL',
    '2023-2026'
  ),
  (
    '23316061210207',
    'GOVI080417HMNNLSA0',
    'ISACC',
    'GONZALEZ VALENCIA',
    '2023-2026'
  ),
  (
    '23316061210208',
    'GINJ081208MMNRVSA0',
    'JESSICA ESTEFANIA',
    'GRIMALDO NAVARRO',
    '2023-2026'
  ),
  (
    '23316061210209',
    'HECO081109HMNRRSA4',
    'OSCAR',
    'HERNANDEZ CERVANTES',
    '2023-2026'
  ),
  (
    '23316061210210',
    'HISF080506MMNNLRA5',
    'FRANIA MARELY',
    'HINOJOSA SILVA',
    '2023-2026'
  ),
  (
    '23316061210211',
    'IADE081118MMNBZVA6',
    'EVELYN SOFIA',
    'IBARRA DIAZ',
    '2023-2026'
  ),
  (
    '23316061210212',
    'LOZJ081212HMNZRRA6',
    'JORGE EDUARDO',
    'LOZANO ZARAGOZA',
    '2023-2026'
  ),
  (
    '23316061210213',
    'MARY080311MMNNMRA0',
    'YARELI GUADALUPE',
    'MANZO RAMIREZ',
    '2023-2026'
  ),
  (
    '23316061210214',
    'MABJ080910HMNRRNA1',
    'JONATHAN ALEXANDER',
    'MARTINEZ BARRAGAN',
    '2023-2026'
  ),
  (
    '23316061210215',
    'NACB081228HMNVBRA3',
    'BRYAN EDUARDO',
    'NAVARRETE CABEZAS',
    '2023-2026'
  ),
  (
    '23316061210216',
    'NEAF080618MMNGVTA5',
    'FATIMA GUADALUPE',
    'NEGRETE AVILA',
    '2023-2026'
  ),
  (
    '23316061210217',
    'NECD080625MJCGNNA4',
    'DIANA ABIGAIL',
    'NEGRETE CONCHAS',
    '2023-2026'
  ),
  (
    '23316061210218',
    'NUAF080927HMNXVLA9',
    'FLAVIO MIGUEL',
    'NUÑEZ AVALOS',
    '2023-2026'
  ),
  (
    '23316061210219',
    'OALM080813MMNRPRA9',
    'MARIANA LIZETH',
    'ORDAZ LOPEZ',
    '2023-2026'
  ),
  (
    '23316061210220',
    'PAOG080124MMNDLDA5',
    'GUADALUPE',
    'PADILLA OLIVARES',
    '2023-2026'
  ),
  (
    '23316061210221',
    'RAPE081004HMNMRNA9',
    'ENRIQUE MAURICIO',
    'RAMIREZ PRECIADO',
    '2023-2026'
  ),
  (
    '23316061210222',
    'RAAQ080331MMNZGTA3',
    'MARIA QUETZALI',
    'RAZO AGUILAR',
    '2023-2026'
  ),
  (
    '23316061210223',
    'ROCD080516HMNDSNA3',
    'DANIEL',
    'RODRIGUEZ CASTILLO',
    '2023-2026'
  ),
  (
    '23316061210224',
    'SAOS080904HMNNCNAS',
    'SANTIAGO',
    'SANCHEZ OCHOA',
    '2023-2026'
  ),
  (
    '23316061210225',
    'SAOB080321HMNNRRA8',
    'BRYAN ALEJANDRO',
    'SANCHEZ OROZCO',
    '2023-2026'
  ),
  (
    '23316061210226',
    'SARJ080622HMNNDSA5',
    'JESUS ISAAC',
    'SANCHEZ RODRIGUEZ',
    '2023-2026'
  ),
  (
    '23316061210227',
    'SAGA080412MMNGRNA9',
    'MARIA DE LOS ANGELES',
    'SEGURA GARCIA',
    '2023-2026'
  ),
  (
    '23316061210228',
    'SERC081119MMNGDMA8',
    'CAMILA ROCIO',
    'SEGURA RODRIGUEZ',
    '2023-2026'
  ),
  (
    '23316061210229',
    'TOVA081201MMNRLLA1',
    'ALEJANDRA GUADALUPE',
    'TORRES VALDES',
    '2023-2026'
  ),
  (
    '23316061210230',
    'VAHE080826MMNSRMB3',
    'EMILY MARGARITA',
    'VASQUEZ HERRERA',
    '2023-2026'
  ),
  (
    '23316061210231',
    'ZATD080128MMNPRLA7',
    'DULCE JACQEULINE',
    'ZAPIEN TORRES',
    '2023-2026'
  ),
  (
    '23316061210232',
    'ZACD080801HMNRRNA5',
    'DANIEL DE JESUS',
    'ZARAGOZA CRUZ',
    '2023-2026'
  ),
  (
    '23316061210233',
    'ZESD080320MMNPNNA9',
    'DANA PAOLA',
    'ZEPEDA SANCHEZ',
    '2023-2026'
  ),
  (
    '23316061210234',
    'AARO080422HMNLCMA4',
    'OMAR',
    'ALCALA ROCHA',
    '2023-2026'
  ),
  (
    '23316061210235',
    'AERA080701HMNRDRA0',
    'AARON',
    'ARTEAGA RODRIGUEZ',
    '2023-2026'
  ),
  (
    '23316061210236',
    'AERA080625MMNSXNA1',
    'ANA LAURA',
    'ASCENCIO ROA',
    '2023-2026'
  ),
  (
    '23316061210237',
    'AAFA080129HMNYLNA8',
    'JOSE ANTONIO',
    'AYALA FLORES',
    '2023-2026'
  ),
  (
    '23316061210238',
    'AAMY081001MMNYRRA9',
    'YARENI',
    'AYALA MARTINEZ',
    '2023-2026'
  ),
  (
    '23316061210239',
    'CESA080225HMNRNNA2',
    'ANGEL GIOVANNI',
    'CERAS SANDOVAL',
    '2023-2026'
  ),
  (
    '23316061210240',
    'CADJ081011HMNHZSA2',
    'JESUS ENRIQUE',
    'CHAVEZ DIAZ',
    '2023-2026'
  ),
  (
    '23316061210241',
    'CAME080104MMNHXSA5',
    'ESTEFANIA GUADALUPE',
    'CHAVEZ MUÑIZ',
    '2023-2026'
  ),
  (
    '23316061210242',
    'COCE081120HSPRRRA9',
    'ERWIN GERARDO',
    'CORTES CORONA',
    '2023-2026'
  ),
  (
    '23316061210243',
    'EAZS081110HMNSPBA0',
    'SEBASTIAN',
    'ESTRADA ZEPEDA',
    '2023-2026'
  ),
  (
    '23316061210244',
    'FOVJ070213HNELLRA4',
    'JEREMI MOISES',
    'FLORES VALENCIA',
    '2023-2026'
  ),
  (
    '23316061210245',
    'GARJ080321HMNLYSA3',
    'JESUS JAVIER',
    'GALVEZ REYES',
    '2023-2026'
  ),
  (
    '23316061210246',
    'GIGF080719MMCLTRA2',
    'MARIA FERNANDA',
    'GIL GUTIERREZ',
    '2023-2026'
  ),
  (
    '23316061210247',
    'GOCP080303MMNNBLB9',
    'PAULA DANIELA',
    'GONZALEZ CABEZAS',
    '2023-2026'
  ),
  (
    '23316061210248',
    'GAGC080207HMNRRHA6',
    'CHRISTOPHER',
    'GRANADOS GARCIA',
    '2023-2026'
  ),
  (
    '23316061210249',
    'GUPC080421HMNRRRA8',
    'CARLOS GIOVANNY',
    'GUERRERO PEREZ',
    '2023-2026'
  ),
  (
    '23316061210250',
    'HEGF080819MMNRTTA4',
    'FATIMA',
    'HERNANDEZ GUTIERREZ',
    '2023-2026'
  ),
  (
    '23316061210251',
    'HEGV080819MMNRTCA3',
    'VICTORIA',
    'HERNANDEZ GUTIERREZ',
    '2023-2026'
  ),
  (
    '23316061210252',
    'LOSJ080325HMNMNLA3',
    'JOEL ADRIAN',
    'LOMELI SANCHEZ',
    '2023-2026'
  ),
  (
    '23316061210253',
    'LOHA080413HMNPRNA1',
    'ANGEL GABRIEL',
    'LOPEZ HERNANDEZ',
    '2023-2026'
  ),
  (
    '23316061210254',
    'MAMR080327HMNCRBA9',
    'RUBEN',
    'MACIAS MORENO',
    '2023-2026'
  ),
  (
    '23316061210255',
    'MACY080612MMNGSLA2',
    'YULEIDY',
    'MAGALLON CASTELLANOS',
    '2023-2026'
  ),
  (
    '23316061210256',
    'MAGJ080402HMNGRSA0',
    'JESUS ALEXIS',
    'MAGALLON GARCIA',
    '2023-2026'
  ),
  (
    '23316061210257',
    'MAOE080424MMNGRSA3',
    'ESMERALDA',
    'MAGAÑA ORTIZ',
    '2023-2026'
  ),
  (
    '23316061210258',
    'MAHA080610HMNNRNA8',
    'ANGEL EDUARDO',
    'MANZO HERNANDEZ',
    '2023-2026'
  ),
  (
    '23316061210259',
    'MEAJ080731HMNNLSA7',
    'JESUS',
    'MENDEZ ALVAREZ',
    '2023-2026'
  ),
  (
    '23316061210260',
    'NIAJ080813HMNTYNA9',
    'JONATHAN',
    'NIETO AYALA',
    '2023-2026'
  ),
  (
    '23316061210261',
    'NUGA080226HMNXLLA8',
    'ALEJANDRO',
    'NUÑEZ GALVEZ',
    '2023-2026'
  ),
  (
    '23316061210262',
    'OUMB070324MMNLRRA7',
    'BRISA IVETTE',
    'OLGUIN MURILLO',
    '2023-2026'
  ),
  (
    '23316061210263',
    'OOMK071009HJCNRRA7',
    'KAROL RAFAEL',
    'ONOFRE MARTINEZ',
    '2023-2026'
  ),
  (
    '23316061210264',
    'ROFJ080314MJCMLSA1',
    'JOSELIN',
    'ROMERO FLORES',
    '2023-2026'
  ),
  (
    '23316061210265',
    'VIGV080902MMNVRLA8',
    'VALERIA ALEJANDRA',
    'VIVAS GARCIA',
    '2023-2026'
  ),
  (
    '23316061210266',
    'ZEEE081107HNEPSRA9',
    'ERICK',
    'ZEPEDA ESTRADA',
    '2023-2026'
  ),
  (
    '23316061210267',
    'ZEFS080822MMNPLNA8',
    'SONIA NAHOMI',
    'ZEPEDA FLORES',
    '2023-2026'
  ),
  (
    '23316061210268',
    'GAHG061106HJCRRDA3',
    'GUADALUPE DE JESUS',
    'GARDUÑO HERNANDEZ',
    '2023-2026'
  ),
  (
    '23316061210269',
    'CAAM060109HMNBVNA4',
    'MANUEL SALVADOR',
    'CABEZAS AVALOS',
    '2023-2026'
  ),
  (
    '23316061210270',
    'MOFJ030715HMNRRNA4',
    'JUAN PABLO',
    'MORENO FARIAS',
    '2023-2026'
  ),
  (
    '23316061210271',
    'AOIJ081223HMNLBSA3',
    'JESUS JAVIER',
    'ALONSO IBARRA',
    '2023-2026'
  ),
  (
    '23316061210272',
    'AARG080518MMNVMDA6',
    'GUADALUPE ABIGAIL',
    'AVALOS RAMIREZ',
    '2023-2026'
  ),
  (
    '23316061210273',
    'AACR080602HMNYJFA6',
    'JOSE RAFAEL',
    'AYALA CEJA',
    '2023-2026'
  ),
  (
    '23316061210274',
    'CAGF070720MMNBRRA6',
    'FERNANDA JOCELYN',
    'CABEZAS GRIMALDO',
    '2023-2026'
  ),
  (
    '23316061210275',
    'CACE080508MMNRNMA5',
    'EMELIN AIDEE',
    'CARDENAS CONTRERAS',
    '2023-2026'
  ),
  (
    '23316061210276',
    'CIAA080529HMNHLNA2',
    'ANGEL',
    'CHIA ALCALA',
    '2023-2026'
  ),
  (
    '23316061210277',
    'COOL070207HMNRRSA1',
    'LUIS FERNANDO',
    'CORTEZ ORTIZ',
    '2023-2026'
  ),
  (
    '23316061210278',
    'CUSC080912HMNVNRA8',
    'CRISTIAN SALVADOR',
    'CUEVAS SANCHEZ',
    '2023-2026'
  ),
  (
    '23316061210279',
    'EUGV080624MMNSNLA1',
    'VIOLETA',
    'ESQUIVEL GONZALEZ',
    '2023-2026'
  ),
  (
    '23316061210280',
    'GACY080905MMNRBNA6',
    'YUNUEN GUADALUPE',
    'GARCIA CABEZAS',
    '2023-2026'
  ),
  (
    '23316061210281',
    'GAOC081111MJCRSCA3',
    'CECILIA JACQUELINE',
    'GARCIA OSORIO',
    '2023-2026'
  ),
  (
    '23316061210282',
    'GILB080905MMNLPRA6',
    'BRITTANY',
    'GIL LOPEZ',
    '2023-2026'
  ),
  (
    '23316061210283',
    'GOCJ081128HMNNHVA4',
    'JAVIER SALVADOR',
    'GONZALEZ CHAVEZ',
    '2023-2026'
  ),
  (
    '23316061210284',
    'GORI080201HMNNNRA5',
    'IRVIN AXEL',
    'GONZALEZ RENTERIA',
    '2023-2026'
  ),
  (
    '23316061210285',
    'HECA080325HMNRHXA4',
    'AXEL MANUEL',
    'HERNANDEZ CHAVEZ',
    '2023-2026'
  ),
  (
    '23316061210286',
    'HEGJ080223MMNRNLA2',
    'JULIETA',
    'HERNANDEZ GONZALEZ',
    '2023-2026'
  ),
  (
    '23316061210287',
    'HIZK080829MJCGMRA6',
    'KAROL SARAHI',
    'HIGAREDA ZAMBRANO',
    '2023-2026'
  ),
  (
    '23316061210288',
    'JILB070921HMNMPRA6',
    'BRAULIO ALBERTO',
    'JIMENEZ LOPEZ',
    '2023-2026'
  ),
  (
    '23316061210289',
    'LOCJ081025HMNPRNA0',
    'JUAN CARLOS',
    'LOPEZ CORONA',
    '2023-2026'
  ),
  (
    '23316061210290',
    'MAVM080522HMNGCRA5',
    'MARCO JULIAN',
    'MAGAÑA VICTORIA',
    '2023-2026'
  ),
  (
    '23316061210291',
    'MAMB061016HMNRGRA7',
    'BRANDON ALEXIS',
    'MARTINEZ MAGAÑA',
    '2023-2026'
  ),
  (
    '23316061210292',
    'MESA080308HMNNNBA5',
    'ABRAHAM',
    'MENDOZA SANCHEZ',
    '2023-2026'
  ),
  (
    '23316061210293',
    'MUOC070416MMNXNNA9',
    'CINTIA ARACELI',
    'MUÑIZ ONOFRE',
    '2023-2026'
  ),
  (
    '23316061210294',
    'NAVF080912MMNVRTA8',
    'FATIMA JOCELYN',
    'NAVARRETE VARGAS',
    '2023-2026'
  ),
  (
    '23316061210295',
    'NUBL080317HMNXLNA7',
    'LEONARDO MIGUEL',
    'NUÑEZ BALTAZAR',
    '2023-2026'
  ),
  (
    '23316061210296',
    'OIMA080710MMNRNLA8',
    'ALEXA',
    'ORTIZ MUNGUIA',
    '2023-2026'
  ),
  (
    '23316061210297',
    'ROFM070119MMNDRRA9',
    'MIRANI NICOLE',
    'RODRIGUEZ FARIAS',
    '2023-2026'
  ),
  (
    '23316061210298',
    'RONI080907MMNDRVA6',
    'IVONNE',
    'RODRIGUEZ NARANJO',
    '2023-2026'
  ),
  (
    '23316061210299',
    'SAGA080302MMNNLNB9',
    'ANA ESTEFANIA',
    'SANDOVAL GIL',
    '2023-2026'
  ),
  (
    '23316061210300',
    'SAGA080302MMNNLNA1',
    'ANA VALERIA',
    'SANDOVAL GIL',
    '2023-2026'
  ),
  (
    '23316061210301',
    'SEVA080805MMNGCNA6',
    'ANDREA NAOMI',
    'SEGURA VICTOR',
    '2023-2026'
  ),
  (
    '23316061210302',
    'SOMK081029HSLLNVA6',
    'KEVIN ELIUT',
    'SOLIS MENDOZA',
    '2023-2026'
  ),
  (
    '23316061210303',
    'VECD080204HMNGSNA4',
    'DANIEL',
    'VEGA CASTILLO',
    '2023-2026'
  ),
  (
    '23316061210304',
    'VIEG080511MMNVSDA3',
    'MARIA GUADALUPE',
    'VIVAS ESPINOZA',
    '2023-2026'
  ),
  (
    '23316061210305',
    'ZESC080923MMNPGMA2',
    'CAMILA',
    'ZEPEDA SIGNORET',
    '2023-2026'
  ),
  (
    '23316061210306',
    'AAGK080917MNENRTA0',
    'KATIA YARITZA',
    'ANAYA GUERRERO',
    '2023-2026'
  ),
  (
    '23316061210307',
    'AACJ080818HMNNRSA7',
    'JESUS SALVADOR',
    'ANDRADE CERVANTES',
    '2023-2026'
  ),
  (
    '23316061210308',
    'AAON081202MMNVSYA0',
    'NAYDELIN',
    'AVALOS OSEGUERA',
    '2023-2026'
  ),
  (
    '23316061210309',
    'AAOA070219HMNYCLA2',
    'ALEJANDRO',
    'AYALA OCHOA',
    '2023-2026'
  ),
  (
    '23316061210310',
    'CAMB081218MMNBRRA8',
    'BRENDA ROXANNA',
    'CABEZAS MORENO',
    '2023-2026'
  ),
  (
    '23316061210311',
    'CATK080513MMNBLRA7',
    'KARLA JOCELYNE',
    'CABEZAS TELLES',
    '2023-2026'
  ),
  (
    '23316061210312',
    'CASP080903MMNBNLA2',
    'PAOLA',
    'CABRERA DE SANTIAGO',
    '2023-2026'
  ),
  (
    '23316061210313',
    'CACD080515MMNMJLA6',
    'DULCE ESTRELLA',
    'CAMPOS CEJA',
    '2023-2026'
  ),
  (
    '23316061210314',
    'CAME080831MMNSRSA9',
    'ESTEFANIA GUADALUPE',
    'CASTILLO MORENO',
    '2023-2026'
  ),
  (
    '23316061210315',
    'CAOJ080915HMNHCNA1',
    'JUAN PABLO',
    'CHAVEZ OCHOA',
    '2023-2026'
  ),
  (
    '23316061210316',
    'DIVM080509MMNZRCA2',
    'MICHELLE ESTEFANIA',
    'DIAZ VARGAS',
    '2023-2026'
  ),
  (
    '23316061210317',
    'GAOA080706HMNLNLA9',
    'ALEXIS GIOVANNY',
    'GALINDO ONOFRE',
    '2023-2026'
  ),
  (
    '23316061210318',
    'GAGD070119MMNLTYA0',
    'DAYANA GERALDINE',
    'GALVEZ GUTIERREZ',
    '2023-2026'
  ),
  (
    '23316061210319',
    'GAHL070905HMNRRSA3',
    'LUIS FELIPE',
    'GARCIA HERRERA',
    '2023-2026'
  ),
  (
    '23316061210320',
    'GOCS080620HMNNRRA1',
    'SERGIO',
    'GONZALEZ CERVANTES',
    '2023-2026'
  ),
  (
    '23316061210321',
    'GOGA070511HJCNDLA5',
    'ALEX MANUEL',
    'GONZALEZ GUDIÑO',
    '2023-2026'
  ),
  (
    '23316061210322',
    'HEOG060919MMNRRDA9',
    'MARIA GUADALUPE',
    'HERNANDEZ ORTIZ',
    '2023-2026'
  ),
  (
    '23316061210323',
    'LEMM060904MMNNNGA6',
    'MAGDALIA VALERIA',
    'LEON MENDOZA',
    '2023-2026'
  ),
  (
    '23316061210324',
    'LOAX080603MMNPYCA6',
    'XOCHITL QUETZAL',
    'LOPEZ AYAR',
    '2023-2026'
  ),
  (
    '23316061210325',
    'MASA080319HMNGNNA3',
    'JOSE ANTONIO',
    'MAGALLON SANCHEZ',
    '2023-2026'
  ),
  (
    '23316061210326',
    'MARE080213MMNRDVA7',
    'EVELYN GUADALUPE',
    'MARTINEZ RODRIGUEZ',
    '2023-2026'
  ),
  (
    '23316061210327',
    'MESJ080616MMNLNNA9',
    'JEANETTE MICHELLE',
    'MELGOZA SANDOVAL',
    '2023-2026'
  ),
  (
    '23316061210328',
    'MESF080219MMNNLTA3',
    'FATIMA GUADALUPE',
    'MENDEZ SILVA',
    '2023-2026'
  ),
  (
    '23316061210329',
    'MERC080115MMNNDRA9',
    'CRISTAL',
    'MENDOZA RODRIGUEZ',
    '2023-2026'
  ),
  (
    '23316061210330',
    'MICC080710MMNRBRA9',
    'CARLA FERNANDA',
    'MIRANDA CABEZAS',
    '2023-2026'
  ),
  (
    '23316061210331',
    'OOGA070508HMNCNLA8',
    'ALEXIS EDUARDO',
    'OCHOA GONZALEZ',
    '2023-2026'
  ),
  (
    '23316061210332',
    'OOZS080917HMNCCNA3',
    'SANTIAGO',
    'OCHOA ZACARIAS',
    '2023-2026'
  ),
  (
    '23316061210333',
    'OIFC071027HMNLGHA0',
    'CHISTOPHER EDUARDO',
    'OLIVEROS FIGUEROA',
    '2023-2026'
  ),
  (
    '23316061210334',
    'OEMP080118MMNRNTA3',
    'PATRICIA BELEN',
    'ORTEGA MONTES',
    '2023-2026'
  ),
  (
    '23316061210335',
    'REMA081115MMNNNLA6',
    'ALONDRA RUBI',
    'RENTERIA MUNGUIA',
    '2023-2026'
  ),
  (
    '23316061210336',
    'SEOL080424MMNGLTA9',
    'LETICIA RUBI',
    'SEGURA OLIVEROS',
    '2023-2026'
  ),
  (
    '23316061210337',
    'SEOJ080309HMNGSSA6',
    'JESUS IVAN',
    'SEGURA OSORIO',
    '2023-2026'
  ),
  (
    '23316061210338',
    'SEVC080207HMNGLRA3',
    'CRISTOFER JOAN',
    'SEGURA VILLANUEVA',
    '2023-2026'
  ),
  (
    '23316061210339',
    'VAGL050812MMNLTSA2',
    'LESLIE GUADALUPE',
    'VALDOINOS GUTIERREZ',
    '2023-2026'
  ),
  (
    '23316061210340',
    'VIPR080105HMNCNCA6',
    'RICARDO ISMAEL',
    'VICTOR PANTOJA',
    '2023-2026'
  ),
  (
    '23316061210341',
    'VITV080126MMNCRNA0',
    'VANESSA',
    'VICTORIA TORRES',
    '2023-2026'
  ),
  (
    '23316061210342',
    'AASJ061003HMNLNNA0',
    'JUAN PABLO',
    'ALANIS SANCHEZ',
    '2023-2026'
  ),
  (
    '23316061210343',
    'AOSN080806MMNLNDA6',
    'NEDAVIA CAROLINA',
    'ALONSO SANCHEZ',
    '2023-2026'
  ),
  (
    '23316061210344',
    'AACA080329MMNVMRA0',
    'ARIANA JACQUELINE',
    'AVALOS CAMPOS',
    '2023-2026'
  ),
  (
    '23316061210345',
    'AACC070605HMNYSHA6',
    'CHRISTIAN RODRIGO',
    'AYALA CASTELLANOS',
    '2023-2026'
  ),
  (
    '23316061210346',
    'AACK070605MMNYSRA3',
    'KAREN MONTSERRAT',
    'AYALA CASTELLANOS',
    '2023-2026'
  ),
  (
    '23316061210347',
    'AAMS060912MMNYNFA8',
    'SOFIA',
    'AYALA MENDEZ',
    '2023-2026'
  ),
  (
    '23316061210348',
    'BAMJ080204HMNRGSA4',
    'JOSE DE JESUS',
    'BARAJAS MAGALLON',
    '2023-2026'
  ),
  (
    '23316061210349',
    'BEAP081106MMNLRLA5',
    'PAOLA GUADALUPE',
    'BELLO ARROYO',
    '2023-2026'
  ),
  (
    '23316061210350',
    'CAML051114HMNRGSA4',
    'LUIS SANTIAGO',
    'CARDENAS MAGAÑA',
    '2023-2026'
  ),
  (
    '23316061210351',
    'CASK080701MMNRNRA6',
    'KARLA JAZMIN',
    'CARDENAS SANCHEZ',
    '2023-2026'
  ),
  (
    '23316061210352',
    'CERJ080926MMNJDHA0',
    'JHULIANA',
    'CEJA RODRIGUEZ',
    '2023-2026'
  ),
  (
    '23316061210353',
    'CEVJ081015HMNJLRA7',
    'JORGE EDUARDO',
    'CEJA VILLASEÑOR',
    '2023-2026'
  ),
  (
    '23316061210354',
    'CEZA081211HMNJPNA7',
    'ANGEL EFRAIN',
    'CEJA ZEPEDA',
    '2023-2026'
  ),
  (
    '23316061210355',
    'TOHX081021MMNRRMA2',
    'XIMENA',
    'DEL TORO HERNANDEZ',
    '2023-2026'
  ),
  (
    '23316061210356',
    'EICA080418MMNLSNA2',
    'ANA SOFIA',
    'ELISEA CASTAÑEDA',
    '2023-2026'
  ),
  (
    '23316061210357',
    'GAMA080306MMNMNNA0',
    'ANA PAULINA',
    'GAMEZ MUNGUIA',
    '2023-2026'
  ),
  (
    '23316061210358',
    'GACM080517MMNRBNA7',
    'MONTSERRAT',
    'GARCIA CABEZAS',
    '2023-2026'
  ),
  (
    '23316061210359',
    'GAGL060501MMNRMSA6',
    'LESLIE PAOLA',
    'GARCIA GOMEZ',
    '2023-2026'
  ),
  (
    '23316061210360',
    'GARM061231HMNRDGA5',
    'MIGUEL EDUARDO',
    'GARCIA RODRIGUEZ',
    '2023-2026'
  ),
  (
    '23316061210361',
    'GAGA080730HNERRNA3',
    'ANGEL JOVANNY',
    'GARIBAY GARCIA',
    '2023-2026'
  ),
  (
    '23316061210362',
    'GAGR071118HMNRLNA9',
    'RONALDO DE JESUS',
    'GRANADOS GALVEZ',
    '2023-2026'
  ),
  (
    '23316061210363',
    'GIGE080711HMNRLRA4',
    'ERNESTO',
    'GRIMALDO GALLEGOS',
    '2023-2026'
  ),
  (
    '23316061210364',
    'GISS080417MMNRNSA9',
    'SUSANA',
    'GRIMALDO SANCHEZ',
    '2023-2026'
  ),
  (
    '23316061210365',
    'GUTS070727HBCRRNA3',
    'SANTIAGO',
    'GUERRERO DEL TORO',
    '2023-2026'
  ),
  (
    '23316061210366',
    'HIPM080714MMNGDLA2',
    'MELISSA LORENA',
    'HIGAREDA PADILLA',
    '2023-2026'
  ),
  (
    '23316061210367',
    'JIMD081015HMNMTNA7',
    'DANIEL',
    'JIMENEZ MATA',
    '2023-2026'
  ),
  (
    '23316061210368',
    'MAPL070818HMNGRSA5',
    'LUIS ANGEL',
    'MAGDALENO PEREZ',
    '2023-2026'
  ),
  (
    '23316061210369',
    'MAMR081118HJCRNNA1',
    'REINIERI DE JESUS',
    'MARES MUNGUIA',
    '2023-2026'
  ),
  (
    '23316061210370',
    'MUOL080821HMNNCSA3',
    'LUIS MANUEL',
    'MUNGUIA OCHOA',
    '2023-2026'
  ),
  (
    '23316061210371',
    'MUAC070228MJCXLMA1',
    'CAMILA GUADALUPE',
    'MUÑIZ ALCARAZ',
    '2023-2026'
  ),
  (
    '23316061210372',
    'NARE080622HMNVDRA6',
    'ERICK',
    'NAVARRETE RODRIGUEZ',
    '2023-2026'
  ),
  (
    '23316061210373',
    'NAAJ080320HMNVRVA8',
    'JAVIER',
    'NAVARRO ARCEO',
    '2023-2026'
  ),
  (
    '23316061210374',
    'OOFA080505HMNCRNA2',
    'ANIBAL LEON',
    'OCHOA FARIAS',
    '2023-2026'
  ),
  (
    '23316061210375',
    'PIAK080816MMNXVMA8',
    'KIMBERLY GABRIELA',
    'PIÑA AVALOS',
    '2023-2026'
  ),
  (
    '23316061210376',
    'PIAM080715MMNXVRA0',
    'MIRANDA VALENTINA',
    'PIÑA AVALOS',
    '2023-2026'
  ),
  (
    '23316061210377',
    'RAOJ071130HMNMRNA8',
    'JUAN PABLO',
    'RAMIREZ ORTEGA',
    '2023-2026'
  ),
  (
    '23316061210378',
    'ROAF080602MMNDVTA7',
    'FATIMA JUDITH',
    'RODRIGUEZ AVALOS',
    '2023-2026'
  ),
  (
    '23316061210379',
    'SASA080910MMNNNLA3',
    'ALONDRA SVETLANA',
    'SANCHEZ SANCHEZ',
    '2023-2026'
  ),
  (
    '23316061210380',
    'VIOF080613MMNCRTA6',
    'FATIMA LUCIA',
    'VICTOR ORTIZ',
    '2023-2026'
  ),
  (
    '23316061210381',
    'ROGJ081024HNEJRSA3',
    'JESUS EMILIANO',
    'ROJAS GARCIA',
    '2023-2026'
  ),
  (
    '23316061210382',
    'CANC070918HMNBXRA1',
    'CRISTOPER WILLIAM',
    'CABEZAS NUÑEZ',
    '2023-2026'
  ),
  (
    '23316061210383',
    'CARA070921HMNRDLA4',
    'JOSE ALEJANDRO',
    'CARDENAS RODRIGUEZ',
    '2023-2026'
  ),
  (
    '23316061210384',
    'CEVC060806HMNRGHA1',
    'CHRISTOPHER JULIAN',
    'CERVANTES VEGA',
    '2023-2026'
  ),
  (
    '23316061210385',
    'CXGE070326MMNRDVA6',
    'EVELYN',
    'CORONA GUDIÑO',
    '2023-2026'
  ),
  (
    '23316061210386',
    'COPF071125HMNRRLA6',
    'FELISARDO MOISES',
    'CORONA PARTIDA',
    '2023-2026'
  ),
  (
    '23316061210387',
    'GADG070711MMNRZDA6',
    'MARIA GUADALUPE',
    'GARCIA DIAZ',
    '2023-2026'
  ),
  (
    '23316061210388',
    'GAPB031130MMNRNRA5',
    'BRENDA PAULINA',
    'GARCIA PANTOJA',
    '2023-2026'
  ),
  (
    '23316061210389',
    'GOGP070314MCMNLLA7',
    'PAOLA FERNANDA',
    'GONZALEZ GALLEGOS',
    '2023-2026'
  ),
  (
    '23316061210390',
    'GUSJ070804MMNDNLA3',
    'JULIANA',
    'GUDIÑO SANCHEZ',
    '2023-2026'
  ),
  (
    '23316061210391',
    'GUMJ071207HMNTNSA3',
    'JOSE DE JESUS',
    'GUTIERREZ MANZO',
    '2023-2026'
  ),
  (
    '23316061210392',
    'HECA070511MMNRJNA6',
    'ANGELES JACQUELINE',
    'HERRERA CEJA',
    '2023-2026'
  ),
  (
    '23316061210393',
    'HEGE070703HMNRMMA3',
    'EMANUEL',
    'HERRERA GOMEZ',
    '2023-2026'
  ),
  (
    '23316061210394',
    'MERM070416HJCJMRA1',
    'MARTIN ALEXANDER',
    'MEJIA RAMIREZ',
    '2023-2026'
  ),
  (
    '23316061210395',
    'OOMI070703HMNCNGA0',
    'IGNACIO SAMUEL',
    'OCHOA MENDOZA',
    '2023-2026'
  ),
  (
    '23316061210396',
    'PEGD070613HMNRTNA2',
    'DANIEL',
    'PEREZ GUTIERREZ',
    '2023-2026'
  ),
  (
    '23316061210397',
    'PIAD070121HMNXVNA5',
    'DANIEL ALEJANDRO',
    'PIÑA AVALOS',
    '2023-2026'
  ),
  (
    '23316061210398',
    'SISA070212HMNLNNA3',
    'ANGELO ISMAEL',
    'SILVA SANCHEZ',
    '2023-2026'
  ),
  (
    '23316061210399',
    'VACB070925HMNLHRA7',
    'BRYAN JOSUE',
    'VALENCIA CHAVEZ',
    '2023-2026'
  ),
  (
    '23316061210400',
    'VAFF071123MMNZRRA4',
    'FERNANDA ELIZABETH',
    'VAZQUEZ FRANCO',
    '2023-2026'
  ),
  (
    '23316061210401',
    'ZAGK060428MMNNLMA9',
    'KIMBERLY JOCELIN',
    'ZANABRIA GALVAN',
    '2023-2026'
  ),
  (
    '23316061210402',
    'SANB060817MMNNVRA1',
    'BRISA DANIELA',
    'SANCHEZ NAVARRETE',
    '2023-2026'
  ),
  (
    '23316061210403',
    'BAXJ061225HNERXSA2',
    'JESUS',
    'BARRAGAN',
    '2023-2026'
  ),
  (
    '23316061210404',
    'VASO080123HMNLNSA1',
    'OSVALDO',
    'VALDOVINOS SANCHEZ',
    '2023-2026'
  ),
  (
    '23316061210405',
    'VANV060822HMNZXCA2',
    'VICTOR SANTIAGO',
    'VAZQUEZ NUÑEZ',
    '2023-2026'
  ),
  (
    '23316061210406',
    'OOGJ080311HMNSTSA8',
    'JESUS ANTONIO',
    'OSORIO GUTIERREZ',
    '2023-2026'
  ),
  (
    '23316061210407',
    'VARJ060216HMNZDSA0',
    'JESUS EDUARDO',
    'VAZQUEZ RODRIGUEZ',
    '2023-2026'
  ),
  (
    '23316061210408',
    'GAMS080521MJCLNRA5',
    'SARAHI MONTSERRAT',
    'GALVAN MENDEZ',
    '2023-2026'
  ),
  (
    '23316061210409',
    'CAOL071211MMNNRSA3',
    'LESLIE YURITZIA',
    'CANELA ORDAZ',
    '2023-2026'
  ),
  (
    '23316061210410',
    'MOAM081205HTCRNXA4',
    'MAXIMILIANO',
    'MORALES ANTONIO',
    '2023-2026'
  ),
  (
    '23316061210411',
    'HEAS080820HTCRNLA6',
    'SAUL',
    'HERNANDEZ ANTONIO',
    '2023-2026'
  ),
  (
    '23316061210412',
    'MEOY050617HMNZRHA6',
    'YAHIR ADAN',
    'MEZA ORTIZ',
    '2023-2026'
  ),
  (
    '23316061210413',
    'AASN091008MEXVNCXX',
    'NICOLE',
    'AVALOS SANCHEZ',
    '2023-2026'
  ),
  (
    '23316061210414',
    'BEVK080305HJCLLRA6',
    'KAROL AARON',
    'BELLO VALERIO',
    '2023-2026'
  ),
  (
    '23316061210415',
    'AASS081104HMNVNNA9',
    'SANTIAGO ISAAC',
    'AVALOS SANDOVAL',
    '2023-2026'
  ),
  (
    '23316061210416',
    'GALP070809MMNLYLA0',
    'PAOLA GUADALUPE',
    'GALVEZ LEYVA',
    '2023-2026'
  ),
  (
    '23316061210417',
    'AASR080706HMNNGMA8',
    'RAMIRO ALEJANDRO',
    'ANAYA SEGURA',
    '2023-2026'
  ),
  (
    '23316061210418',
    'CAGK061120MMNBLRXX',
    'JOHANNA',
    'ALVARADO MANZO',
    '2023-2026'
  ),
  (
    '23316061210419',
    'PAGA080118HTCLLNA3',
    'ANGEL AMANSIO',
    'PALMA GALLEGOS',
    '2023-2026'
  ),
  (
    '23316061210420',
    'TOFA070706MMNRRLA0',
    'ALEXANDRA',
    'TORRES FARIAS',
    '2023-2026'
  ),
  (
    '23316061210421',
    'GOAE070217HMNNYMA2',
    'EMMANUEL',
    'GONZALEZ AYARD',
    '2023-2026'
  ),
  (
    '23316061210422',
    'GOBM050819MMNMRRA3',
    'MARLENE NEFERTARI',
    'GOMEZ BARRERA',
    '2023-2026'
  ),
  (
    '23316061210423',
    'OARL031112MMNRJCA7',
    'LUCERO MARGARITA',
    'ORDAZ ROJAS',
    '2023-2026'
  );

-- Insertar datos en la tabla de listas de grupos
INSERT INTO
  `group_list` (`list_id`, `group_id`, `control_number`)
VALUES
  (1, 11, '21316050120238'),
  (2, 11, '21316050120295'),
  (3, 11, '21316061210151'),
  (4, 11, '21316061210254'),
  (5, 11, '22316061210015'),
  (6, 11, '22316061210048'),
  (7, 11, '22316061210175'),
  (8, 11, '22316061210176'),
  (9, 11, '22316061210177'),
  (10, 11, '22316061210178'),
  (11, 11, '22316061210179'),
  (12, 11, '22316061210180'),
  (13, 11, '22316061210181'),
  (14, 11, '22316061210182'),
  (15, 11, '22316061210184'),
  (16, 11, '22316061210185'),
  (17, 11, '22316061210186'),
  (18, 11, '22316061210188'),
  (19, 11, '22316061210190'),
  (20, 11, '22316061210191'),
  (21, 11, '22316061210193'),
  (22, 11, '22316061210195'),
  (23, 11, '22316061210199'),
  (24, 11, '22316061210200'),
  (25, 11, '22316061210201'),
  (26, 11, '22316061210203'),
  (27, 11, '22316061210205'),
  (28, 11, '22316061210206'),
  (29, 11, '22316061210207'),
  (30, 11, '22316061210208'),
  (31, 11, '22316061210209'),
  (32, 11, '22316061210210'),
  (33, 11, '22316061210262'),
  (34, 11, '22316061210305'),
  (35, 11, '22316061210315'),
  (36, 11, '22316061210326'),
  (37, 11, '22316061210332'),
  (38, 11, '22316061210345'),
  (39, 11, '22316061210349'),
  (40, 19, '20316050120230'),
  (41, 19, '20316050120250'),
  (42, 19, '21316061210024'),
  (43, 19, '21316061210026'),
  (44, 19, '21316061210069'),
  (45, 19, '21316061210077'),
  (46, 19, '21316061210085'),
  (47, 19, '21316061210092'),
  (48, 19, '21316061210105'),
  (49, 19, '21316061210109'),
  (50, 19, '21316061210154'),
  (51, 19, '21316061210175'),
  (52, 19, '21316061210181'),
  (53, 19, '21316061210183'),
  (54, 19, '21316061210195'),
  (55, 19, '21316061210201'),
  (56, 19, '21316061210220'),
  (57, 19, '21316061210247'),
  (58, 19, '21316061210253'),
  (59, 19, '21316061210266'),
  (60, 19, '21316061210267'),
  (61, 19, '21316061210271'),
  (62, 12, '20316061210135'),
  (63, 12, '20316061210166'),
  (64, 12, '20316061210175'),
  (65, 12, '21316061210158'),
  (66, 12, '21316061210287'),
  (67, 12, '22316061210111'),
  (68, 12, '22316061210112'),
  (69, 12, '22316061210113'),
  (70, 12, '22316061210114'),
  (71, 12, '22316061210115'),
  (72, 12, '22316061210116'),
  (73, 12, '22316061210117'),
  (74, 12, '22316061210118'),
  (75, 12, '22316061210122'),
  (76, 12, '22316061210123'),
  (77, 12, '22316061210124'),
  (78, 12, '22316061210127'),
  (79, 12, '22316061210128'),
  (80, 12, '22316061210129'),
  (81, 12, '22316061210130'),
  (82, 12, '22316061210133'),
  (83, 12, '22316061210134'),
  (84, 12, '22316061210136'),
  (85, 12, '22316061210137'),
  (86, 12, '22316061210138'),
  (87, 12, '22316061210140'),
  (88, 12, '22316061210141'),
  (89, 12, '22316061210304'),
  (90, 12, '22316061210312'),
  (91, 12, '22316061210336'),
  (92, 20, '20316061210169'),
  (93, 20, '20316061210254'),
  (94, 20, '21316061210032'),
  (95, 20, '21316061210043'),
  (96, 20, '21316061210050'),
  (97, 20, '21316061210051'),
  (98, 20, '21316061210064'),
  (99, 20, '21316061210066'),
  (100, 20, '21316061210079'),
  (101, 20, '21316061210080'),
  (102, 20, '21316061210082'),
  (103, 20, '21316061210084'),
  (104, 20, '21316061210121'),
  (105, 20, '21316061210128'),
  (106, 20, '21316061210159'),
  (107, 20, '21316061210161'),
  (108, 20, '21316061210173'),
  (109, 20, '21316061210185'),
  (110, 20, '21316061210187'),
  (111, 20, '21316061210190'),
  (112, 20, '21316061210191'),
  (113, 20, '21316061210193'),
  (114, 20, '21316061210199'),
  (115, 20, '21316061210202'),
  (116, 20, '21316061210209'),
  (117, 20, '21316061210225'),
  (118, 20, '21316061210235'),
  (119, 20, '21316061210237'),
  (120, 20, '21316061210286'),
  (121, 13, '21316050120160'),
  (122, 13, '21316061210089'),
  (123, 13, '21316061210192'),
  (124, 13, '21316061210205'),
  (125, 13, '22316061210026'),
  (126, 13, '22316061210028'),
  (127, 13, '22316061210035'),
  (128, 13, '22316061210142'),
  (129, 13, '22316061210143'),
  (130, 13, '22316061210144'),
  (131, 13, '22316061210145'),
  (132, 13, '22316061210146'),
  (133, 13, '22316061210147'),
  (134, 13, '22316061210148'),
  (135, 13, '22316061210149'),
  (136, 13, '22316061210150'),
  (137, 13, '22316061210151'),
  (138, 13, '22316061210152'),
  (139, 13, '22316061210153'),
  (140, 13, '22316061210154'),
  (141, 13, '22316061210155'),
  (142, 13, '22316061210156'),
  (143, 13, '22316061210157'),
  (144, 13, '22316061210158'),
  (145, 13, '22316061210159'),
  (146, 13, '22316061210160'),
  (147, 13, '22316061210167'),
  (148, 13, '22316061210170'),
  (149, 13, '22316061210172'),
  (150, 13, '22316061210174'),
  (151, 13, '22316061210232'),
  (152, 13, '22316061210320'),
  (153, 21, '20316061210221'),
  (154, 21, '20316061210226'),
  (155, 21, '20316061210258'),
  (156, 21, '21316061210001'),
  (157, 21, '21316061210013'),
  (158, 21, '21316061210014'),
  (159, 21, '21316061210017'),
  (160, 21, '21316061210019'),
  (161, 21, '21316061210025'),
  (162, 21, '21316061210034'),
  (163, 21, '21316061210041'),
  (164, 21, '21316061210047'),
  (165, 21, '21316061210049'),
  (166, 21, '21316061210053'),
  (167, 21, '21316061210057'),
  (168, 21, '21316061210071'),
  (169, 21, '21316061210075'),
  (170, 21, '21316061210081'),
  (171, 21, '21316061210101'),
  (172, 21, '21316061210117'),
  (173, 21, '21316061210124'),
  (174, 21, '21316061210143'),
  (175, 21, '21316061210146'),
  (176, 21, '21316061210153'),
  (177, 21, '21316061210171'),
  (178, 21, '21316061210182'),
  (179, 21, '21316061210197'),
  (180, 21, '21316061210203'),
  (181, 21, '21316061210211'),
  (182, 21, '21316061210224'),
  (183, 21, '21316061210229'),
  (184, 16, '21316050120236'),
  (185, 16, '21316061210257'),
  (186, 16, '22316061210053'),
  (187, 16, '22316061210055'),
  (188, 16, '22316061210056'),
  (189, 16, '22316061210057'),
  (190, 16, '22316061210058'),
  (191, 16, '22316061210059'),
  (192, 16, '22316061210060'),
  (193, 16, '22316061210061'),
  (194, 16, '22316061210062'),
  (195, 16, '22316061210063'),
  (196, 16, '22316061210065'),
  (197, 16, '22316061210067'),
  (198, 16, '22316061210068'),
  (199, 16, '22316061210069'),
  (200, 16, '22316061210072'),
  (201, 16, '22316061210319'),
  (202, 16, '22316061210323'),
  (203, 16, '22316061210324'),
  (204, 16, '22316061210338'),
  (205, 16, '22316061210341'),
  (206, 16, '22316061210343'),
  (207, 24, '20316061210282'),
  (208, 24, '21316061210010'),
  (209, 24, '21316061210033'),
  (210, 24, '21316061210045'),
  (211, 24, '21316061210048'),
  (212, 24, '21316061210055'),
  (213, 24, '21316061210060'),
  (214, 24, '21316061210061'),
  (215, 24, '21316061210062'),
  (216, 24, '21316061210076'),
  (217, 24, '21316061210098'),
  (218, 24, '21316061210108'),
  (219, 24, '21316061210111'),
  (220, 24, '21316061210116'),
  (221, 24, '21316061210133'),
  (222, 24, '21316061210184'),
  (223, 24, '21316061210208'),
  (224, 14, '21316061210160'),
  (225, 14, '22316050120109'),
  (226, 14, '22316050120336'),
  (227, 14, '22316061210084'),
  (228, 14, '22316061210085'),
  (229, 14, '22316061210087'),
  (230, 14, '22316061210088'),
  (231, 14, '22316061210089'),
  (232, 14, '22316061210092'),
  (233, 14, '22316061210095'),
  (234, 14, '22316061210096'),
  (235, 14, '22316061210098'),
  (236, 14, '22316061210099'),
  (237, 14, '22316061210101'),
  (238, 14, '22316061210102'),
  (239, 14, '22316061210104'),
  (240, 14, '22316061210212'),
  (241, 14, '22316061210213'),
  (242, 14, '22316061210214'),
  (243, 14, '22316061210215'),
  (244, 14, '22316061210216'),
  (245, 14, '22316061210217'),
  (246, 14, '22316061210218'),
  (247, 14, '22316061210220'),
  (248, 14, '22316061210222'),
  (249, 14, '22316061210227'),
  (250, 14, '22316061210228'),
  (251, 14, '22316061210229'),
  (252, 14, '22316061210230'),
  (253, 14, '22316061210231'),
  (254, 14, '22316061210234'),
  (255, 14, '22316061210235'),
  (256, 14, '22316061210236'),
  (257, 14, '22316061210314'),
  (258, 14, '22316061210317'),
  (259, 14, '22316061210330'),
  (260, 14, '22316061210337'),
  (261, 22, '19316061210416'),
  (262, 22, '20316061210146'),
  (263, 22, '20316061210157'),
  (264, 22, '20316061210222'),
  (265, 22, '20316061210267'),
  (266, 22, '20316061210272'),
  (267, 22, '21316061210005'),
  (268, 22, '21316061210046'),
  (269, 22, '21316061210065'),
  (270, 22, '21316061210074'),
  (271, 22, '21316061210078'),
  (272, 22, '21316061210095'),
  (273, 22, '21316061210113'),
  (274, 22, '21316061210115'),
  (275, 22, '21316061210119'),
  (276, 22, '21316061210138'),
  (277, 22, '21316061210142'),
  (278, 22, '21316061210147'),
  (279, 22, '21316061210164'),
  (280, 22, '21316061210169'),
  (281, 22, '21316061210176'),
  (282, 22, '21316061210196'),
  (283, 22, '21316061210198'),
  (284, 22, '21316061210206'),
  (285, 22, '21316061210213'),
  (286, 22, '21316061210217'),
  (287, 22, '21316061210223'),
  (288, 22, '21316061210231'),
  (289, 22, '21316061210281'),
  (290, 22, '21316061210291'),
  (291, 22, '21316061210292'),
  (292, 15, '20316050120338'),
  (293, 15, '20316061210079'),
  (294, 15, '21316061210136'),
  (295, 15, '21316061210145'),
  (296, 15, '21316061210163'),
  (297, 15, '21316061210216'),
  (298, 15, '21316061210282'),
  (299, 15, '22316061210001'),
  (300, 15, '22316061210002'),
  (301, 15, '22316061210003'),
  (302, 15, '22316061210004'),
  (303, 15, '22316061210006'),
  (304, 15, '22316061210010'),
  (305, 15, '22316061210011'),
  (306, 15, '22316061210013'),
  (307, 15, '22316061210018'),
  (308, 15, '22316061210019'),
  (309, 15, '22316061210022'),
  (310, 15, '22316061210024'),
  (311, 15, '22316061210025'),
  (312, 15, '22316061210029'),
  (313, 15, '22316061210030'),
  (314, 15, '22316061210033'),
  (315, 15, '22316061210034'),
  (316, 15, '22316061210036'),
  (317, 15, '22316061210040'),
  (318, 15, '22316061210042'),
  (319, 15, '22316061210044'),
  (320, 15, '22316061210045'),
  (321, 15, '22316061210050'),
  (322, 15, '22316061210051'),
  (323, 15, '22316061210064'),
  (324, 15, '22316061210070'),
  (325, 15, '22316061210103'),
  (326, 15, '22316061210224'),
  (327, 15, '22316061210318'),
  (328, 15, '22316061210328'),
  (329, 15, '22316061210347'),
  (330, 15, '22316061210348'),
  (331, 23, '20316061210052'),
  (332, 23, '20316061210113'),
  (333, 23, '20316061210172'),
  (334, 23, '21316061210004'),
  (335, 23, '21316061210009'),
  (336, 23, '21316061210011'),
  (337, 23, '21316061210016'),
  (338, 23, '21316061210028'),
  (339, 23, '21316061210035'),
  (340, 23, '21316061210037'),
  (341, 23, '21316061210042'),
  (342, 23, '21316061210052'),
  (343, 23, '21316061210058'),
  (344, 23, '21316061210086'),
  (345, 23, '21316061210087'),
  (346, 23, '21316061210091'),
  (347, 23, '21316061210093'),
  (348, 23, '21316061210094'),
  (349, 23, '21316061210107'),
  (350, 23, '21316061210131'),
  (351, 23, '21316061210132'),
  (352, 23, '21316061210139'),
  (353, 23, '21316061210166'),
  (354, 23, '21316061210170'),
  (355, 23, '21316061210172'),
  (356, 23, '21316061210174'),
  (357, 23, '21316061210179'),
  (358, 23, '21316061210189'),
  (359, 23, '21316061210207'),
  (360, 23, '21316061210212'),
  (361, 23, '21316061210218'),
  (362, 23, '21316061210226'),
  (363, 23, '21316061210238'),
  (364, 23, '21316061210279'),
  (365, 23, '21316061210290'),
  (366, 23, '21316061210298'),
  (367, 17, '20316061210229'),
  (368, 17, '22316061210090'),
  (369, 17, '22316061210139'),
  (370, 17, '22316061210237'),
  (371, 17, '22316061210238'),
  (372, 17, '22316061210239'),
  (373, 17, '22316061210240'),
  (374, 17, '22316061210241'),
  (375, 17, '22316061210242'),
  (376, 17, '22316061210243'),
  (377, 17, '22316061210249'),
  (378, 17, '22316061210252'),
  (379, 17, '22316061210254'),
  (380, 17, '22316061210255'),
  (381, 17, '22316061210256'),
  (382, 17, '22316061210257'),
  (383, 17, '22316061210259'),
  (384, 17, '22316061210263'),
  (385, 17, '22316061210265'),
  (386, 17, '22316061210266'),
  (387, 17, '22316061210267'),
  (388, 17, '22316061210268'),
  (389, 17, '22316061210299'),
  (390, 17, '22316061210306'),
  (391, 17, '22316061210342'),
  (392, 17, '22316061210344'),
  (393, 18, '20316061210173'),
  (394, 18, '21316061210123'),
  (395, 18, '22316061210086'),
  (396, 18, '22316061210109'),
  (397, 18, '22316061210219'),
  (398, 18, '22316061210225'),
  (399, 18, '22316061210226'),
  (400, 18, '22316061210269'),
  (401, 18, '22316061210270'),
  (402, 18, '22316061210271'),
  (403, 18, '22316061210272'),
  (404, 18, '22316061210273'),
  (405, 18, '22316061210275'),
  (406, 18, '22316061210276'),
  (407, 18, '22316061210277'),
  (408, 18, '22316061210278'),
  (409, 18, '22316061210279'),
  (410, 18, '22316061210280'),
  (411, 18, '22316061210281'),
  (412, 18, '22316061210282'),
  (413, 18, '22316061210284'),
  (414, 18, '22316061210285'),
  (415, 18, '22316061210286'),
  (416, 18, '22316061210288'),
  (417, 18, '22316061210289'),
  (418, 18, '22316061210290'),
  (419, 18, '22316061210294'),
  (420, 18, '22316061210295'),
  (421, 18, '22316061210296'),
  (422, 18, '22316061210297'),
  (423, 18, '22316061210298'),
  (424, 18, '22316061210300'),
  (425, 18, '22316061210301'),
  (426, 18, '22316061210302'),
  (427, 18, '22316061210303'),
  (428, 18, '22316061210310'),
  (429, 25, '19316061210278'),
  (430, 25, '19316061210297'),
  (431, 25, '20316061210095'),
  (432, 25, '20316061210266'),
  (433, 25, '21316061210002'),
  (434, 25, '21316061210007'),
  (435, 25, '21316061210012'),
  (436, 25, '21316061210015'),
  (437, 25, '21316061210020'),
  (438, 25, '21316061210021'),
  (439, 25, '21316061210036'),
  (440, 25, '21316061210038'),
  (441, 25, '21316061210039'),
  (442, 25, '21316061210044'),
  (443, 25, '21316061210072'),
  (444, 25, '21316061210088'),
  (445, 25, '21316061210097'),
  (446, 25, '21316061210102'),
  (447, 25, '21316061210103'),
  (448, 25, '21316061210104'),
  (449, 25, '21316061210120'),
  (450, 25, '21316061210125'),
  (451, 25, '21316061210126'),
  (452, 25, '21316061210134'),
  (453, 25, '21316061210135'),
  (454, 25, '21316061210137'),
  (455, 25, '21316061210141'),
  (456, 25, '21316061210144'),
  (457, 25, '21316061210148'),
  (458, 25, '21316061210149'),
  (459, 25, '21316061210155'),
  (460, 25, '21316061210168'),
  (461, 25, '21316061210188'),
  (462, 25, '21316061210242'),
  (463, 25, '21316061210244'),
  (464, 25, '21316061210252'),
  (465, 25, '21316061210255'),
  (466, 25, '21316061210259'),
  (467, 25, '21316061210268'),
  (468, 25, '21316061210297'),
  (469, 1, '23316061210001'),
  (470, 1, '23316061210002'),
  (471, 1, '23316061210003'),
  (472, 1, '23316061210004'),
  (473, 1, '23316061210005'),
  (474, 1, '23316061210006'),
  (475, 1, '23316061210007'),
  (476, 1, '23316061210008'),
  (477, 1, '23316061210009'),
  (478, 1, '23316061210010'),
  (479, 1, '23316061210011'),
  (480, 1, '23316061210012'),
  (481, 1, '23316061210013'),
  (482, 1, '23316061210014'),
  (483, 1, '23316061210015'),
  (484, 1, '23316061210016'),
  (485, 1, '23316061210017'),
  (486, 1, '23316061210018'),
  (487, 1, '23316061210019'),
  (488, 1, '23316061210020'),
  (489, 1, '23316061210021'),
  (490, 1, '23316061210022'),
  (491, 1, '23316061210023'),
  (492, 1, '23316061210024'),
  (493, 1, '23316061210025'),
  (494, 1, '23316061210026'),
  (495, 1, '23316061210027'),
  (496, 1, '23316061210028'),
  (497, 1, '23316061210029'),
  (498, 1, '23316061210030'),
  (499, 1, '23316061210031'),
  (500, 1, '23316061210032'),
  (501, 1, '23316061210033'),
  (502, 1, '23316061210034'),
  (503, 1, '23316061210035'),
  (504, 1, '23316061210050'),
  (505, 1, '23316061210051'),
  (506, 1, '23316061210052'),
  (507, 1, '23316061210066'),
  (508, 1, '23316061210382'),
  (509, 1, '23316061210390'),
  (510, 1, '23316061210392'),
  (511, 1, '23316061210396'),
  (512, 1, '23316061210402'),
  (513, 1, '23316061210422'),
  (514, 2, '23316061210036'),
  (515, 2, '23316061210037'),
  (516, 2, '23316061210038'),
  (517, 2, '23316061210039'),
  (518, 2, '23316061210040'),
  (519, 2, '23316061210041'),
  (520, 2, '23316061210042'),
  (521, 2, '23316061210043'),
  (522, 2, '23316061210044'),
  (523, 2, '23316061210045'),
  (524, 2, '23316061210046'),
  (525, 2, '23316061210047'),
  (526, 2, '23316061210048'),
  (527, 2, '23316061210049'),
  (528, 2, '23316061210053'),
  (529, 2, '23316061210054'),
  (530, 2, '23316061210055'),
  (531, 2, '23316061210056'),
  (532, 2, '23316061210057'),
  (533, 2, '23316061210058'),
  (534, 2, '23316061210059'),
  (535, 2, '23316061210060'),
  (536, 2, '23316061210061'),
  (537, 2, '23316061210062'),
  (538, 2, '23316061210063'),
  (539, 2, '23316061210064'),
  (540, 2, '23316061210065'),
  (541, 2, '23316061210067'),
  (542, 2, '23316061210068'),
  (543, 2, '23316061210070'),
  (544, 2, '23316061210071'),
  (545, 2, '23316061210072'),
  (546, 2, '23316061210073'),
  (547, 2, '23316061210074'),
  (548, 2, '23316061210075'),
  (549, 2, '23316061210076'),
  (550, 2, '23316061210077'),
  (551, 2, '23316061210078'),
  (552, 2, '23316061210397'),
  (553, 2, '23316061210399'),
  (554, 2, '23316061210403'),
  (555, 3, '23316061210079'),
  (556, 3, '23316061210080'),
  (557, 3, '23316061210081'),
  (558, 3, '23316061210082'),
  (559, 3, '23316061210083'),
  (560, 3, '23316061210084'),
  (561, 3, '23316061210085'),
  (562, 3, '23316061210086'),
  (563, 3, '23316061210087'),
  (564, 3, '23316061210088'),
  (565, 3, '23316061210089'),
  (566, 3, '23316061210090'),
  (567, 3, '23316061210091'),
  (568, 3, '23316061210092'),
  (569, 3, '23316061210093'),
  (570, 3, '23316061210094'),
  (571, 3, '23316061210095'),
  (572, 3, '23316061210096'),
  (573, 3, '23316061210097'),
  (574, 3, '23316061210098'),
  (575, 3, '23316061210099'),
  (576, 3, '23316061210100'),
  (577, 3, '23316061210101'),
  (578, 3, '23316061210102'),
  (579, 3, '23316061210103'),
  (580, 3, '23316061210104'),
  (581, 3, '23316061210105'),
  (582, 3, '23316061210106'),
  (583, 3, '23316061210107'),
  (584, 3, '23316061210108'),
  (585, 3, '23316061210109'),
  (586, 3, '23316061210110'),
  (587, 3, '23316061210111'),
  (588, 3, '23316061210112'),
  (589, 3, '23316061210113'),
  (590, 3, '23316061210114'),
  (591, 3, '23316061210115'),
  (592, 3, '23316061210116'),
  (593, 3, '23316061210117'),
  (594, 3, '23316061210385'),
  (595, 3, '23316061210386'),
  (596, 3, '23316061210387'),
  (597, 3, '23316061210389'),
  (598, 3, '23316061210404'),
  (599, 3, '23316061210407'),
  (600, 3, '23316061210421'),
  (601, 4, '23316061210118'),
  (602, 4, '23316061210119'),
  (603, 4, '23316061210120'),
  (604, 4, '23316061210121'),
  (605, 4, '23316061210122'),
  (606, 4, '23316061210123'),
  (607, 4, '23316061210124'),
  (608, 4, '23316061210125'),
  (609, 4, '23316061210126'),
  (610, 4, '23316061210127'),
  (611, 4, '23316061210128'),
  (612, 4, '23316061210129'),
  (613, 4, '23316061210130'),
  (614, 4, '23316061210131'),
  (615, 4, '23316061210132'),
  (616, 4, '23316061210133'),
  (617, 4, '23316061210134'),
  (618, 4, '23316061210135'),
  (619, 4, '23316061210136'),
  (620, 4, '23316061210137'),
  (621, 4, '23316061210138'),
  (622, 4, '23316061210139'),
  (623, 4, '23316061210140'),
  (624, 4, '23316061210141'),
  (625, 4, '23316061210142'),
  (626, 4, '23316061210143'),
  (627, 4, '23316061210144'),
  (628, 4, '23316061210145'),
  (629, 4, '23316061210146'),
  (630, 4, '23316061210147'),
  (631, 4, '23316061210148'),
  (632, 4, '23316061210149'),
  (633, 4, '23316061210150'),
  (634, 4, '23316061210151'),
  (635, 4, '23316061210152'),
  (636, 4, '23316061210153'),
  (637, 4, '23316061210154'),
  (638, 4, '23316061210155'),
  (639, 4, '23316061210156'),
  (640, 4, '23316061210408'),
  (641, 4, '23316061210420'),
  (642, 5, '23316061210157'),
  (643, 5, '23316061210158'),
  (644, 5, '23316061210159'),
  (645, 5, '23316061210160'),
  (646, 5, '23316061210161'),
  (647, 5, '23316061210162'),
  (648, 5, '23316061210163'),
  (649, 5, '23316061210164'),
  (650, 5, '23316061210165'),
  (651, 5, '23316061210166'),
  (652, 5, '23316061210167'),
  (653, 5, '23316061210168'),
  (654, 5, '23316061210169'),
  (655, 5, '23316061210170'),
  (656, 5, '23316061210171'),
  (657, 5, '23316061210172'),
  (658, 5, '23316061210173'),
  (659, 5, '23316061210174'),
  (660, 5, '23316061210175'),
  (661, 5, '23316061210176'),
  (662, 5, '23316061210177'),
  (663, 5, '23316061210178'),
  (664, 5, '23316061210179'),
  (665, 5, '23316061210180'),
  (666, 5, '23316061210181'),
  (667, 5, '23316061210182'),
  (668, 5, '23316061210183'),
  (669, 5, '23316061210184'),
  (670, 5, '23316061210185'),
  (671, 5, '23316061210186'),
  (672, 5, '23316061210187'),
  (673, 5, '23316061210188'),
  (674, 5, '23316061210189'),
  (675, 5, '23316061210190'),
  (676, 5, '23316061210191'),
  (677, 5, '23316061210192'),
  (678, 5, '23316061210193'),
  (679, 5, '23316061210391'),
  (680, 5, '23316061210393'),
  (681, 5, '23316061210400'),
  (682, 5, '23316061210415'),
  (683, 6, '23316061210234'),
  (684, 6, '23316061210235'),
  (685, 6, '23316061210236'),
  (686, 6, '23316061210237'),
  (687, 6, '23316061210238'),
  (688, 6, '23316061210239'),
  (689, 6, '23316061210240'),
  (690, 6, '23316061210241'),
  (691, 6, '23316061210242'),
  (692, 6, '23316061210243'),
  (693, 6, '23316061210244'),
  (694, 6, '23316061210245'),
  (695, 6, '23316061210246'),
  (696, 6, '23316061210247'),
  (697, 6, '23316061210249'),
  (698, 6, '23316061210250'),
  (699, 6, '23316061210251'),
  (700, 6, '23316061210252'),
  (701, 6, '23316061210253'),
  (702, 6, '23316061210254'),
  (703, 6, '23316061210255'),
  (704, 6, '23316061210256'),
  (705, 6, '23316061210257'),
  (706, 6, '23316061210258'),
  (707, 6, '23316061210259'),
  (708, 6, '23316061210260'),
  (709, 6, '23316061210261'),
  (710, 6, '23316061210262'),
  (711, 6, '23316061210263'),
  (712, 6, '23316061210264'),
  (713, 6, '23316061210265'),
  (714, 6, '23316061210266'),
  (715, 6, '23316061210267'),
  (716, 6, '23316061210268'),
  (717, 6, '23316061210269'),
  (718, 6, '23316061210270'),
  (719, 6, '23316061210292'),
  (720, 6, '23316061210299'),
  (721, 6, '23316061210300'),
  (722, 6, '23316061210381'),
  (723, 6, '23316061210394'),
  (724, 6, '23316061210401'),
  (725, 6, '23316061210416'),
  (726, 7, '23316061210194'),
  (727, 7, '23316061210195'),
  (728, 7, '23316061210196'),
  (729, 7, '23316061210197'),
  (730, 7, '23316061210198'),
  (731, 7, '23316061210199'),
  (732, 7, '23316061210200'),
  (733, 7, '23316061210201'),
  (734, 7, '23316061210202'),
  (735, 7, '23316061210203'),
  (736, 7, '23316061210204'),
  (737, 7, '23316061210205'),
  (738, 7, '23316061210206'),
  (739, 7, '23316061210207'),
  (740, 7, '23316061210208'),
  (741, 7, '23316061210209'),
  (742, 7, '23316061210210'),
  (743, 7, '23316061210211'),
  (744, 7, '23316061210212'),
  (745, 7, '23316061210213'),
  (746, 7, '23316061210214'),
  (747, 7, '23316061210215'),
  (748, 7, '23316061210216'),
  (749, 7, '23316061210217'),
  (750, 7, '23316061210218'),
  (751, 7, '23316061210219'),
  (752, 7, '23316061210220'),
  (753, 7, '23316061210221'),
  (754, 7, '23316061210222'),
  (755, 7, '23316061210223'),
  (756, 7, '23316061210224'),
  (757, 7, '23316061210225'),
  (758, 7, '23316061210226'),
  (759, 7, '23316061210227'),
  (760, 7, '23316061210228'),
  (761, 7, '23316061210229'),
  (762, 7, '23316061210230'),
  (763, 7, '23316061210231'),
  (764, 7, '23316061210232'),
  (765, 7, '23316061210233'),
  (766, 7, '23316061210248'),
  (767, 7, '23316061210383'),
  (768, 7, '23316061210384'),
  (769, 8, '23316061210271'),
  (770, 8, '23316061210272'),
  (771, 8, '23316061210273'),
  (772, 8, '23316061210274'),
  (773, 8, '23316061210275'),
  (774, 8, '23316061210276'),
  (775, 8, '23316061210277'),
  (776, 8, '23316061210278'),
  (777, 8, '23316061210279'),
  (778, 8, '23316061210280'),
  (779, 8, '23316061210281'),
  (780, 8, '23316061210282'),
  (781, 8, '23316061210283'),
  (782, 8, '23316061210284'),
  (783, 8, '23316061210285'),
  (784, 8, '23316061210286'),
  (785, 8, '23316061210287'),
  (786, 8, '23316061210289'),
  (787, 8, '23316061210290'),
  (788, 8, '23316061210291'),
  (789, 8, '23316061210293'),
  (790, 8, '23316061210294'),
  (791, 8, '23316061210295'),
  (792, 8, '23316061210296'),
  (793, 8, '23316061210297'),
  (794, 8, '23316061210298'),
  (795, 8, '23316061210301'),
  (796, 8, '23316061210302'),
  (797, 8, '23316061210303'),
  (798, 8, '23316061210304'),
  (799, 8, '23316061210305'),
  (800, 8, '23316061210377'),
  (801, 8, '23316061210405'),
  (802, 8, '23316061210409'),
  (803, 8, '23316061210410'),
  (804, 8, '23316061210411'),
  (805, 8, '23316061210412'),
  (806, 8, '23316061210418'),
  (807, 8, '23316061210419'),
  (808, 9, '23316061210306'),
  (809, 9, '23316061210307'),
  (810, 9, '23316061210308'),
  (811, 9, '23316061210309'),
  (812, 9, '23316061210310'),
  (813, 9, '23316061210311'),
  (814, 9, '23316061210312'),
  (815, 9, '23316061210313'),
  (816, 9, '23316061210314'),
  (817, 9, '23316061210315'),
  (818, 9, '23316061210316'),
  (819, 9, '23316061210317'),
  (820, 9, '23316061210318'),
  (821, 9, '23316061210319'),
  (822, 9, '23316061210320'),
  (823, 9, '23316061210321'),
  (824, 9, '23316061210322'),
  (825, 9, '23316061210323'),
  (826, 9, '23316061210324'),
  (827, 9, '23316061210325'),
  (828, 9, '23316061210326'),
  (829, 9, '23316061210327'),
  (830, 9, '23316061210328'),
  (831, 9, '23316061210329'),
  (832, 9, '23316061210330'),
  (833, 9, '23316061210331'),
  (834, 9, '23316061210332'),
  (835, 9, '23316061210333'),
  (836, 9, '23316061210334'),
  (837, 9, '23316061210335'),
  (838, 9, '23316061210336'),
  (839, 9, '23316061210337'),
  (840, 9, '23316061210338'),
  (841, 9, '23316061210339'),
  (842, 9, '23316061210340'),
  (843, 9, '23316061210341'),
  (844, 9, '23316061210395'),
  (845, 9, '23316061210398'),
  (846, 9, '23316061210406'),
  (847, 9, '23316061210413'),
  (848, 10, '23316061210069'),
  (849, 10, '23316061210288'),
  (850, 10, '23316061210342'),
  (851, 10, '23316061210343'),
  (852, 10, '23316061210344'),
  (853, 10, '23316061210345'),
  (854, 10, '23316061210346'),
  (855, 10, '23316061210347'),
  (856, 10, '23316061210348'),
  (857, 10, '23316061210349'),
  (858, 10, '23316061210350'),
  (859, 10, '23316061210351'),
  (860, 10, '23316061210352'),
  (861, 10, '23316061210353'),
  (862, 10, '23316061210354'),
  (863, 10, '23316061210355'),
  (864, 10, '23316061210356'),
  (865, 10, '23316061210357'),
  (866, 10, '23316061210358'),
  (867, 10, '23316061210359'),
  (868, 10, '23316061210360'),
  (869, 10, '23316061210361'),
  (870, 10, '23316061210362'),
  (871, 10, '23316061210363'),
  (872, 10, '23316061210364'),
  (873, 10, '23316061210365'),
  (874, 10, '23316061210366'),
  (875, 10, '23316061210367'),
  (876, 10, '23316061210368'),
  (877, 10, '23316061210369'),
  (878, 10, '23316061210370'),
  (879, 10, '23316061210371'),
  (880, 10, '23316061210372'),
  (881, 10, '23316061210373'),
  (882, 10, '23316061210374'),
  (883, 10, '23316061210375'),
  (884, 10, '23316061210376'),
  (885, 10, '23316061210378'),
  (886, 10, '23316061210379'),
  (887, 10, '23316061210380'),
  (888, 10, '23316061210388'),
  (889, 10, '23316061210414'),
  (890, 10, '23316061210417'),
  (891, 10, '23316061210423');