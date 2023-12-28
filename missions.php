<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verfügbare Missionen</title>
    <style>
        /* Füge hier ggf. dein eigenes CSS hinzu */
    </style>
</head>

<body>

<?php
session_start();
include "connex.php";

// Überprüfen, ob der Benutzer angemeldet ist
if (!isset($_SESSION['benutzername'])) {
    header("Location: login.html"); // Benutzer nicht angemeldet, zurück zur Anmeldeseite
    exit();
}

$benutzer_id = $_SESSION['benutzer_id']; // Hier musst du die Benutzer-ID dynamisch setzen

$sql_running_mission = "SELECT * FROM benutzer WHERE id = $benutzer_id AND aktuelle_mission_id IS NOT NULL";
$result_running_mission = $conn->query($sql_running_mission);

if ($result_running_mission->num_rows > 0) {
    echo "<div>Du bist derzeit noch auf einer Mission!</div>";
    echo '<p>[ <a href="beende_missionen.php">aktuelle Mission abschließen</a> ]</p>';
    header("Location: beende_missionen.php");
} else {
    $sql_available_missions = "SELECT * FROM missionen";
    $result_available_missions = $conn->query($sql_available_missions);

    if ($result_available_missions->num_rows > 0) {
        // Get the user's current level
        $sql_get_user_level = "SELECT level FROM punktesystem WHERE benutzer_id = $benutzer_id";
        $result_get_user_level = $conn->query($sql_get_user_level);

        if ($result_get_user_level->num_rows > 0) {
            $row_user_level = $result_get_user_level->fetch_assoc();
            $current_level = $row_user_level['level'];
        } else {
            $current_level = 1; // Default level if not found
        }

        echo "<h2>Verfügbare Missionen</h2>";
        echo "<div>Aktueller Level: $current_level</div>";
        echo "<form action='starte_mission.php' method='post'>";
        echo "<label for='mission_id'>Wähle eine Mission:</label>";
        echo "<select name='mission_id' id='mission_id'>";
        while ($row = $result_available_missions->fetch_assoc()) {
            echo "<option value='" . $row["id"] . "'>Dauer: " . $row["dauer"] . " Minuten - Belohnung: " . $row["gold_belohnung"] . " Gold</option>";
        }
        echo "</select>";
        echo "<br><br>";
        echo "<input type='submit' value='Mission starten'>";
        echo "</form>";
    } else {
        echo "<p>Keine Missionen gefunden</p>";
    }
}

$conn->close();
?>

</body>

</html>
