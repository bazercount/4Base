<?php
// Starten der Sitzung
session_start();

// Beenden der Sitzung, um den Benutzer abzumelden
session_unset();
session_destroy();

// Weiterleitung zur Anmeldeseite
header("Location: login.html");
exit();
?>
