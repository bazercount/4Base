<?php
require 'connex.php';

// Get user ID from the session
if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
} else {
    echo "User ID not found in session";
    exit;
}

// Retrieve user stats from the database
$sql = "SELECT * FROM `stats` WHERE `benutzer_id` = $user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        // Process the data or return it as needed
        echo json_encode($row);
    }
} else {
    echo "User stats not found";
}

$conn->close();
?>
