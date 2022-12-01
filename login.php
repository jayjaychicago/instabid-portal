<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "v1";
// Import the Composer Autoloader to make the SDK classes accessible:
require 'vendor/autoload.php';

// Load our environment variables from the .env file:
(Dotenv\Dotenv::createImmutable(__DIR__))->load();

// can't be bothered trying to figure out aws php env variables so hardcoding them here. TODO: FIGURE THIS OUT
# The URL of our Auth0 Tenant Domain.
# If we're using a Custom Domain, be sure to set this to that value instead.
$_ENV['AUTH0_DOMAIN']='https://dev-4lodh4ux8xq4milm.us.auth0.com'

# Our Auth0 application's Client ID.
$_ENV['AUTH0_CLIENT_ID']='u9DKrKOTgaiFu76SkPn4u7VHPpV5xZCw'

# Our Auth0 application's Client Secret.
$_ENV['AUTH0_CLIENT_SECRET']='T4ywxzfVC34VK4SUKghb-Ss53p24iU43AaWhQYMpsSl0iflKhAvnBnMqGBS7gXtT'

# A long secret value we'll use to encrypt session cookies. This can be generated using `openssl rand -hex 32` from our shell.
$_ENV['AUTH0_COOKIE_SECRET']='9c04c9cccd5f7bdc4e5b7ba41cf8d53528db5704e051d89bd3e3379e0ab83c2c'

# The base URL of our application.
$_ENV['AUTH0_BASE_URL']='http://127.0.0.1:3000'


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
]); */

// 👆 We're continuing from the steps above. Append this to your index.php file.

// Import our router library:
use Steampixel\Route;

// Define route constants:
define('ROUTE_URL_INDEX', rtrim('https://portal.instabid.io', '/'));
define('ROUTE_URL_LOGIN', ROUTE_URL_INDEX . '/login');
define('ROUTE_URL_CALLBACK', ROUTE_URL_INDEX . '/callback');
define('ROUTE_URL_LOGOUT', ROUTE_URL_INDEX . '/logout');

// 👆 We're continuing from the steps above. Append this to your index.php file.

Route::add('/', function() use ($auth0) {
    $session = $auth0->getCredentials();
  
    if ($session === null) {
      // The user isn't logged in.
      echo '<p>Please <a href="/login">log in</a>.</p>';
      return;
    }
  
    // The user is logged in.
    echo '<pre>';
    print_r($session->user);
    echo '</pre>';
  
    echo '<p>You can now <a href="/logout">log out</a>.</p>';
  });

  // 👆 We're continuing from the steps above. Append this to your index.php file.

Route::add('/login', function() use ($auth0) {
    // It's a good idea to reset user sessions each time they go to login to avoid "invalid state" errors, should they hit network issues or other problems that interrupt a previous login process:
    $auth0->clear();

    // Finally, set up the local application session, and redirect the user to the Auth0 Universal Login Page to authenticate.
    header("Location: " . $auth0->login(ROUTE_URL_CALLBACK));
    exit;
});

// 👆 We're continuing from the steps above. Append this to your index.php file.

Route::add('/callback', function() use ($auth0) {
    // Have the SDK complete the authentication flow:
    $auth0->exchange(ROUTE_URL_CALLBACK);

    // Finally, redirect our end user back to the / index route, to display their user profile:
    header("Location: " . ROUTE_URL_INDEX);
    exit;
});

// 👆 We're continuing from the steps above. Append this to your index.php file.

Route::add('/logout', function() use ($auth0) {
    // Clear the user's local session with our app, then redirect them to the Auth0 logout endpoint to clear their Auth0 session.
    header("Location: " . $auth0->logout(ROUTE_URL_INDEX));
    exit;
});

Route::run('/');


// 👆 We're continuing from the "getting started" guide linked in "Prerequisites" above. Append this to the index.php file you created there.

// getExchangeParameters() can be used on your callback URL to verify all the necessary parameters are present for post-authentication code exchange.
if ($auth0->getExchangeParameters()) {
    // If they're present, we should perform the code exchange.
    $auth0->exchange();
}

// Check if the user is logged in already
$session = $auth0->getCredentials();

if ($session === null) {
    // User is not logged in!
    // Redirect to the Universal Login Page for authentication.
    header("Location: " . $auth0->login());
    exit;
}

// 🎉 At this point we have an authenticated user session accessible from $session; your application logic can continue from here!
echo "Authenticated!";


?>
