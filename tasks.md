# Tareas restantes - Asisweb

Asisweb, es un proyecto web para la agilización del manejo de horarios de docentes y asistencias de los alumnos. Este proyecto fue creado con el fin de ser utilizado como servicio social y practicas profesionales para los alumnos [Jorge Armando Ceras Cárdenas](https://github.com/armandodev) y [Delaimy Itzel Diaz Zamora](https://github.com/Delaimy) de la institución [CETis 121](https://www.cetis121.edu.mx/).

## Setup

- [] Asegurate de tener instalado [Node.js](https://nodejs.org/es/).
- [] Abre la terminal de tu sistema operativo y dirígete a la carpeta del proyecto.
- [] Asegurate de tener la ultima versión del proyecto clonada con `git pull`.
- [] Ejecuta `npm install` para instalar las dependencias del proyecto.
- [] Ejecuta `code .` para abrir el proyecto en Visual Studio Code.
- [] Ejecuta `npx tailwindcss -i ./css/input.css -o ./css/output.css --watch` para compilar los estilos de tailwindcss.
- [] Inicia los servidores de desarrollo con xampp.
- [] Importa la base de datos [database.sql](./api/db/database.sql) en phpmyadmin.
- [] Asegurate de tener la configuración de la base de datos en [config.php](./api/db/utils.php) correcta.
- [] Inicia sesión en la aplicación con el usuario de algún profesor con acceso a la administración. Por ejemplo Gabriel, con el email `gabrielarturo@gmail.com` y la contraseña `1234567890`. Claramente es temporal solo para pruebas.

## Tareas

- [✅] Agregar la opción de editar el nombre del usuario desde la página [editar perfil](./edit-profile.php). (Delaimy)
- [] Agregar la opción de manejo de horarios para completar los datos de prueba restantes dentro del panel de administración. (CRUD) (Armando)
- [] Agregar los datos de prueba restantes en la base de datos con los horarios dados en la pagina de Facebook del [CETis 121](https://www.facebook.com/media/set/?set=a.671046351718037&type=3). (Armando)
- [] Mostrar en la pagina de schedule los horarios de los profesores de manera dinámica con los datos de la base de datos. (Armando)
- [] Agregar la opción de paginación en los datos de la tabla de horarios en el panel de administración. Esto quiere decir que si hay mas de 10 registros, se deben mostrar 10 y los demás en otra pagina. (Delaimy)
- [] Agregar la misma paginación en todas las tablas de la aplicación en las que se muestren registros. (Delaimy)
- [] Exportar la nueva base de datos con los datos de prueba completos. (Armando)
- [] Iniciar la idea de la toma de asistencias en la aplicación. (Delaimy y Armando)
- [] Dar inicio al desarrollo de la toma de asistencias en la aplicación. (Delaimy y Armando)
- [] Idear la forma de cambiar de periodo en la aplicación. (Delaimy, Armando y supervisores (Gabriel y Girarte))

## Notas

### Requisitos para la toma de asistencias en la aplicación

- [] Tener la opción de agregar una justificación a la falta lo que significa que el profesor tendra que ver sus registros y agregar una justificación a la falta.
- [] Tener la opción de agregar un retardo.
- [] Al enviar la asistencia, se debe almacenar en la base de datos el registro de la asistencia al que se le pueden agregar las justificaciones y retardos si son necesarios. Esto lo podran hacer los profesores o los mismos administradores.
- [] Tener la opción de ver los registros de asistencias de los alumnos en la aplicación.
- [] Agregar la opción de marcar el fin de un parcial, para que los profesores no puedan modificar las asistencias pasadas, además mandara advertencias a los administradores y profesores de sus alumnos que no cuentan con el minimo de asistencias requeridas (80%) para pasar la materia.
- [] Al fin de un parcial, se debe generar un reporte de asistencias para los profesores y administradores.
