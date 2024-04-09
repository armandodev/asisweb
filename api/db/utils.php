<?php
class Database
{
  private $host = 'localhost';
  private $db_name = 'asisweb';
  private $username = 'root';
  private $password = '';
  private $port = '3306';
  public $conn;

  public function closeConnection()
  {
    $this->conn = null;
  }

  public function getConnection()
  {
    $this->closeConnection();
    try {
      $this->conn = new PDO('mysql:host=' . $this->host . ';port=' . $this->port . ';dbname=' . $this->db_name, $this->username, $this->password);
      $this->conn->exec('set names utf8');
    } catch (PDOException $e) {
      echo 'Error de conexión: ' . $e->getMessage();
    }
    return $this->conn;
  }

  public function execute($sql, $params = [])
  {
    $this->getConnection();
    $stmt = $this->conn->prepare($sql);
    $stmt->execute($params);
    $this->closeConnection();
    return $stmt;
  }
}

function validateApiKey()
{
  try {
    if (!isset($_GET['api_key'])) throw new Exception('No se ha proporcionado una API key');
    $api_key = $_GET['api_key'];

    $db = new Database();
    $sql = "SELECT * FROM api_keys WHERE api_key = :api_key";
    $params = [':api_key' => $api_key];
    $result = $db->execute($sql, $params);
    if (!$result || count($result) === 0) throw new Exception('API key inválido');
  } catch (Exception $e) {
    header('HTTP/1.1 401 Unauthorized');
    echo json_encode(['error' => $e->getMessage()]);
    exit();
  }
}
