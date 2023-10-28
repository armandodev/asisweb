<?php
class Database
{
  public function connect()
  {
    try {
      $db = new PDO('sqlite:/mnt/c/Users/jorge/Downloads/asisweb.sql');
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $db;
    } catch (PDOException $e) {
      return 'Error de conexión: ' . $e->getMessage();
    }
  }
}
