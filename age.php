<?php
session_start();

// Verbindung zur MySQL-Datenbank herstellen
include('connex.php');
// Annahme: Benutzer-ID ist bekannt, und wir möchten das Alter des Benutzers mit ID 1 abrufen
$user_id = $_SESSION['user_id'];

// SQL-Abfrage, um das Geburtsdatum des Benutzers abzurufen
$sql = "SELECT geburtsdatum FROM benutzer WHERE id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Benutzer gefunden, das Geburtsdatum abrufen
    $row = $result->fetch_assoc();
    $geburtsdatum = $row["geburtsdatum"];

    // Berechne das Alter
    $today = new DateTime('today');
    $diff = date_diff(new DateTime($geburtsdatum), $today);
    $age = $diff->y;

    echo "Das Alter des Benutzers mit der ID $user_id beträgt $age Jahre.";
} else {
    echo "Benutzer nicht gefunden.";
}

$conn->close();
?>