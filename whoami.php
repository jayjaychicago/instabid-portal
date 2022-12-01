<?php
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
