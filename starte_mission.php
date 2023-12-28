<?php
session_start();
include "connex.php";

$benutzer_id = $_SESSION['benutzer_id']; // Hier musst du die Benutzer-ID dynamisch setzen
$mission_id = $_POST['mission_id'];

// Überprüfe, ob der Benutzer bereits eine laufende Mission hat
$sql_running_mission = "SELECT * FROM benutzer WHERE id = $benutzer_id AND aktuelle_mission_id IS NOT NULL";
$result_running_mission = $conn->query($sql_running_mission);

if ($result_running_mission->num_rows > 0) {
    echo "Du hast bereits eine Mission gestartet.";
    //$_SESSION['aktuelle_mission_id'] = $row['aktuelle_mission_id']; 
    
} else {
    // Aktualisiere die Benutzer-Tabelle mit der ausgewählten Mission
    $current_time = date("Y-m-d H:i:s"); // Aktuelle Zeit im MySQL-Datumsformat
    
    // Füge den Startzeitpunkt zur Tabelle punktesystem hinzu
    $sql_update_punktesystem = "UPDATE punktesystem SET mission_startzeit = '$current_time' WHERE benutzer_id = $benutzer_id";
    $conn->query($sql_update_punktesystem);
    
    // Aktualisiere die Benutzer-Tabelle mit der ausgewählten Mission
    $sql_update_user = "UPDATE benutzer SET aktuelle_mission_id = $mission_id WHERE id = $benutzer_id";
    
    if ($conn->query($sql_update_user) === TRUE) {
        // echo "Mission gestartet!";
        header("Location: missions.php"); 
    } else {
        echo "Fehler beim Starten der Mission: " . $conn->error;
    }
}

$conn->close();
?>
