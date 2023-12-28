<?php
session_start();
include "connexy.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['item_id'])) {
    $item_id = $_POST['item_id'];

    // Retrieve the waffen_id based on the inventory_id
    $itemDetails = getInventoryItems($user_id);
    $waffen_id = null;

    foreach ($itemDetails as $item) {
        if ($item['inventory_id'] == $item_id) {
            $waffen_id = $item['waffen_id'];
            break;
        }
    }

    // Now you have $waffen_id, and you can use it as needed
    // Add your logic to equip the item, for example, update the equipped_weapon_id in the database
    $conn = mysqliConnect();
    updateEquippedItem($user_id, $waffen_id, $conn);

    // Add other actions as needed
}
?>
