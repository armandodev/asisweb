<?php
define('ERROR_CONNECTION', 0);
define('ERROR_ALREADY_LOGGED', 1);
define('ERROR_INVALID_METHOD', 2);
define('ERROR_EMPTY_RFC_PASSWORD', 3);
define('ERROR_QUERY', 4);
define('ERROR_USER_NOT_FOUND', 5);
define('ERROR_WRONG_PASSWORD', 6);

define('ERROR_MESSAGES', [
  ERROR_CONNECTION => 'Error de conexión, intente más tarde',
  ERROR_ALREADY_LOGGED => 'El usuario ya ha iniciado sesión, cierre sesión para iniciar con otro usuario',
  ERROR_INVALID_METHOD => 'Método inválido',
  ERROR_EMPTY_RFC_PASSWORD => 'RFC y contraseña son obligatorios, intente de nuevo',
  ERROR_QUERY => 'Error al preparar/ejecutar su solicitud, intente más tarde',
  ERROR_USER_NOT_FOUND => 'El usuario no existe, ingrese un RFC válido',
  ERROR_WRONG_PASSWORD => 'La contraseña es incorrecta, intente de nuevo'
]);
