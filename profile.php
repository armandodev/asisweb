<?php
require_once 'auth/Auth.php';

$auth = new Auth();

print_r($_SESSION['user']);
