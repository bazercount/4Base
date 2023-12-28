<?php
session_start();
include('connex.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $benutzername = $_SESSION['benutzername'];
    $user_id = $_SESSION['user_id'];
    $headline = $_POST['headline'];
    $content = $_POST['content'];

    // Einfügen der Neuigkeit in die Datenbank
    $sql = "INSERT INTO news (user_id, headline, content, publication_date) VALUES ('$user_id', '$headline', '$content', NOW())";

    if ($conn->query($sql) === TRUE) {
        echo "Neuigkeit erfolgreich veröffentlicht";

        // Calculate points
        $article_length = strlen($content);
        $points = 20 + (0.25 * $article_length);

        // Update points in the punktesystem table
        $update_points_sql = "INSERT INTO punktesystem (benutzer_id, punkte) VALUES ('$user_id', '$points') ON DUPLICATE KEY UPDATE punkte = punkte + '$points'";
        $conn->query($update_points_sql);
    } else {
        echo "Fehler: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();

header("Location: board.php");
?>