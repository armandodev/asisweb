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

    $query = "SELECT DISTINCT listas.asignaturaID, asignaturas.nombre, listas.grupoID, grupos.semestre, grupos.grupo, grupos.especialidad
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

  public function selectGroupInfo()
  {
    if (!isset($_GET['groupID'])) {
      header('Location: ./');
      exit();
    }

    if (!is_numeric($_GET['groupID'])) {
      header('Location: ./');
      exit();
    }

    $groupID = $_GET['groupID'];
    $subjectID = $_GET['subjectID'];

    $query = "SELECT grupos.semestre, grupos.grupo, grupos.especialidad, asignaturas.nombre AS nombreAsignatura, docentes.nombre AS nombreDocente, docentes.paterno, docentes.materno FROM listas INNER JOIN grupos ON listas.grupoID = grupos.grupoID INNER JOIN asignaturas ON listas.asignaturaID = asignaturas.asignaturaID INNER JOIN docentes ON listas.rfc = docentes.rfc WHERE listas.grupoID = :groupID AND listas.asignaturaID = :subjectID";
    $stmt = $this->prepare($query);
    $stmt->bindParam(':groupID', $groupID);
    $stmt->bindParam(':subjectID', $subjectID);

    $result = $stmt->execute();
    $groupInfo = $result->fetchArray(SQLITE3_ASSOC);

    if (count($groupInfo) == 0) {
      header('Location: ./');
      exit();
    }

    return $groupInfo;
  }

  public function selectGroupList()
  {
    if (!isset($_GET['groupID']) || !isset($_GET['subjectID'])) {
      header('Location: ./');
      exit();
    }

    if (!is_numeric($_GET['groupID']) || !is_numeric($_GET['subjectID'])) {
      header('Location: ./');
      exit();
    }

    $groupID = $_GET['groupID'];
    $subjectID = $_GET['subjectID'];

    $query = "SELECT alumnos.nombre, alumnos.paterno, alumnos.materno, listas.asistencias FROM listas INNER JOIN alumnos ON listas.noControl = alumnos.noControl WHERE listas.grupoID = :groupID AND listas.asignaturaID = :subjectID ORDER BY alumnos.paterno ASC";

    $stmt = $this->prepare($query);
    $stmt->bindParam(':groupID', $groupID);
    $stmt->bindParam(':subjectID', $subjectID);

    $result = $stmt->execute();
    $groupList = array();
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
      $groupList[] = $row;
    }

    if (count($groupList) == 0) {
      header('Location: ./');
      exit();
    }

    return $groupList;
  }
}
