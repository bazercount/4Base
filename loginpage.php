<?php
// Verbindung zur MySQL-Datenbank herstellen
include('connex.php');

// Benutzerdaten aus dem Formular erhalten
$benutzername = $_POST['benutzername'];
$passwort = md5($_POST['passwort']); // Passwort mit MD5 verschlüsseln

// SQL-Abfrage, um den Benutzer in der Datenbank zu überprüfen
$sql_check_user = "SELECT * FROM benutzer WHERE benutzername = '$benutzername' AND passwort = '$passwort'";
$result_user = $conn->query($sql_check_user);

if ($result_user->num_rows > 0) {
    // Anmeldung erfolgreich
    session_start();

    // Benutzerdaten aus der Datenbank abrufen
    $row = $result_user->fetch_assoc();
    
    // Benutzername und Benutzer-ID in der Session speichern
    $_SESSION['benutzername'] = $row['benutzername'];
    $_SESSION['rechte'] = $row['rolle'];
    $_SESSION['farbe'] = $row['color'];
    $_SESSION['user_id'] = $row['id'];
    $_SESSION['benutzer_id'] = $row['id']; // Hier die Spalte für die Benutzer-ID anpassen
    $_SESSION['aktuelle_mission_id'] = $row['aktuelle_mission_id'];
    
    header("Location: ./user/$benutzername/"); // Weiterleitung zur Dashboard-Seite
} else {
    // Anmeldung fehlgeschlagen
    echo "Anmeldung fehlgeschlagen. Überprüfen Sie Ihre Anmeldeinformationen.";
}

// Verbindung zur Datenbank schließen
$conn->close();
?>