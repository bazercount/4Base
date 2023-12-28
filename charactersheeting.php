<?php
include "connex.php";

// Assuming you have received the POST data from the form
$userId = $_POST['user_id'];
$selectedAttribute = $_POST['attribute'];

// Validate selected attribute
$allowedAttributes = ['staerke', 'energy', 'vitality', 'geschicklichkeit'];
if (!in_array($selectedAttribute, $allowedAttributes)) {
    die("Invalid attribute selected.");
}

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user has enough available points to spend
$query = "SELECT available_points FROM attribute WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userId);
$stmt->execute();
$stmt->bind_result($availablePoints);
$stmt->fetch();
$stmt->close();

if ($availablePoints < 1) {
    die("Not enough available points to spend.");
}

// Update the selected attribute with spent points
$updateQuery = "UPDATE attribute SET available_points = available_points - 1, $selectedAttribute = $selectedAttribute + 1 WHERE user_id = ?";
$updateStmt = $conn->prepare($updateQuery);
$updateStmt->bind_param("i", $userId);
$updateStmt->execute();
$updateStmt->close();

// Update the corresponding stats based on the selected attribute
$updateStatQuery = "";
if ($selectedAttribute === 'vitality') {
    $updateStatQuery = "UPDATE stats SET health = health + 8, life_steal = life_steal + 1 WHERE benutzer_id = ?";
} elseif ($selectedAttribute === 'energy') {
    // Additional updates for energy attribute (you can customize based on your game mechanics)
    $updateStatQuery = "UPDATE stats 
                        SET mana = mana + 7, 
                            fire_damage = fire_damage + 2, 
                            ice_damage = ice_damage + 2, 
                            lightning_damage = lightning_damage + 2, 
                            poison_damage = poison_damage + 2,
                            mana_regeneration_per_hour = mana_regeneration_per_hour + 1,
                            spell_vamp = spell_vamp + 1
                        WHERE benutzer_id = ?";
} elseif ($selectedAttribute === 'geschicklichkeit') {
    // Additional updates for agility attribute
    $updateStatQuery = "UPDATE stats 
                        SET critical_hit = critical_hit + 5, 
                            attack_speed = attack_speed + 2, 
                            hit_chance = hit_chance + 3 
                        WHERE benutzer_id = ?";
} elseif ($selectedAttribute === 'staerke') {
    // Additional updates for strength attribute
    $updateStatQuery = "UPDATE stats 
                        SET attack = attack + 5, 
                            defense = defense + 5, 
                            armor_penetration = armor_penetration + 2,
                            critical_damage = critical_damage + 1
                        WHERE benutzer_id = ?";
}

if (!empty($updateStatQuery)) {
    $updateStatStmt = $conn->prepare($updateStatQuery);
    $updateStatStmt->bind_param("i", $userId);
    $updateStatStmt->execute();
    $updateStatStmt->close();
}

// Check for success
echo 'Attribute point spent successfully.';
header("Location: charsheet.php"); // Redirect to the character sheet page

// Close the connection
$conn->close();
?>
