<?php
// Creamos una clase para conectarnos a la base de datos y realizar consultas
class Database
{
  private $host = 'localhost'; // Nombre del servidor de la base de datos
  private $db_name = 'asisweb'; // Nombre de la base de datos
  private $username = 'root'; // Nombre de usuario de la base de datos
  private $password = '2707'; // Contraseña de la base de datos
  private $port = '3306'; // Puerto de la base de datos
  public $conn; // Conexión a la base de datos

  // Método para conectarnos a la base de datos
  public function getConnection()
  {
    try { // Intentamos conectarnos a la base de datos
      $this->conn = new PDO('mysql:host=' . $this->host . ';port=' . $this->port . ';dbname=' . $this->db_name, $this->username, $this->password); // Conectamos a la base de datos con PDO
      $this->conn->exec('set names utf8'); // Asignamos el idioma a UTF-8
    } catch (PDOException $e) {
      echo 'Error de conexión: ' . $e->getMessage(); // Si no se pudo conectarnos a la base de datos, imprimimos un mensaje de error
    }
    return $this->conn; // Devolvemos la conexión a la base de datos
  }

  // Método para cerrar la conexión a la base de datos
  public function closeConnection()
  {
    $this->conn = null; // Asignamos null a la variable $conn para cerrar la conexión
  }

  // Método para realizar consultas a la base de datos
  public function execute($sql, $params = []) // $sql es la consulta SQL y $params es un array con los valores de los parámetros de la consulta, este ultimo es opcional
  {
    $this->getConnection(); // Conectamos a la base de datos
    $stmt = $this->conn->prepare($sql); // Preparamos la consulta SQL
    $stmt->execute($params); // Ejecutamos la consulta SQL con los valores de los parámetros
    $this->closeConnection(); // Cerramos la conexión a la base de datos
    return $stmt; // Devolvemos la consulta SQL
  }

  // Método para obtener los resultados de una consulta a la base de datos
  public function fetch($sql, $params = [])
  {
    $this->getConnection(); // Conectamos a la base de datos
    $stmt = $this->conn->prepare($sql); // Preparamos la consulta SQL
    $stmt->execute($params); // Ejecutamos la consulta SQL con los valores de los parámetros
    if ($stmt->rowCount() === 0) return false; // Si no hay resultados, devolvemos false
    if ($stmt->rowCount() === 1) $result = $stmt->fetch(PDO::FETCH_ASSOC); // Si hay un solo resultado, devolvemos el resultado como un array
    else $result = $stmt->fetchAll(PDO::FETCH_ASSOC); // Si hay más de un resultado, devolvemos todos los resultados como un array de arrays
    $this->closeConnection(); // Cerramos la conexión a la base de datos
    return $result; // Devolvemos el resultado
  }
}
