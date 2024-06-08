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

  public function fetch($sql, $params = [])
  {
    $this->getConnection();
    $stmt = $this->conn->prepare($sql);
    $stmt->execute($params);
    if ($stmt->rowCount() === 0) return false;
    if ($stmt->rowCount() === 1) return $result = $stmt->fetch(PDO::FETCH_ASSOC);
    else $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $this->closeConnection();
    return $result;
  }

  public function delete($table, $where)
  {
    $this->getConnection();
    $sql = 'DELETE FROM ' . $table . ' WHERE ' . $where;
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $this->closeConnection();
    return $stmt->rowCount();
  }
}
