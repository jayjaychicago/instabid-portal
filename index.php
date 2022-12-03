<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Import the Composer Autoloader to make the SDK classes accessible:
require 'vendor/autoload.php';

// Load our environment variables from the .env file:
(Dotenv\Dotenv::createImmutable(__DIR__))->load();

// 👆 We're continuing from the steps above. Append this to your index.php file.

// Import our router library:
use Steampixel\Route;

// Define route constants:
define('ROUTE_URL_INDEX', rtrim($_ENV['AUTH0_BASE_URL'], '/'));
define('ROUTE_URL_LOGIN', ROUTE_URL_INDEX . '/login');
define('ROUTE_URL_CALLBACK', ROUTE_URL_INDEX . '/callback');
define('ROUTE_URL_LOGOUT', ROUTE_URL_INDEX . '/logout');

// Now instantiate the Auth0 class with our configuration:
$auth0 = new \Auth0\SDK\Auth0([
    'domain' => $_ENV['AUTH0_DOMAIN'],
    'clientId' => $_ENV['AUTH0_CLIENT_ID'],
    'clientSecret' => $_ENV['AUTH0_CLIENT_SECRET'],
    'cookieSecret' => $_ENV['AUTH0_COOKIE_SECRET']
]);

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


Route::add('/callback', function() use ($auth0) {
    // Have the SDK complete the authentication flow:
    echo $_GET['code'];
    echo " - ";
    echo $_GET['state'];
//    $auth0->exchange("ROUTE_URL_CALLBACK");
    // Finally, redirect our end user back to the / index route, to display their user profile:
    //echo "hello there!";
//    header("Location: " . ROUTE_URL_INDEX);
    exit;
});

Route::add('/logout', function() use ($auth0) {
    // Clear the user's local session with our app, then redirect them to the Auth0 logout endpoint to clear their Auth0 session.
    header("Location: " . $auth0->logout(ROUTE_URL_INDEX));
    exit;
});

Route::run('/');