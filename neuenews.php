<?php
$nutzername = 'nutzername';
$passwort = 'pw';

if ($_SERVER['PHP_AUTH_USER'] != $nutzername || $_SERVER['PHP_AUTH_PW'] != $passwort) {
    header('WWW-Authenticate: Basic realm="Authentifizierung erforderlich"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Authentifizierung erforderlich';
    exit;
}
?>

<?php
session_start();

if (!isset($_SESSION['benutzername'])) {
    header("Location: login.html");
    exit();
}

$benutzername = $_SESSION['benutzername'];
?>

<html lang="">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <h1>Neuigkeiten</h1>
    
    <form action="submit_news.php" method="post">
        <label for="headline">Überschrift:</label><br>
        <input type="text" id="headline" name="headline"><br>
        
        <label for="content">Inhalt:</label><br>
        <textarea id="content" name="content"></textarea><br>
        
        <input type="submit" value="Veröffentlichen">
    </form>
    
    <div>
        <h2>Aktuelle Neuigkeiten</h2>
        <?php include 'display_news.php'; ?>
    </div>
</body>
</html>
