
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);  
require "init.php";

  header(sprintf('Location: %s', $sdk->logout()));

  ?>