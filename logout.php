
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require('vendor/autoload.php');

use Auth0\SDK\Auth0;
use Auth0\SDK\Configuration\SdkConfiguration;

$configuration = new SdkConfiguration(
  domain: $_ENV['AUTH0_DOMAIN'],
  clientId: $_ENV['AUTH0_CLIENT_ID'],
  clientSecret: $_ENV['AUTH0_CLIENT_SECRET'],
  redirectUri: 'https://instabid.io',
  cookieSecret: '9c04c9cccd5f7bdc4e5b7ba41cf8d53528db5704e051d89bd3e3379e0ab83c2c'
);

$sdk = new Auth0($configuration);
  /**
   * Clear application session and redirect to the Auth0 logout endpoint.
   *
   * The user will be redirected to your index route afterward.
   */

  header(sprintf('Location: %s', $sdk->logout()));

  ?>