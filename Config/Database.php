<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'Niranjan');
define('DB_PSWD', 'root');
define('DB_NAME', 'hospital');

$conn = new mysqli(DB_HOST, DB_USER, DB_PSWD, DB_NAME);

// if ($conn->connect_error)
//     die('Connection Failed'. $conn->connect_error);

// echo 'CONNECTED!';