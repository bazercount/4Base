<?php
session_start();
include "connex.php";
include "connexy.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$user_id = $_SESSION['user_id'];

// Check if the request is a POST request and if the inventory_id is set
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['inventory_id'])) {
    $inventory_id = $_POST['inventory_id'];

    // Retrieve waffen_id from the inventar table using the inventory_id
    $waffen_id = getWaffenIdFromInventory($user_id, $inventory_id, $conn);

    // Check if the waffen_id is valid
    if ($waffen_id !== false) {
        // Here you should implement logic to check if the user can unequip this item
        // Example: Check if the item is currently equipped by the user, or any other criteria

        // Example function for updating unequipped item in the database
        updateUnequippedItem($user_id, $waffen_id, $conn);
    }
}

// Redirect the user back to the inventory page
header("Location: inventar.php");
exit();
?>
