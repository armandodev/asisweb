<?php
class Database extends SQLite3
{
  private $path;

  function __construct()
  {
    $this->path = realpath(__DIR__ . "/../asisweb.db");
    $this->open($this->path);
  }

  public function selectUser($rfc)
  {
    $query = "SELECT * FROM docentes WHERE rfc = :rfc LIMIT 1";

    // Prepara la consulta
    $stmt = $this->prepare($query);

    if (!$stmt) {
      throw new Exception(ERROR_MESSAGES[ERROR_QUERY], ERROR_QUERY);
    }

    $stmt->bindParam(':rfc', $rfc);

    $result = $stmt->execute();

    if (!$result) {
      throw new Exception(ERROR_MESSAGES[ERROR_QUERY], ERROR_QUERY);
    }

    // Obtén el resultado
    $user = $result->fetchArray(SQLITE3_ASSOC);

    if (!$user) {
      throw new Exception(ERROR_MESSAGES[ERROR_USER_NOT_FOUND], ERROR_USER_NOT_FOUND);
    }

    return $user;
  }

  public function login($user, $password)
  {
    if (!password_verify($password . $user['salt'], $user['password'])) {
      throw new Exception(ERROR_MESSAGES[ERROR_WRONG_PASSWORD], ERROR_WRONG_PASSWORD);
    }

    $_SESSION['user'] = $user;
    $_SESSION['login'] = true;
  }

  public function selectSubjects()
  {
    $rfc = $_SESSION['user']['rfc'];

    $query = "SELECT DISTINCT asignaturas.nombre, grupos.semestre, grupos.grupo, grupos.especialidad
    FROM listas
    INNER JOIN asignaturas ON listas.asignaturaID = asignaturas.asignaturaID
    INNER JOIN grupos ON listas.grupoID = grupos.grupoID
    WHERE listas.rfc = :rfc;
    ";
    $stmt = $this->prepare($query);
    $stmt->bindParam(':rfc', $rfc);

    $result = $stmt->execute();
    $subjects = array();
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
      $subjects[] = $row;
    }

    return $subjects;
  }
}
