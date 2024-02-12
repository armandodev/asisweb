# asisweb

## Descripción

Asisweb, es un proyecto web para la agilización del manejo de horarios de docentes y asistencias de los alumnos para la institución educativa "Centro de Estudios Tecnológicos Industrial y de Servicios No. 121".

## Funcionalidades

- Registro de docentes. Los docentes podrán solicitar su registro en el sistema, para que el administrador pueda aceptar o rechazar su solicitud, una vez aceptada, el docente podrá iniciar sesión en el sistema y empezar a gestionar sus asignaturas y horarios en cuanto sean asignadas por el administrador.

- Registro de alumnos. Los alumnos serán registrados por el administrador mediante una inserción masiva de datos con un archivo de Excel, una vez registrados, los alumnos serán asignados a un grado, grupo y especialidad, para que los docentes puedan tomar asistencia de ellos en sus respectivas asignaturas.

- Registro de asignaturas. Las asignaturas serán registradas por el administrador, asignando un docente a cada una de ellas, para que el docente pueda gestionar su horario y asistencias de los alumnos.

- Registro de horarios. Los horarios serán registrados por el administrador, asignando un docente y una asignatura a cada uno de ellos, para que el docente pueda gestionar su horario y asistencias de los alumnos. Este sistema permite realizar los horarios de una manera mas ágil y sencilla y apoyara a evitar el solapamiento de horarios.

- Registro de asistencias. Los docentes podrán tomar asistencia de los alumnos en sus respectivas asignaturas.

- Reportes. El sistema generará reportes de asistencias de los alumnos, para que el administrador pueda visualizar el comportamiento de los alumnos en sus respectivas asignaturas.

- Reprobación de alumnos. El sistema generará un reporte de alumnos que reprobaron una asignatura debido a falta de asistencias, para que el administrador pueda tomar las medidas necesarias.

- Edición de datos. El sistema permitirá a los docentes editar sus datos personales, asignaturas y horarios, para que puedan gestionar su información de manera ágil.

- Eliminación de datos. El sistema permitirá a los docentes eliminar sus correos electrónicos y números de teléfono adicionales.

- Manejo completo de usuarios. El sistema permitirá al administrador gestionar los usuarios del sistema, ya sean docentes o alumnos, para que pueda mantener actualizada la información de los usuarios.

- Notificaciones. El sistema enviará notificaciones a los docentes para que recuerden tomar asistencia de los alumnos en sus respectivas asignaturas en el horario establecido.

## Tecnologías

- Frontend: HTML, CSS, JavaScript, TailwindCSS.
- Backend: PHP, MySQL.

## Despliegue

- Clonar el repositorio/Descargar el código fuente.
- Importa el archivo `database.sql` al PHPMyAdmin de CPanel.
- Configurar el archivo en `config/Database.php` con los datos de conexión a la base de datos.
- Subir el código fuente al servidor exceptuando el archivo `database.sql` y el archivo `README.md`.
- Acceder al sistema mediante el navegador web.
- Solicitar el registro del usuario que será el administrador del sistema, mediante el formulario de registro.
- Una vez registrado, acceder a la base de datos en PHPMyAdmin y cambiar el campo `admin` del usuario registrado a `1` y el campo `active` a `1`.
- Acceder al sistema con el usuario registrado y empezar a gestionar el sistema.

## Información adicional

- El sistema ha sido desarrollado por [Jorge Armando Ceras Cárdenas](https://armandodev.portfolio.netlify.app/). Si necesitas soporte técnico, puedes contactarme a través de mi [correo electrónico](mailto:jorge.armando.c.cardenas@gmail.com) o por mi número de teléfono, ya sea por llamada o por WhatsApp. +52 33 2829 8224.

## Licencia

- El sistema fue desarrollado con el fin de cumplir con el servicio social del alumno Jorge Armando Ceras Cárdenas (Número de control: 21316061210279), quien concede el uso de este sistema a la institución educativa "Centro de Estudios Tecnológicos Industrial y de Servicios No. 121" para su uso exclusivo. El sistema no puede ser vendido, modificado o distribuido sin el consentimiento del autor.
