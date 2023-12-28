<?php
// Starten der Sitzung
session_start();

// Überprüfen, ob der Benutzer angemeldet ist
if (!isset($_SESSION['benutzername'])) {
    header("Location: login.html"); // Benutzer nicht angemeldet, zurück zur Anmeldeseite
    exit();
}

// Benutzer ist angemeldet, Willkommensnachricht anzeigen
$benutzername = $_SESSION['benutzername'];
$user_id = $_SESSION['user_id'];
$rechte = $_SESSION['rechte'];


// Verbindung zur MySQL-Datenbank herstellen
include('connex.php');

// Fetch user's points
$sql = "SELECT punkte FROM punktesystem WHERE benutzer_id = (SELECT id FROM benutzer WHERE benutzername = '$benutzername')";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $currentPoints = $row['punkte'];

    // Check if the user has enough points
    $uploadCost = 5000;
    if ($currentPoints >= $uploadCost) {
        // User has enough points, proceed with the file upload

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['profilbild']) && $_FILES['profilbild']['error'] === UPLOAD_ERR_OK) {
    $uploadDirectory = "user/$benutzername/"; // Directory specific to each user

    if (!is_dir($uploadDirectory)) {
        // If the directory doesn't exist, create it
        mkdir($uploadDirectory, 0777, true);
    }

    $targetFile = $uploadDirectory . "profil.jpg"; // basename($_FILES['profilbild']['name']); // voller Name

    $imageFileType = strtolower(pathinfo($_FILES['profilbild']['name'], PATHINFO_EXTENSION)); // Dateityp des hochgeladenen Bildes überprüfen
    if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "gif") {
        die("Bitte verwende JPG, JPEG, PNG oder GIF-Dateien.");
    }

    if (move_uploaded_file($_FILES['profilbild']['tmp_name'], $targetFile)) {
        //echo "Das Bild wurde erfolgreich hochgeladen.";
         // Update user's points in the database
         $newPoints = $currentPoints - $uploadCost;
         $updateSql = "UPDATE punktesystem SET punkte = $newPoints WHERE benutzer_id = (SELECT id FROM benutzer WHERE benutzername = '$benutzername')";
         $conn->query($updateSql);

         echo "Das Bild wurde erfolgreich hochgeladen. Du hast nun $newPoints Punkte.";
     } else {
         echo "Es gab ein Problem beim Hochladen des Bildes.";
     }
 }
} else {
    $pointsleft = -$currentPoints + $uploadCost;
 echo "Du besitzt $currentPoints Münzen und musst noch $pointsleft weitere Münzen sammeln um dein Profilbild ändern zu können. ";
}
} else {
echo "Benutzer nicht gefunden.";
}

$conn->close();

        // You might want to save $targetFile into a database associated with the user for later retrieval
?>
