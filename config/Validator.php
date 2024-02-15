<?php
// Clase para la validación de los datos, el objetivo principal de esta es mantener el código limpio y fácil de modificar en caso de que se necesite cambiar el método de validación.
class Validator
{
  private $regex;

  // Constructor de la clase, se ejecuta cada vez que se instancia un objeto de la clase.
  public function __construct()
  {
    // Expresiones regulares para la validación de los datos.
    $this->regex = [
      'rfc' => '/^[A-Z]{4}[0-9]{6}[A-Z0-9]{3}$/',
      'curp' => '/^[A-Z]{4}[0-9]{6}[HM][A-Z]{6}[0-9]{1}$/',
      'first_name' => '/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/',
      'last_name' => '/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/',
      'email' => '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
      'phone_number' => '/^[0-9]{10}$/',
      'password' => '/^.{6,}$/'
    ];
  }

  // Método para validar los datos del formulario de inicio de sesión.
  public function validateLogin($email, $password)
  {
    // Validación del correo electrónico.
    if (!preg_match($this->regex['email'], $email)) {
      throw new Exception('El correo electrónico no es válido.');
    }

    // Validación de la contraseña.
    if (!preg_match($this->regex['password'], $password)) {
      throw new Exception('La contraseña no es válida.');
    }

    // Retorna verdadero si los datos son válidos.
    return;
  }

  // Método para validar los datos del formulario de registro.
  public function validateRegister($rfc, $curp, $first_name, $last_name, $email, $phone_number, $password)
  {
    // Validación del RFC.
    if (!preg_match($this->regex['rfc'], $rfc)) {
      throw new Exception('El RFC no es válido.');
    }

    // Validación del CURP.
    if (!preg_match($this->regex['curp'], $curp)) {
      throw new Exception('El CURP no es válido.');
    }

    // Validación del nombre.
    if (!preg_match($this->regex['first_name'], $first_name)) {
      throw new Exception('El nombre no es válido.');
    }

    // Validación del apellido.
    if (!preg_match($this->regex['last_name'], $last_name)) {
      throw new Exception('El apellido no es válido.');
    }

    // Validación del correo electrónico.
    if (!preg_match($this->regex['email'], $email)) {
      throw new Exception('El correo electrónico no es válido.');
    }

    // Validación del número telefónico.
    if (!preg_match($this->regex['phone_number'], $phone_number)) {
      throw new Exception('El número telefónico no es válido.');
    }

    // Validación de la contraseña.
    if (!preg_match($this->regex['password'], $password)) {
      throw new Exception('La contraseña no es válida.');
    }

    // Retorna verdadero si los datos son válidos.
    return;
  }

  public function validateEmail($email)
  {
    // Validación del correo electrónico.
    if (!preg_match($this->regex['email'], $email)) {
      throw new Exception('El email es invalido');
    }

    // Retorna verdadero si los datos son válidos.
    return;
  }

  public function validatePhoneNumber($phone_number)
  {
    // Validación del correo electrónico.
    if (!preg_match($this->regex['phone_number'], $phone_number)) {
      throw new Exception('El número de teléfono es invalido');
    }

    // Retorna verdadero si los datos son válidos.
    return;
  }
}
