<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guestbook Entries</title>
</head>
<body>

<h2>Guestbook Entries</h2>

<?php
// Database connection
include 'connex.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve guestbook entries with usernames and colors
$query = "SELECT g.*, b.benutzername, b.color 
          FROM gaestebuch g
          JOIN benutzer b ON g.benutzer_id = b.id";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Apply the user's color to the text
        echo "<div style='color: #" . $row["color"] . "'>";
        echo "<p><strong>User:</strong> " . $row["benutzername"] . "</p>";
        echo "<p><strong>Entry:</strong> " . $row["eintrag"] . "</p>";
        echo "<p><strong>Date:</strong> " . $row["datum"] . "</p>";
        echo "</div>";
        echo "<hr>";
    }
} else {
    echo "<p>No entries found.</p>";
}

// Close database connection
$conn->close();
?>

</body>
</html>