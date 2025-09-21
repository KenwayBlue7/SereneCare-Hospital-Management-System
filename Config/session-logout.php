<?php
require `login_config.php`;
$_SESSION = [];
session_unset();
session_destroy();
header("Location: ../Index.php");
?>