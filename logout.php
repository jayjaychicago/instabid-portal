<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
/*
require 'vendor/autoload.php';

// Load our environment variables from the .env file:
(Dotenv\Dotenv::createImmutable(__DIR__))->load();

$auth0 = new \Auth0\SDK\Auth0([
  'domain' => $_ENV['AUTH0_DOMAIN'],
  'clientId' => $_ENV['AUTH0_CLIENT_ID'],
  'clientSecret' => $_ENV['AUTH0_CLIENT_SECRET'],
  'cookieSecret' => $_ENV['AUTH0_COOKIE_SECRET'],
    'redirectUri' => 'https://instabid.io'
]); 

//echo $auth0->logout();
*/
header($auth0->logout());
?>
