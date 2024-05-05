<?php
require_once __DIR__ . '/api/db/utils.php';

session_start();

define('BASE_URL', 'http://localhost/asisweb/');
define('EMAIL_FROM', 'no-reply@localhost');
define('HOURS', [
  [
    'hour' => '7:00 - 8:00',
    'start' => '07:00:00'
  ],
  [
    'hour' => '8:00 - 9:00',
    'start' => '08:00:00'
  ],
  [
    'hour' => '9:00 - 10:00',
    'start' => '09:00:00'
  ],
  [
    'hour' => '10:00 - 11:00',
    'start' => '10:00:00'
  ],
  [
    'hour' => '11:00 - 12:00',
    'start' => '11:00:00'
  ],
  [
    'hour' => '12:00 - 13:00',
    'start' => '12:00:00'
  ],
  [
    'hour' => '13:00 - 14:00',
    'start' => '13:00:00'
  ],
  [
    'hour' => '14:00 - 15:00',
    'start' => '14:00:00'
  ],
]);

if (isset($_SESSION['user'])) {
  try {
    $db = new Database();
    $sql = 'SELECT * FROM users WHERE user_id = :id';
    $result = $db->execute($sql, ['id' => $_SESSION['user']['user_id']]);

    if ($result->rowCount() === 0) throw new Exception('Tu usuario ha sido eliminado por un administrador', 403);
    $user = $result->fetch(PDO::FETCH_ASSOC);
    if ($user['status'] !== 'Activo') throw new Exception('Tu cuenta ha sido desactivada', 403);

    $_SESSION['user'] = $user;
  } catch (Exception $e) {
    session_destroy();
    header('HTTP/1.1' . $e->getCode() . ' ' . $e->getMessage());
    echo $e->getMessage();
    echo '<p><a href="' .  BASE_URL . 'index.php">Inicia sesión nuevamente</a></p>';
    exit();
  }
}
