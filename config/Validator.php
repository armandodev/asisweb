<?php
// Clase para la validación de los datos, el objetivo principal de esta es mantener el código limpio y fácil de modificar en caso de que se necesite cambiar el método de validación.
class Validator
{
  // Método para validar el RFC.
  public function validateRFC($rfc)
  {
    if (!preg_match('/^[A-Z]{4}[0-9]{6}[A-Z0-9]{3}$/', $rfc)) {
      throw new Exception('El RFC es invalido');
    }
    return;
  }

  // Método para validar el CURP.
  public function validateCURP($curp)
  {
    if (!preg_match('/^[A-Z]{4}[0-9]{6}[HM][A-Z]{6}[0-9]{1}$/', $curp)) {
      throw new Exception('El CURP es invalido');
    }
    return;
  }

  // Método para validar el nombre/apellido.
  public function validateName($name)
  {
    if (!preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{3,100}$/', $name)) {
      throw new Exception('El nombre/apellido es invalido');
    }
    return;
  }

  // Método para validar el correo electrónico.
  public function validateEmail($email)
  {
    if (!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,255}$/', $email)) {
      throw new Exception('El email es invalido');
    }
    return;
  }

  // Método para validar el número de teléfono.
  public function validatePhoneNumber($phone_number)
  {
    if (!preg_match('/^[0-9]{10}$/', $phone_number)) {
      throw new Exception('El número de teléfono es invalido');
    }
    return;
  }

  // Método para validar la contraseña.
  public function validatePassword($password)
  {
    if (!preg_match('/^.{6,100}$/', $password)) {
      throw new Exception('La contraseña es invalida');
    }
    return;
  }

  // Método para validar los datos del formulario de inicio de sesión.
  public function validateLogin($data)
  {
    if (!$this->validateEmail($data['email'])) throw new Exception('El correo electrónico no es válido.');
    if (!$this->validatePassword($data['password'])) throw new Exception('La contraseña no es válida.');
    return;
  }

  // Método para validar los datos del formulario de registro.
  public function validateRegister($data)
  {
    if (!$this->validateRFC($data['rfc'])) throw new Exception('El RFC no es válido.');
    if (!$this->validateCURP($data['curp'])) throw new Exception('El CURP no es válido.');
    if (!$this->validateName($data['name'])) throw new Exception('El nombre no es válido.');
    if (!$this->validateName($data['last_name'])) throw new Exception('El apellido no es válido.');
    if (!$this->validateEmail($data['email'])) throw new Exception('El correo electrónico no es válido.');
    if (!$this->validatePhoneNumber($data['phone_number'])) throw new Exception('El número de teléfono no es válido.');
    if (!$this->validatePassword($data['password'])) throw new Exception('La contraseña no es válida.');
    return;
  }
}
