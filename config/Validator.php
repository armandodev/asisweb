<?php
// Clase para la validación de los datos, el objetivo principal de esta es mantener el código limpio y fácil de modificar en caso de que se necesite cambiar el método de validación.
class Validator
{
  // Método para validar el nombre/apellido.
  public function validateName($name)
  {
    if (!preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{3,100}$/', $name)) {
      throw new Exception('El nombre/apellido es invalido');
      return false;
    }
    return;
  }

  // Método para validar el correo electrónico.
  public function validateEmail($email)
  {
    if (!preg_match('/^(?=.{5,255}$)[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/', $email)) {
      throw new Exception('El email es invalido');
      return false;
    }
    return;
  }

  // Método para validar la contraseña.
  public function validatePassword($password)
  {
    if (!preg_match('/^.{6,100}$/', $password)) {
      throw new Exception('La contraseña es invalida');
      return false;
    }
    return;
  }

  // Método para validar el nombre de la escuela.
  public function validateSchoolName($schoolName)
  {
    if (!preg_match('/^.{3,150}$/', $schoolName)) {
      throw new Exception('El nombre de la escuela es inválido');
      return false;
    }
    return;
  }

  // Método para validar el CCT.
  public function validateCCT($cct)
  {
    if (!preg_match('/[0-9]{2}[A-Z]{3}[0-9]{4}[A-Z]{1}/', $cct)) {
      throw new Exception('El CCT es inválido');
      return false;
    }
    return;
  }

  // Método para validar el nombre corto de la escuela.
  public function validateShortSchoolName($shortSchoolName)
  {
    if (!preg_match('/^.{3,20}$/', $shortSchoolName)) {
      throw new Exception('El nombre corto de la escuela es inválido');
      return false;
    }
    return;
  }

  // Método para validar el periodo.
  public function validatePeriod($period)
  {
    if (!preg_match('/[0-9]{4}-[1-2]{1}/', $period)) {
      throw new Exception('El periodo es inválido');
      return false;
    }
    return;
  }

  // Método para validar el nombre del director(a) del plantel.
  public function validateDirectorName($directorName)
  {
    if (!preg_match('/^.{5,100}$/', $directorName)) {
      throw new Exception('El nombre del director(a) del plantel es inválido');
      return false;
    }
    return;
  }

  // Método para validar el teléfono.
  public function validatePhoneNumber($phoneNumber)
  {
    if (!preg_match('/[0-9 ]{10,15}/', $phoneNumber)) {
      throw new Exception('El número de teléfono es inválido');
      return false;
    }
    return;
  }

  // Método para validar el estado.
  public function validateState($state)
  {
    if (!preg_match('/^.{3,100}$/', $state)) {
      throw new Exception('El estado es inválido');
      return false;
    }
    return;
  }

  // Método para validar la ciudad.
  public function validateCity($city)
  {
    if (!preg_match('/^.{3,100}$/', $city)) {
      throw new Exception('La ciudad es inválida');
      return false;
    }
    return;
  }

  // Método para validar la dirección.
  public function validateAddress($address)
  {
    if (!preg_match('/^.{3,150}$/', $address)) {
      throw new Exception('La dirección es inválida');
      return false;
    }
    return;
  }

  // Método para validar el código postal.
  public function validatePostalCode($postalCode)
  {
    if (!preg_match('/[0-9]{5}/', $postalCode)) {
      throw new Exception('El código postal es inválido');
      return false;
    }
    return;
  }

  // Método para validar los datos del formulario de inicio de sesión.
  public function validateLogin($data)
  {
    $this->validateEmail($data['email']);
    $this->validatePassword($data['password']);
    return;
  }

  // Método para validar los datos del formulario de registro.
  public function validateRegister($data)
  {
    $this->validateName($data['first_name']);
    $this->validateName($data['last_name']);
    $this->validateEmail($data['email']);
    $this->validatePhoneNumber($data['phone_number']);
    $this->validatePassword($data['password']);
    return;
  }

  // Método para validar los datos del formulario del plantel.
  public function validateParamsForm($data)
  {
    $this->validateSchoolName($data['school_name']);
    $this->validateCCT($data['cct']);
    if (isset($data['short_school_name']) && $data['short_school_name'] !== '') {
      $this->validateShortSchoolName($data['short_school_name']);
    }
    $this->validatePeriod($data['period']);
    $this->validateDirectorName($data['director_name']);
    $this->validatePhoneNumber($data['phone_number']);
    $this->validateState($data['state']);
    $this->validateCity($data['city']);
    $this->validateAddress($data['address']);
    $this->validatePostalCode($data['postal_code']);
    return;
  }
}
