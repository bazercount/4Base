<?php
session_start();
include "connexy.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$user_id = $_SESSION['user_id'];
$userInventory = getInventoryItems($user_id);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory</title>
    <style>
        .item {
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px;
            display: inline-block;
        }
    </style>
</head>

<body>
    <h1>Inventory</h1>

    <?php if ($userInventory) : ?>
        <?php foreach ($userInventory as $item) : ?>
            <div class="item">
                <h3><?php echo $item['name']; ?></h3>
                <p>Attack: <?php echo $item['angriffskraft'] ?? 'N/A'; ?></p>
                <p>Magic Power: <?php echo $item['magiestaerke'] ?? 'N/A'; ?></p>
                <!-- Add other stats as needed -->

                <form action="equip_item.php" method="post">
                    <input type="hidden" name="item_id" value="<?php echo $item['inventory_id']; ?>">
                    <button type="submit">Equip</button>
                </form>
                <form action="unequip_item.php" method="post">
                    <input type="hidden" name="item_id" value="<?php echo $item['inventory_id']; ?>">
                    <button type="submit">Unequip</button>
                </form>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p>No items in the inventory.</p>
    <?php endif; ?>

    <!-- Add other functions or actions as needed -->

</body>

</html>
