<?php
require_once '../includes/session.php';
require_once '../includes/exceptions.php';

session_destroy();

header('Location: ./../');
exit();
