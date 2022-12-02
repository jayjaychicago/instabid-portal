<?php

  declare(strict_types=1);
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  require "init.php";

$userInfo = $auth0->getUser();

if (!$userInfo) {
    die("Error while logging you in. Please retry");
} else {
    var_dump($userInfo);
}
  // Nothing to do: redirect to index route.
 // header('Location: /lumino/sd.php');

  ?>