<?php
require_once __DIR__ . '/../auth/Auth.php';
require_once __DIR__ . '/../config/config.php';

$auth = new Auth();

if (!isset ($_SESSION['user']) || $_SESSION['user']['role'] !== 'Administrador') {
    header('Location: ' . DOMAIN . '/login.php');
    exit;
}
