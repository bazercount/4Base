<?php
include('connex.php');
// Auswählen und Anzeigen der Neuigkeiten
$sql = "SELECT headline, content FROM news";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<strong>" . $row["headline"] . "</strong><br>" . $row["content"] . "<br><br>";
    }
} else {
    echo "Keine Neuigkeiten vorhanden";
}

$conn->close();
?>