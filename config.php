<?php
require_once __DIR__ . '/api/db/utils.php';

session_start();

define('BASE_URL', 'http://localhost/asisweb/');
define('EMAIL_FROM', 'no-reply@localhost');

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
