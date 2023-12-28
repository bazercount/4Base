<?php
// Database connection parameters
include "connex.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);
var_dump($conn); 
// Fetch attribute values for the user
$user_id = 1; // Replace with the actual user ID
$query = "SELECT * FROM attribute WHERE user_id = ?";
$stmt = $conn->prepare($query);

// Bind the user_id parameter
$stmt->bind_param("i", $user_id);

// Execute the query
$stmt->execute();

// Get the result set
$result = $stmt->get_result();

// Fetch the result as an associative array
$row = $result->fetch_assoc();

// Check if a row was found
if ($row) {
    // Assign values to variables
    $staerke = $row['staerke'];
    $vitality = $row['vitality'];
    $energy = $row['energy'];
    $geschicklichkeit = $row['geschicklichkeit'];
} else {
    // Handle the case where no row is found (user not in the database, etc.)
    echo "No data found for user ID $user_id";
}

// Close the statement
$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- ... (Your existing head content) -->
    <style>
        /* Add some basic styling for better appearance */
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        button {
            padding: 8px;
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <form action="charactersheeting.php" method="post">
        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
        
        <table>
            <tr>
                <th>Attribute</th>
                <th>Current Value</th>
                <th>Action</th>
            </tr>
            <tr>
                <td>Strength</td>
                <td><?php echo $staerke; ?></td>
                <td><button type="submit" name="attribute" value="staerke">Spend 1 Point</button></td>
            </tr>
            <tr>
                <td>Vitality</td>
                <td><?php echo $vitality; ?></td>
                <td><button type="submit" name="attribute" value="vitality">Spend 1 Point</button></td>
            </tr>
            <tr>
                <td>Energy</td>
                <td><?php echo $energy; ?></td>
                <td><button type="submit" name="attribute" value="energy">Spend 1 Point</button></td>
            </tr>
            <tr>
                <td>Geschicklichkeit</td>
                <td><?php echo $geschicklichkeit; ?></td>
                <td><button type="submit" name="attribute" value="geschicklichkeit">Spend 1 Point</button></td>
            </tr>
        </table>
    </form>
</body>
</html>
