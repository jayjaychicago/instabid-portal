
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
  /**
   * Clear application session and redirect to the Auth0 logout endpoint.
   *
   * The user will be redirected to your index route afterward.
   */

  header(sprintf('Location: %s', $sdk->logout()));

  ?>