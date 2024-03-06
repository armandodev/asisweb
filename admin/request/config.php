<?php
require_once './../../config/session.php';
require_once './../../config/Database.php';
require_once './../../config/Validator.php';

try {
  $db = new Database;
  $validator = new Validator;

  if (!$_SERVER['REQUEST_METHOD'] === 'POST') throw new Exception("Método no permitido");

  if (!isset($_POST['school_name'])) throw new Exception("Falta el nombre de la escuela");
  if (!isset($_POST['cct'])) throw new Exception("Falta el CCT de la escuela");
  if (!isset($_POST['period'])) throw new Exception("Falta el periodo de la escuela");
  if (!isset($_POST['director_name'])) throw new Exception("Falta el nombre del director(a) de la escuela");
  if (!isset($_POST['phone_number'])) throw new Exception("Falta el número de teléfono de la escuela");
  if (!isset($_POST['state'])) throw new Exception("Falta el estado de la escuela");
  if (!isset($_POST['city'])) throw new Exception("Falta la ciudad de la escuela");
  if (!isset($_POST['address'])) throw new Exception("Falta la dirección de la escuela");
  if (!isset($_POST['postal_code'])) throw new Exception("Falta el código postal de la escuela");

  $validator->validateParamsForm($_POST);

  $params = [
    ':school_name' => $_POST['school_name'],
    ':cct' => $_POST['cct'],
    ':short_school_name' => isset($_POST['short_school_name']) ? $_POST['short_school_name'] : '',
    ':period' => $_POST['period'],
    ':director_name' => $_POST['director_name'],
    ':phone_number' => $_POST['phone_number'],
    ':state' => $_POST['state'],
    ':city' => $_POST['city'],
    ':address' => $_POST['address'],
    ':postal_code' => $_POST['postal_code']
  ];

  $result = $db->getParams();
  $db_params = $result->fetch(PDO::FETCH_ASSOC);

  if (
    $db_params['school_name'] === $params[':school_name'] &&
    $db_params['cct'] === $params[':cct'] &&
    $db_params['short_school_name'] === $params[':short_school_name'] &&
    $db_params['period'] === $params[':period'] &&
    $db_params['director_name'] === $params[':director_name'] &&
    $db_params['phone_number'] === $params[':phone_number'] &&
    $db_params['state'] === $params[':state'] &&
    $db_params['city'] === $params[':city'] &&
    $db_params['address'] === $params[':address'] &&
    $db_params['postal_code'] === $params[':postal_code']
  ) {
    $_SESSION['message'] = [
      "type" => "warning",
      "content" => 'Los datos son iguales a los que ya se encuentran guardados'
    ];
    header('Location: ./../config.php');
    exit;
  }

  $query = $result->rowCount() > 0
    ? "UPDATE params SET school_name = :school_name, short_school_name = :short_school_name, period = :period, director_name = :director_name, cct = :cct, phone_number = :phone_number, state = :state, city = :city, address = :address, postal_code = :postal_code"
    : "INSERT INTO params (school_name, short_school_name, period, director_name, cct, phone_number, state, city, address, postal_code) VALUES (:school_name, :short_school_name, :period, :director_name, :cct, :phone_number, :state, :city, :address, :postal_code)";

  $result = $db->executeQuery($query, $params);
  if (!$result) throw new Exception("No se han podido guardar los datos");

  $_SESSION['message'] = [
    "type" => "success",
    "content" => "Los datos se han guardado correctamente"
  ];
} catch (Exception $e) {
  $_SESSION['message'] = [
    "type" => "error",
    "content" => $e->getMessage()
  ];
} finally {
  header('Location: ./../config.php');
  exit;
}
