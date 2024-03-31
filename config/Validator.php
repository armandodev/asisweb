<?php
class Validator
{
  public $regex = [
    "name" => "/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{3,100}$/",
    "email" => "/^(?=.{5,255}$)[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/",
    "password" => "/^.{6,100}$/",
    "cct" => "/[0-9]{2}[A-Z]{3}[0-9]{4}[A-Z]{1}/",
    "period" => "/[0-9]{4}-[1-2]{1}/",
    "phone_number" => "/[0-9 ]{10,15}/",
    "address" => "/^.{3,150}$/",
    "postal_code" => "/[0-9]{5}/",
  ];

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
    $this->validate($data['email'], $this->regex['email'], 'El correo electrónico no es válido.');
    $this->validate($data['password'], $this->regex['password'], 'La contraseña no es válida.');
    return;
  }

  public function validateRegister($data)
  {
    $this->validate($data['first_name'], $this->regex['name'], 'El nombre no es válido.');
    $this->validate($data['last_name'], $this->regex['name'], 'El apellido no es válido.');
    $this->validate($data['email'], $this->regex['email'], 'El correo electrónico no es válido.');
    $this->validate($data['phone_number'], $this->regex['phone_number'], 'El número de teléfono no es válido.');
    $this->validate($data['password'], $this->regex['password'], 'La contraseña no es válida.');
    return;
  }

  public function validateParamsForm($data)
  {
    $this->validate($data['school_name'], $this->regex['name'], 'El nombre de la escuela no es válido.');
    $this->validate($data['cct'], $this->regex['cct'], 'El CCT no es válido.');
    if (isset($data['short_school_name']) && $data['short_school_name'] !== '')
      $this->validate($data['short_school_name'], $this->regex['name'], 'El nombre corto de la escuela no es válido.');
    $this->validate($data['period'], $this->regex['period'], 'El periodo no es válido.');
    $this->validate($data['director_name'], $this->regex['name'], 'El nombre del director no es válido.');
    $this->validate($data['phone_number'], $this->regex['phone_number'], 'El número de teléfono no es válido.');
    $this->validate($data['state'], $this->regex['name'], 'El estado no es válido.');
    $this->validate($data['city'], $this->regex['name'], 'La ciudad no es válida.');
    $this->validate($data['address'], $this->regex['address'], 'La dirección no es válida.');
    $this->validate($data['postal_code'], $this->regex['postal_code'], 'El código postal no es válido.');
    return;
  }

  public function validateExtraDataForm($data, $info)
  {
    if ($info === 'email') {
      $this->validate($data['email'], $this->regex['email'], 'El correo electrónico no es válido.');
    } elseif ($info === 'phone_number') {
      $this->validate($data['phone_number'], $this->regex['phone_number'], 'El número de teléfono no es válido.');
    } else {
      throw new Exception("La información extra a agregar es invalida");
    }
  }
}
