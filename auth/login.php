<?php
require_once 'Auth.php';

$auth = new Auth();

$email = $_POST['email'];
$password = $_POST['password'];

$data = [
  'email' => $email,
  'password' => $password
];

$auth->login($data);
