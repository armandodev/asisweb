<?php
require_once __DIR__ . '/config.php';

class Validator
{
  public function validate($value, $regex, $message)
  {
    if (!preg_match($regex, $value)) {
      throw new Exception($message);
      return false;
    }
    return;
  }

  public function validateLogin($data)
  {
    $this->validate($data['email'], REGEX['email'], 'El correo electrónico no es válido.');
    $this->validate($data['password'], REGEX['password'], 'La contraseña no es válida.');
    return;
  }

  public function validateRegister($data)
  {
    $this->validate($data['first_name'], REGEX['name'], 'El nombre no es válido.');
    $this->validate($data['last_name'], REGEX['name'], 'El apellido no es válido.');
    $this->validate($data['email'], REGEX['email'], 'El correo electrónico no es válido.');
    $this->validate($data['phone_number'], REGEX['phone_number'], 'El número de teléfono no es válido.');
    $this->validate($data['password'], REGEX['password'], 'La contraseña no es válida.');
    return;
  }

  public function validateParamsForm($data)
  {
    $this->validate($data['school_name'], REGEX['name'], 'El nombre de la escuela no es válido.');
    $this->validate($data['cct'], REGEX['cct'], 'El CCT no es válido.');
    if (isset($data['short_school_name']) && $data['short_school_name'] !== '')
      $this->validate($data['short_school_name'], REGEX['name'], 'El nombre corto de la escuela no es válido.');
    $this->validate($data['period'], REGEX['period'], 'El periodo no es válido.');
    $this->validate($data['director_name'], REGEX['name'], 'El nombre del director no es válido.');
    $this->validate($data['phone_number'], REGEX['phone_number'], 'El número de teléfono no es válido.');
    $this->validate($data['state'], REGEX['name'], 'El estado no es válido.');
    $this->validate($data['city'], REGEX['name'], 'La ciudad no es válida.');
    $this->validate($data['address'], REGEX['address'], 'La dirección no es válida.');
    $this->validate($data['postal_code'], REGEX['postal_code'], 'El código postal no es válido.');
    return;
  }

  public function validateExtraDataForm($data, $info)
  {
    if ($info === 'email') {
      $this->validate($data['email'], REGEX['email'], 'El correo electrónico no es válido.');
    } elseif ($info === 'phone_number') {
      $this->validate($data['phone_number'], REGEX['phone_number'], 'El número de teléfono no es válido.');
    } else {
      throw new Exception("La información extra a agregar es invalida");
    }
  }
}
