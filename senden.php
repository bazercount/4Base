<?php
session_start();

// Überprüfen, ob der Benutzer angemeldet ist
if (!isset($_SESSION['benutzername'])) {
    header("Location: login.html");
    exit();
}

// Fehlercodes anzeigen
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Verbindung zur Datenbank herstellen
include('connex.php');

// Benutzerdaten aus dem Formular erhalten
$empfaenger = $_POST['empfaenger'];
$nachricht = $_POST['nachricht'];
$absender_id = $_SESSION['user_id'];

// Empfänger-ID abrufen
$sql_empfaenger_id = "SELECT id FROM benutzer WHERE benutzername = '$empfaenger'";
$result_empfaenger_id = $conn->query($sql_empfaenger_id);

if ($result_empfaenger_id->num_rows > 0) {
    $row = $result_empfaenger_id->fetch_assoc();
    $empfaenger_id = $row['id'];

// Nachricht in die Datenbank einfügen
$sql_insert_nachricht = "INSERT INTO nachrichten (id, absender_id, empfaenger_id, nachricht) VALUES (NULL, '$absender_id', '$empfaenger_id', '$nachricht')";
$conn->query($sql_insert_nachricht);

    echo '<font face="Verdana">Deine Nachricht wurde verschickt ;)';

        // Aktualisieren Sie das Punktesystem für den Benutzer
        $punkte = 25 + (strlen($nachricht) * 0.25);
        $insertPunkte = "INSERT INTO `punktesystem` (`benutzer_id`, `punkte`) VALUES ('$absender_id', '$punkte') 
                        ON DUPLICATE KEY UPDATE `punkte` = `punkte` + '$punkte'";
        
        if ($conn->query($insertPunkte) === TRUE) {
            echo "<p>..  du hast $punkte Punkte erhalten!</font></p>";  
        }

        else {
            echo "<p>.. Fehler beim Aktualisieren der Punkte:</font></p>" . $conn->error;
        }
    }
        else {
            echo "<div>Empfänger wurde nicht gefunden. Benutzernamen überprüfen!</font></div>";
    }

    // Verbindung zur Datenbank schließen
    $conn->close();
?>