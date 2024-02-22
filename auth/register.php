<?php
require_once 'Auth.php';

$auth = new Auth();

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$phone_number = $_POST['phone_number'];
$password = $_POST['password'];

$data = [
  'first_name' => $first_name,
  'last_name' => $last_name,
  'email' => $email,
  'phone_number' => $phone_number,
  'password' => $password
];

$auth->register($data);
