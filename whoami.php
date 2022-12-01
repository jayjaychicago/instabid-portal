<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

echo "v1";
// Import the Composer Autoloader to make the SDK classes accessible:
require 'vendor/autoload.php';

// Load our environment variables from the .env file:
(Dotenv\Dotenv::createImmutable(__DIR__))->load();

$env_array =getenv();

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
    // header("Location: " . $auth0->login());
    echo "We made it here!";
    exit;
}

// 🎉 At this point we have an authenticated user session accessible from $session; your application logic can continue from here!
echo "Authenticated!";


?>
