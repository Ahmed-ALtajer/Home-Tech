<?php
if (!session_id()) {
    ini_set('session.use_only_cookies', 1);
    ini_set('session.use_strict_mode', 1);
    session_set_cookie_params([
        'lifetime' => 1800,
        'path' => '/',
        'secure' => true,
        'httponly' => true,
        'samesite' => 'Strict'
    ]);

    session_start();
}
?>
