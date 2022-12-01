<?php 

echo "v1";
// Import the Composer Autoloader to make the SDK classes accessible:
require 'vendor/autoload.php';

// Load our environment variables from the .env file:
(Dotenv\Dotenv::createImmutable(__DIR__))->load();

// Now instantiate the Auth0 class with our configuration:
$auth0 = new \Auth0\SDK\Auth0([
    'domain' => 'https://dev-4lodh4ux8xq4milm.us.auth0.com',
    'clientId' => 'u9DKrKOTgaiFu76SkPn4u7VHPpV5xZCw',
    'clientSecret' => 'T4ywxzfVC34VK4SUKghb-Ss53p24iU43AaWhQYMpsSl0iflKhAvnBnMqGBS7gXtT',
    'cookieSecret' => '9c04c9cccd5f7bdc4e5b7ba41cf8d53528db5704e051d89bd3e3379e0ab83c2c'
]);

/*
$auth0 = new \Auth0\SDK\Auth0([
  'domain' => $_ENV['AUTH0_DOMAIN'],
  'clientId' => $_ENV['AUTH0_CLIENT_ID'],
  'clientSecret' => $_ENV['AUTH0_CLIENT_SECRET'],
  'cookieSecret' => $_ENV['AUTH0_COOKIE_SECRET']
]);
*/
?>