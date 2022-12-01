<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

echo '<pre>';
var_dump($_SESSION);
echo '</pre>';

require 'vendor/autoload.php';

// Load our environment variables from the .env file:
(Dotenv\Dotenv::createImmutable(__DIR__))->load();


// This is all setup in AWS ELB at: https://us-east-2.console.aws.amazon.com/elasticbeanstalk/home?region=us-east-2#/environment/configuration?applicationName=Instabid&environmentId=e-e2vtbrvebm
// In the "software" config portion of the ELB


$auth0 = new \Auth0\SDK\Auth0([
  'domain' => $_ENV['AUTH0_DOMAIN'],
  'clientId' => $_ENV['AUTH0_CLIENT_ID'],
  'clientSecret' => $_ENV['AUTH0_CLIENT_SECRET'],
  'cookieSecret' => $_ENV['AUTH0_COOKIE_SECRET'],
    'redirectUri' => 'https://portal.instabid.io/lumino/sd.php'
]); 


$userInfo = $auth0->getUser();
if ($userInfo === null) {
  echo "damn, it's null";
}
echo $userInfo;

?>
