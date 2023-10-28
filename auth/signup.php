<?php
require_once __DIR__ . '/../includes/session.php';

exit();

$rfc = "CANG7403133E2";
$nombre = "Gabriel Chávez";
$password = "CANG7403133E2";
$salt = bin2hex(random_bytes(16));
$password = password_hash($password . $salt, PASSWORD_DEFAULT);

$query = "INSERT INTO docentes (rfc, nombre, password, salt) VALUES (:rfc, :nombre, :password, :salt)";

// Prepara la consulta
$stmt = $db->prepare($query);

if (!$stmt) {
  throw new Exception('Error al preparar la consulta', 5);
}

$stmt->bindParam(':rfc', $rfc);
$stmt->bindParam(':nombre', $nombre);
$stmt->bindParam(':password', $password);
$stmt->bindParam(':salt', $salt);

$result = $stmt->execute();
