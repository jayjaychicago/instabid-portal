<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

  require('vendor/autoload.php');

  use Auth0\SDK\Auth0;
  use Auth0\SDK\Configuration\SdkConfiguration;

  $configuration = new SdkConfiguration(
    domain: $_ENV['AUTH0_DOMAIN'],
    clientId: $_ENV['AUTH0_CLIENT_ID'],
    clientSecret: $_ENV['AUTH0_CLIENT_SECRET'],
    redirectUri: 'https://' . $_SERVER['HTTP_HOST'] . '/callback.php',
    cookieSecret: '9c04c9cccd5f7bdc4e5b7ba41cf8d53528db5704e051d89bd3e3379e0ab83c2c'
  );

$sdk = new Auth0($configuration);

  $session = $sdk->getCredentials();
  $authenticated = $session !== null;

  $template = [
    'name' => $authenticated ? $session->user['email'] : 'guest',
    'picture' => $authenticated ? $session->user['picture'] : null,
    'session' => $authenticated ? print_r($session, true) : '',
    'auth:route' => $authenticated ? 'logout' : 'login',
    'auth:text' => $authenticated ? 'out' : 'in',
  ];

  printf('<p>Welcome, %s.</p>', $template['name']);
  printf('<p><pre>%s</pre></p>', $template['session']);
  printf('<p><a href="/%s">Log %s</a></p>', $template['auth:route'], $template['auth:text']);

  ?>