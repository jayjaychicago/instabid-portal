<html>
 <head>
  <title>PHP Test</title>
 </head>
 <body>
 <?php 
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
echo '<p>Hello 1</p>'; 
require 'Predis/Autoloader.php';
echo '<p>Hello World3</p>'; 
?> 
 </body>
</html>
