<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "v1";
// Import the Composer Autoloader to make the SDK classes accessible:
require 'vendor/autoload.php';

// Load our environment variables from the .env file:
(Dotenv\Dotenv::createImmutable(__DIR__))->load();

/*
echo "<h3>The list of environment variables with values are :</h3>";
//Print all environment variable names with values
foreach ($env_array as $key=>$value)
{
    echo "$key => $value <br />";
}
*/
// This is all setup in AWS ELB at: https://us-east-2.console.aws.amazon.com/elasticbeanstalk/home?region=us-east-2#/environment/configuration?applicationName=Instabid&environmentId=e-e2vtbrvebm
// In the "software" config portion of the ELB


$auth0 = new \Auth0\SDK\Auth0([
  'domain' => $_ENV['AUTH0_DOMAIN'],
  'clientId' => $_ENV['AUTH0_CLIENT_ID'],
  'clientSecret' => $_ENV['AUTH0_CLIENT_SECRET'],
  'cookieSecret' => $_ENV['AUTH0_COOKIE_SECRET'],
    'redirectUri' => 'https://portal.instabid.io/lumino/sd.php'
]); 

// 👆 We're continuing from the steps above. Append this to your index.php file.

// Import our router library:
use Steampixel\Route;

// Define route constants:
define('ROUTE_URL_INDEX', rtrim($_ENV['AUTH0_BASE_URL'], '/'));
define('ROUTE_URL_LOGIN', ROUTE_URL_INDEX . '/login');
define('ROUTE_URL_CALLBACK', ROUTE_URL_INDEX . '/callback');
define('ROUTE_URL_LOGOUT', ROUTE_URL_INDEX . '/logout');

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

// ✋ We don't need to include this in our sample application, it's just an example.
$name = $session->user['name'] ?? $session->user['nickname'] ?? $session->user['email'] ?? 'Unknown';
echo $session;

printf(
    '<h1>Hi %s!</h1>
    <p><img width="100" src="/docs/%s"></p>
    <p><strong>Last update:</strong> %s</p>
    <p><strong>Contact:</strong> %s %s</p>
    <p><a href="/docs/logout.php">Logout</a></p>',
    isset($session->user['nickname']) ? strip_tags($session->user['nickname']) : '[unknown]',
    isset($session->user['picture']) ? filter_var($session->user['picture'], FILTER_SANITIZE_URL) : 'https://gravatar.com/avatar/',
    isset($session->user['updated_at']) ? date('j/m/Y', strtotime($session->user['updated_at'])) : '[unknown]',
    isset($session->user['email']) ? filter_var($session->user['email'], FILTER_SANITIZE_EMAIL) : '[unknown]',
    ! empty($session->user['email_verified']) ? '✓' : '✗'
);

?>
