<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'vendor/autoload.php';

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
