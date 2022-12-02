<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

  require('vendor/autoload.php');

  (Dotenv\Dotenv::createImmutable(__DIR__))->load();

  use Auth0\SDK\Auth0;
  use Auth0\SDK\Configuration\SdkConfiguration;

  $configuration = new SdkConfiguration(
    domain: $_ENV['AUTH0_DOMAIN'],
    clientId: $_ENV['AUTH0_CLIENT_ID'],
    clientSecret: $_ENV['AUTH0_CLIENT_SECRET'],
    redirectUri: 'https://' . $_SERVER['HTTP_HOST'] . '/callback.php',
    cookieSecret: '9c04c9cccd5f7bdc4e5b7ba41cf8d53528db5704e051d89bd3e3379e0ab83c2c'
  );
  
  $auth0 = new Auth0([
    'domain' => $_ENV['AUTH0_DOMAIN'],
    'clientId' => $_ENV['AUTH0_CLIENT_ID'],
    'client_secret' => $_ENV['AUTH0_CLIENT_SECRET'],
    'redirect_uri' => 'https://' . $_SERVER['HTTP_HOST'] . '/callback.php',
    'cookieSecret' => '9c04c9cccd5f7bdc4e5b7ba41cf8d53528db5704e051d89bd3e3379e0ab83c2c',
   // 'audience' => 'https://myphpnotes.auth0.com/userinfo',
    'persist_id_token' => true,
    'persist_access_token' => true,
    'persist_refresh_token' => true,
  ]);

$sdk = new Auth0($configuration);

  /**
   * Upon returning from the Auth0 Universal Login, we need to perform a code exchange using the `exchange()` method
   * to complete the authentication flow. This process configures the session for use by the application.
   *
   * If successful, the user will be redirected back to the index route.
   */

   $hasAuthenticated = isset($_GET['state']) && isset($_GET['code']);
   $hasAuthenticationFailure = isset($_GET['error']);

  // The end user will be returned with ?state and ?code values in their request, when successful.
  if ($hasAuthenticated) {
    try {
      $sdk->exchange();
    } catch (\Throwable $th) {
      printf('Unable to complete authentication: %s', $th->getMessage());
      exit;
    }
  }

  // When authentication was unsuccessful, the end user will be returned with an ?error in their request.
  if ($hasAuthenticationFailure) {
    printf('Authentication failure: %s', htmlspecialchars(strip_tags(filter_input(INPUT_GET, 'error'))));
    exit;
  }

  // Nothing to do: redirect to index route.
  header('Location: /lumino/sd.php');

  ?>