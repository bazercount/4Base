<?php

// Database configuration
include "connex.php";


// Function to get weapon details by ID
function getWeaponDetails($weaponId, $conn) {
    $weaponId = intval($weaponId); // Convert to integer to prevent SQL injection

    // Query to select weapon details by ID
    $sql = "SELECT * FROM waffen WHERE id = $weaponId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        $row = $result->fetch_assoc();
        return $row;
    } else {
        return null;
    }
}

// Example: Get details for weapon with ID from link (inventory.php)
$weaponIdToGet = $_GET['weapon_id'];
$weaponDetails = getWeaponDetails($weaponIdToGet, $conn);

// Close the database connection
$conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weapon Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Weapon Details for ID <?php echo $weaponIdToGet; ?></h1>

    <?php if ($weaponDetails): ?>
        <table>
            <tr>
                <th>Attribute</th>
                <th>Value</th>
            </tr>
            <?php foreach ($weaponDetails as $attribute => $value): ?>
                <?php if ($value !== null): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($attribute); ?></td>
                        <td><?php echo htmlspecialchars($value); ?></td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>Weapon with ID <?php echo $weaponIdToGet; ?> not found.</p>
    <?php endif; ?>
</div>

</body>
</html>
