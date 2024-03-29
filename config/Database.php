<?php
// Clase para el manejo total de la base de datos, esta se crea con el objetivo que, en caso de que busquen cambiar cualquier tema de consultas o de conexión (entre otros), solo se modifique en un solo lugar.
class Database
{
  // Variables para la conexión a la base de datos.
  private $host = 'localhost';
  private $db_name = 'asisweb';
  private $username = 'root';
  private $password = '';
  private $port = '3306';
  public $conn;

  // Función para la conexión a la base de datos.
  public function getConnection()
  {
    // Si la conexión no existe, la crea.
    $this->conn = null;

    try {
      // Intenta la conexión a la base de datos.
      $this->conn = new PDO('mysql:host=' . $this->host . ';port=' . $this->port . ';dbname=' . $this->db_name, $this->username, $this->password);
      $this->conn->exec('set names utf8');
    } catch (PDOException $exception) {
      // Si hay un error en la conexión, lo muestra en pantalla. (Solo para desarrollo, en producción se debe cambiar por un mensaje genérico.)
      echo 'Error de conexión: ' . $exception->getMessage();
    }
    return $this->conn;
  }

  // Función para cerrar la conexión a la base de datos.
  public function closeConnection()
  {
    // Cierra la conexión a la base de datos.
    $this->conn = null;
  }

  // Función para ejecutar una consulta a la base de datos.
  public function executeQuery($query, $params = [])
  {
    // Obtiene la conexión a la base de datos.
    $this->getConnection();
    // Prepara la consulta a la base de datos.
    $stmt = $this->conn->prepare($query);
    // Ejecuta la consulta a la base de datos.
    $stmt->execute($params);
    // Cierra la conexión a la base de datos.
    $this->closeConnection();
    // Retorna el resultado de la consulta.
    return $stmt;
  }

  public function getParams()
  {
    // Prepara la consulta a la base de datos.
    $query = "SELECT * FROM params LIMIT 1";
    // Ejecuta la consulta a la base de datos.
    $result = $this->executeQuery($query);
    // Retorna el resultado de la consulta.
    return $result;
  }

  public function getSubjects()
  {
    // Obtiene la conexión a la base de datos.
    $this->getConnection();
    // Prepara la consulta a la base de datos.
    $stmt = $this->conn->prepare('SELECT * FROM subjects');
    // Ejecuta la consulta a la base de datos.
    $stmt->execute();
    // Cierra la conexión a la base de datos.
    $this->closeConnection();
    // Retorna el resultado de la consulta.
    return $stmt;
  }

  public function getSchedule($day = null)
  {
    $user_id = $_SESSION['user']['user_id'];

    if ($day === null) {
      $query = "SELECT start_time, end_time, subject_name, day, classroom, career_name, group_semester, group_letter
        FROM schedule
        INNER JOIN subjects ON schedule.subject_id = subjects.subject_id
        INNER JOIN groups ON schedule.group_id = groups.group_id
        INNER JOIN careers ON groups.career_id = careers.career_id
        WHERE user_id = :user_id";
    } else {
      $query = "SELECT start_time, end_time, subject_name, day, classroom, career_name, group_semester, group_letter
        FROM schedule
        INNER JOIN subjects ON schedule.subject_id = subjects.subject_id
        INNER JOIN groups ON schedule.group_id = groups.group_id
        INNER JOIN careers ON groups.career_id = careers.career_id
        WHERE user_id = :user_id AND day = :day";
    }

    $params = [':user_id' => $user_id];
    if ($day !== null) {
      $params[':day'] = $day;
    }

    $this->getConnection();
    $result = $this->executeQuery($query, $params);
    $this->closeConnection();

    if ($result->rowCount() > 0) {
      $result = $result->fetchAll(PDO::FETCH_ASSOC);
    } else {
      $result = [];
    }

    return $result;
  }
}
