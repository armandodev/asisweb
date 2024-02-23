<?php
require_once __DIR__ . '/Database.php';
$db = new Database();
$result = $db->getParams();
$params = $result->fetch(PDO::FETCH_ASSOC);

define('ADDRESS', $params['address']);
define('CCT', $params['cct']);
define('CITY', $params['city']);
define('DIRECTOR_NAME', $params['director_name']);
define('PERIOD', $params['period']);
define('PHONE_NUMBER', $params['phone_number']);
define('POSTAL_CODE', $params['postal_code']);
define('SCHOOL_NAME', $params['school_name']);
if ($params['short_school_name'] !== null) define('SHORT_SCHOOL_NAME', $params['short_school_name']);
else define('SHORT_SCHOOL_NAME', '');
define('STATE', $params['state']);
