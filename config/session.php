<?php
require_once __DIR__ . '/../auth/Auth.php';
require_once __DIR__ . '/config.php';

$auth = new Auth();

if (isset ($_SESSION['user'])) {
    header('Location: ./index.php');
    exit();
} elseif (!isset ($_SESSION['user'])) {
    header('Location: ./login.php');
    exit();
}
