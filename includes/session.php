<?php
require_once __DIR__ . '/database.php';

$db = new Database();

session_start();

$db = $db->connect();
