<?php
class Database extends SQLite3
{
  function __construct()
  {
    $this->open("./../asisweb.db");
  }

  public function selectUser($rfc)
  {
    $query = "SELECT * FROM docentes WHERE rfc = :rfc LIMIT 1";

    // Prepara la consulta
    $stmt = $this->prepare($query);

    if (!$stmt) {
      throw new Exception('Error al preparar/ejecutar la consulta', 4);
    }

    $stmt->bindParam(':rfc', $rfc);

    $result = $stmt->execute();

    if (!$result) {
      throw new Exception('Error al preparar/ejecutar la consulta', 4);
    }

    // Obtén el resultado
    $user = $result->fetchArray(SQLITE3_ASSOC);

    if (!$user) {
      throw new Exception('El usuario no existe', 5);
    }

    return $user;
  }

  public function login($user, $password)
  {
    if (!password_verify($password . $user['salt'], $user['password'])) {
      throw new Exception('La contraseña es incorrecta', 6);
    }

    $_SESSION['user'] = $user;
    $_SESSION['login'] = true;
  }
}
