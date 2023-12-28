<?php
session_start();
include "connex.php";

// Überprüfen, ob der Benutzer angemeldet ist
if (!isset($_SESSION['benutzername'])) {
    header("Location: login.html"); // Benutzer nicht angemeldet, zurück zur Anmeldeseite
    exit();
}

$benutzer_id = $_SESSION['benutzer_id'];

// Get the current mission ID of the user
$sql_get_current_mission = "SELECT aktuelle_mission_id FROM benutzer WHERE id = $benutzer_id";
$result_get_current_mission = $conn->query($sql_get_current_mission);

if ($result_get_current_mission->num_rows > 0) {
    $row = $result_get_current_mission->fetch_assoc();
    $aktuelle_mission_id = $row['aktuelle_mission_id'];

    // Check if the user has the selected mission
    if (!empty($aktuelle_mission_id)) {
        $sql_check_user_mission = "SELECT * FROM benutzer WHERE id = $benutzer_id AND aktuelle_mission_id = $aktuelle_mission_id";
        $result_check_user_mission = $conn->query($sql_check_user_mission);

        if ($result_check_user_mission->num_rows > 0) {
            // User has the mission, reward with points and end the mission
            $sql_get_mission_reward = "SELECT * FROM missionen WHERE id = $aktuelle_mission_id";
            $result_get_mission_reward = $conn->query($sql_get_mission_reward);

            if ($result_get_mission_reward->num_rows > 0) {
                $row_mission = $result_get_mission_reward->fetch_assoc();
                $xp_belohnung = $row_mission["xp_belohnung"];
                $max_punkte_belohnung = $row_mission["gold_belohnung"];
                $mission_dauer = $row_mission["dauer"];

                // Calculate the actual point reward with a 15% chance of no reward
                $punkte_belohnung = rand(0, 100) <= 15 ? 0 : rand(0, $max_punkte_belohnung);

                // Get the user's current level and stats
                $sql_get_user_stats = "SELECT level, experience_points, xp_total, missions_total FROM punktesystem WHERE benutzer_id = $benutzer_id";
                $result_get_user_stats = $conn->query($sql_get_user_stats);

                if ($result_get_user_stats->num_rows > 0) {
                    $row_user_stats = $result_get_user_stats->fetch_assoc();
                    $current_level = $row_user_stats['level'];
                    $experience_points = $row_user_stats['experience_points'];
                    $xp_total = $row_user_stats['xp_total'];
                    $missions_total = $row_user_stats['missions_total'];

                    // Calculate experience points required for the next level (modify as needed)
                    $sql_get_level_requirement = "SELECT xp_needed FROM charlevels WHERE char_lvl = $current_level + 1";
                    $result_get_level_requirement = $conn->query($sql_get_level_requirement);

                    if ($result_get_level_requirement->num_rows > 0) {
                        $experience_points_required = $result_get_level_requirement->fetch_assoc()['xp_needed'];

                        // Update xp_total and missions_total
                        $sql_update_stats = "UPDATE punktesystem SET xp_total = xp_total + $xp_belohnung, missions_total = missions_total + 1 WHERE benutzer_id = $benutzer_id";
                        $conn->query($sql_update_stats);

                        // Get the mission start time
                        $sql_get_start_time = "SELECT mission_startzeit FROM punktesystem WHERE benutzer_id = $benutzer_id";
                        $result_get_start_time = $conn->query($sql_get_start_time);

                        if ($result_get_start_time->num_rows > 0) {
                            $startzeit = $result_get_start_time->fetch_assoc()['mission_startzeit'];
                            $aktuelle_zeit = time();
                            $startzeit_timestamp = strtotime($startzeit);

                            // Check if the mission duration has passed
                            if ($aktuelle_zeit - $startzeit_timestamp >= $mission_dauer * 0.1) {
                                // Add points and XP to the point system and end the mission
                                $sql_update_punktesystem = "UPDATE punktesystem SET punkte = punkte + $punkte_belohnung, experience_points = experience_points + $xp_belohnung, mission_startzeit = NULL WHERE benutzer_id = $benutzer_id";
                                if ($conn->query($sql_update_punktesystem) === TRUE) {
                                    // End the mission by setting aktuelle_mission_id to NULL
                                    $sql_end_mission = "UPDATE benutzer SET aktuelle_mission_id = NULL WHERE id = $benutzer_id";
                                    if ($conn->query($sql_end_mission) === TRUE) {
                                        // Level up logic
                                        if ($experience_points + $xp_belohnung >= $experience_points_required) {
                                            // Update the user's level and reset experience points
                                            $sql_update_level = "UPDATE punktesystem SET level = $current_level + 1, experience_points = 0 WHERE benutzer_id = $benutzer_id";
                                            $conn->query($sql_update_level);

                                            echo "Mission erfolgreich beendet! Du hast $punkte_belohnung Punkte und $xp_belohnung Erfahrungspunkte erhalten. Level up! You are now Level " . ($current_level + 1);
                                        } else {
                                            echo "Mission erfolgreich beendet! Du hast $punkte_belohnung Punkte und $xp_belohnung Erfahrungspunkte erhalten.";
                                        }
                                    } else {
                                        echo "Fehler beim Beenden der Mission: " . $conn->error;
                                    }
                                } else {
                                    echo "Fehler beim Hinzufügen der Punkte: " . $conn->error;
                                }
                            } else {
                                echo "<div>Du bist für $mission_dauer Minuten auf Mission gegangen.</div>";
                                echo "<div>Startzeit: $startzeit</div>";
                            }
                        } else {
                            echo "Fehler: Startzeit nicht gefunden.";
                        }
                    } else {
                        echo "Fehler: Benutzerlevel nicht gefunden.";
                    }
                } else {
                    echo "Fehler: Benutzerlevel nicht gefunden.";
                }
            } else {
                echo "Fehler: Mission nicht gefunden.";
            }
        } else {
            echo "Fehler: Du hast diese Mission nicht.";
        }
    } else {
        echo "Du hast noch keine Mission gestartet.";
        header("Location: missions.php");
    }
} else {
    // Keine laufende Mission gefunden
    echo "Keine laufende Mission gefunden.";
}

$conn->close();
?>
