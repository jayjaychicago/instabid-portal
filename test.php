<html>
 <head>
  <title>PHP Test</title>
 </head>
 <body>
 <?php 
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
echo '<p>Hello 1</p>'; 

$redis = new Redis();
$redis->connect('127.0.0.1', 6379);
echo $redis->get('toto');
echo '<p>Hello World</p>'; 
echo '<p>Hello World2</p>'; 
?> 
 </body>
</html>
