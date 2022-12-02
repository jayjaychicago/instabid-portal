<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$sdk = $_SESSION["auth0_sdk"];

header(sprintf('Location: %s', $sdk->login()));
?>