<?php
// Starten der Sitzung
session_start();

// Überprüfen, ob der Benutzer angemeldet ist
if (!isset($_SESSION['benutzername'])) {
    header("Location: login.html"); // Benutzer nicht angemeldet, zurück zur Anmeldeseite
    exit();
}

// Benutzer ist angemeldet, Willkommensnachricht anzeigen
$benutzername = $_SESSION['benutzername'];
$user_id = $_SESSION['user_id'];
$farbe = $_SESSION['farbe'];
$rechte = $_SESSION['rechte'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Benutzer-Dashboard</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div>
    <h1>Willkommen im Benutzer-Dashboard, <a href="./user/<?php echo $benutzername; ?>"><font color="<?php echo $farbe; ?>"><?php echo $benutzername; ?></font></a>!</h1>
    <p>Hier können Sie Ihre persönlichen Informationen und Aktivitäten verwalten.</p>
    <form action="upload.php" method="post" enctype="multipart/form-data">
    <label for="profilbild">Profilbild hochladen:</label>
    <input type="file" name="profilbild" id="profilbild">

        <input type="submit" value="hochladen">
</form>
<a href="logout.php">Abmelden</a>
<?php 
// Annahme: Sie haben bereits eine Session gestartet, bevor Sie diesen Code ausführen.

// Überprüfen Sie, ob der Benutzer angemeldet ist und die Rolle "admin" hat.
if(isset($_SESSION['benutzername']) && isset($_SESSION['rechte']) && $_SESSION['rechte'] == 'admin') {
    // Hier können Sie den Code für den speziellen Bereich einfügen, den nur Admins sehen sollen. Für Mitarbeiter: || $_SESSION['rechte'] == 'mitarbeiter'
    echo "/ Willkommen im Admin-Bereich!";
    include('neuenews.php');
} else {
    // Falls der Benutzer nicht angemeldet ist oder nicht die Rolle "admin" hat, können Sie eine Weiterleitung oder eine Fehlermeldung anzeigen.
    echo "<h2>Aktuelle Neuigkeiten</h2>";
    include 'display_news.php';
}
 ?></p>
  <p> <?php include 'nachrichtenform.php'; ?> </p>
  <p> <?php include 'nachrichten.php'; ?> </p>
  <p> <?php include 'gaestebuch_schreiben.php'; ?> </p>
  <p> <?php include 'gaestebucheintraege.php'; ?> </p>
  <?php
            //session_start(); // Session starten (wichtig: vor jedem Zugriff auf $_SESSION)
            $benutzername = $_SESSION['benutzername'];
//$user_id = $_SESSION['user_id'];
//$rechte = $_SESSION['rechte'];

// Überprüfen, ob der Benutzer angemeldet ist
if(isset($_SESSION['benutzername'])) {
// Benutzer ist angemeldet, zeige z.B. Willkommensnachricht und Logout-Link
echo '[ <a href="../../logoutpage.php">Abmelden</a> ]';
} else {
// Benutzer ist nicht angemeldet, zeige Login-Link
echo '[ <a href="../../loginpage.html">Anmelden</a> ]';
}
?>
</div>
</body>
</html>