<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// MySQLi database connection function
function mysqliConnect() {
    $servername = "localhost";
    $username = "root";
    $password = "****";
    $dbname = "dibadudb";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

// Assume you have a function to retrieve user's inventory items from the database
// Assume you have a function to retrieve user's inventory items from the database
function getInventoryItems($user_id) {
    $conn = mysqliConnect();
    $stmt = $conn->prepare("SELECT w.*, i.id as inventory_id, i.waffen_id FROM inventar i JOIN waffen w ON i.waffen_id = w.id WHERE i.benutzer_id = ?");
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}



// Function to update the equipped item in the database
//function updateEquippedItem($user_id, $waffen_id, $conn) {
 //   $stmt = $conn->prepare("UPDATE benutzer SET equipped_weapon_id = ? WHERE id = ?");
  //  $stmt->bind_param("ii", $waffen_id, $user_id);

    //if (!$stmt->execute()) {
        // Handle the error, e.g., log it or display a user-friendly message
      //  die("Error: Unable to update equipped item.");
    //}
//}




function updateEquippedItem($user_id, $waffen_id, $conn) {
    // Update the equipped_weapon_id in the benutzer table
    $stmt = $conn->prepare("UPDATE benutzer SET equipped_weapon_id = ? WHERE id = ?");
    $stmt->bind_param("ii", $waffen_id, $user_id);
    $stmt->execute();

    // Get weapon details
    $weaponDetails = getWeaponDetails($waffen_id);

    // Update stats table with equipped weapon attributes
    updateStatsWithEquippedWeapon($user_id, $weaponDetails, $conn);
}

function getWeaponDetails($waffen_id) {
    $conn = mysqliConnect();
    $stmt = $conn->prepare("SELECT * FROM waffen WHERE id = ?");
    $stmt->bind_param('i', $waffen_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

function updateStatsWithEquippedWeapon($user_id, $weaponDetails, $conn) {
    $stmt = $conn->prepare("UPDATE stats SET equipped_weapon_id = ?, attack = ?, magic_power = ?, life_steal = ?, critical_hit = ? WHERE benutzer_id = ?");
    $stmt->bind_param("iiiiii", $weaponDetails['id'], $weaponDetails['angriffskraft'], $weaponDetails['magiestaerke'], $weaponDetails['lebensraub'], $weaponDetails['kritischer_treffer'], $user_id);
    $stmt->execute();
}


// Your existing code...

?>
