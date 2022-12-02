<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require('vendor/autoload.php');

use Auth0\SDK\Auth0;
use Auth0\SDK\Configuration\SdkConfiguration;
header(sprintf('Location: %s', $sdk->login()));
?>