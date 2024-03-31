<?php
// Llamamos a la clase Database y creamos una instancia de la misma
require_once __DIR__ . '/Database.php';
$db = new Database();

// Obtenemos los parámetros de la base de datos
$query = "SELECT * FROM params LIMIT 1";
$result = $db->executeQuery($query);
$params = $result->fetch(PDO::FETCH_ASSOC);

// De haber resultados, definimos las constantes con los valores obtenidos
if ($result->rowCount() > 0) {
  define('ADDRESS', $params['address']);
  define('CCT', $params['cct']);
  define('CITY', $params['city']);
  define('DIRECTOR_NAME', $params['director_name']);
  define('PERIOD', $params['period']);
  define('PHONE_NUMBER', $params['phone_number']);
  define('POSTAL_CODE', $params['postal_code']);
  define('SCHOOL_NAME', $params['school_name']);
  if ($params['short_school_name'] !== null) define('SHORT_SCHOOL_NAME', $params['short_school_name']);
  else define('SHORT_SCHOOL_NAME', '');
  define('STATE', $params['state']);
} else {
  // De no haber resultados, definimos las constantes con valores vacíos
  define('ADDRESS', '');
  define('CCT', '');
  define('CITY', '');
  define('DIRECTOR_NAME', '');
  define('PERIOD', '');
  define('PHONE_NUMBER', '');
  define('POSTAL_CODE', '');
  define('SCHOOL_NAME', '');
  define('SHORT_SCHOOL_NAME', '');
  define('STATE', '');
}

// Definimos los días hábiles de la semana
define('DAYS', [
  'Lunes',
  'Martes',
  'Miércoles',
  'Jueves',
  'Viernes',
]);

// Definimos de donde se enviarán los correos
define('MAIL_FROM', 'no-reply@cetis.edu.mx');

// Definimos el dominio de la aplicación, este nos servirá para hacer redirecciones o enlaces
define('DOMAIN', 'http://localhost/asisweb/');
