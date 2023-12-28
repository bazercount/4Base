<?php
// Starten der Sitzung
session_start();

include 'connex.php';

// Überprüfen, ob der Benutzer angemeldet ist
if (!isset($_SESSION['benutzername'])) {
    header("Location: login.html"); // Benutzer nicht angemeldet, zurück zur Anmeldeseite
    exit();
}

// Benutzer ist angemeldet, Willkommensnachricht anzeigen
$benutzername = $_SESSION['benutzername'];
$benutzer_id = $_SESSION['benutzer_id'];
$rechte = $_SESSION['rechte'];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $eintrag = $_POST["eintrag"];

    // Hier könntest du zusätzliche Validierung durchführen

    $sql = "INSERT INTO gaestebuch (benutzer_id, eintrag, datum) VALUES ('$benutzer_id', '$eintrag', NOW())";

    if ($conn->query($sql) === TRUE) {
        echo "Eintrag erfolgreich hinzugefügt.";
                // Calculate points
                $article_length = strlen($eintrag);
                $points = 5000 + (0.25 * $article_length);
        
                // Update points in the punktesystem table
                $update_points_sql = "INSERT INTO punktesystem (benutzer_id, punkte) VALUES ('$benutzer_id', '$points') ON DUPLICATE KEY UPDATE punkte = punkte + '$points'";
                $conn->query($update_points_sql);
            } else {
                echo "Fehler: " . $sql . "<br>" . $conn->error;
            }
    } else {
        echo "Fehler beim Hinzufügen des Eintrags: " . $conn->error;
    }


$conn->close();
?>
