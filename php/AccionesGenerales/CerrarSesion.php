<?php
echo 'cierra sesion';
session_start();
// remove all session variables
session_unset ();
// destroy the session
session_destroy ();

// set the expiration date to one hour ago
setcookie("datos", "", time() - 3600,'/');
?>