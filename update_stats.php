<?php
require 'db_config.php';

// Assuming you receive data from the user or another source
// Get user ID from the session
if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
} else {
    echo "User ID not found in session";
    exit;
}

$attack_speed = 200;
$cast_speed = 150;
$mana_regeneration_per_hour = 50;
$mana_leech = 15;

// Update stats in the database
$sql = "UPDATE `stats` SET 
        `attack_speed` = $attack_speed,
        `cast_speed` = $cast_speed,
        `mana_regeneration_per_hour` = $mana_regeneration_per_hour,
        `mana_leech` = $mana_leech
        WHERE `benutzer_id` = $user_id";

if ($conn->query($sql) === TRUE) {
    echo "Stats updated successfully";
} else {
    echo "Error updating stats: " . $conn->error;
}

$conn->close();
?>
