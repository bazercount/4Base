<?php
// Verbindung zur MySQL-Datenbank herstellen
include('connex.php');

// Benutzerdaten aus dem Formular erhalten
$benutzername = $_POST['benutzername'];
$email = $_POST['email'];
$passwort = md5($_POST['passwort']); // Passwort mit MD5 verschlüsseln
$geburtsdatum = $_POST['geburtsdatum'];
$homepage1 = $_POST['homepage1'];
$homepage2 = $_POST['homepage2'];
$homepage3 = $_POST['homepage3'];
$homepage4 = $_POST['homepage4'];
$homepage5 = $_POST['homepage5'];
$bio = $_POST['bio'];

// Überprüfen, ob Benutzername bereits verwendet wird
$sql_check_username = "SELECT * FROM benutzer WHERE benutzername = '$benutzername'";
$result_username = $conn->query($sql_check_username);
if ($result_username->num_rows > 0) {
    die("Benutzername bereits vergeben. Bitte wählen Sie einen anderen Benutzernamen.");
}

// Überprüfen, ob E-Mail-Adresse bereits verwendet wird
$sql_check_email = "SELECT * FROM benutzer WHERE email = '$email'";
$result_email = $conn->query($sql_check_email);
if ($result_email->num_rows > 0) {
    die("Diese E-Mail-Adresse wurde bereits registriert. Bitte verwenden Sie eine andere E-Mail-Adresse.");
}

// SQL-Abfrage, um einen neuen Benutzer in die Datenbank einzufügen
$sql = "INSERT INTO benutzer (benutzername, email, passwort, geburtsdatum, homepage1, homepage2, homepage3, homepage4, homepage5, bio)
        VALUES ('$benutzername', '$email', '$passwort', '$geburtsdatum', '$homepage1', '$homepage2', '$homepage3', '$homepage4', '$homepage5', '$bio')";

if ($conn->query($sql) === TRUE) {
    echo "Registrierung erfolgreich!";
}
else {
    echo "Fehler bei der Registrierung: " . $conn->error;
}

    // Erstelle einen Benutzerordner
    $user_folder = "user/$benutzername";
    if (!file_exists($user_folder)) {
        mkdir($user_folder, 0755, true);

        // Erstelle eine index.php Datei im Benutzerordner
        // Hole die ID des zuletzt eingefügten Benutzers
        $user_id = $conn->insert_id;

        // Erstelle eine index.php Datei im Benutzerordner und schreibe die ID hinein
        $user_info_file = "$user_folder/index.php";
        $user_info_content = <<<EOT
        <!DOCTYPE html>
        <html>
        <head>
            <title>$benutzername, Nutzerinfo's</title>
        </head>
        <body>
            <h1>Benutzername anzeigen: $benutzername</h1>
            <img src="profil.jpg"><br><a href="profil.jpg">../profil.jpg</a></img>
            <p>Geburtsdatum:</p>
            <p>Alter: 32</p>
            <p>Geschlecht: 32</p>
            <p>Bio:
                <?php
                    include('../../connex.php');
                    \$user_id = $user_id;
                        \$sql = "SELECT bio FROM benutzer WHERE id = \$user_id";
                        \$result = \$conn->query(\$sql);
        
             if (\$result->num_rows > 0) {
                // gefunden, auslesen
                \$row = \$result->fetch_assoc();
                \$bio = \$row['bio'];
                echo "\$bio";
            } else {
                echo "Bio nicht gefunden.";
            }

            \$conn->close();
            ?>
            </p>
        </body>
        </html>
        EOT;

        file_put_contents($user_info_file, $user_info_content);

        echo "Benutzerordner und User-Info-Datei erstellt.";
    } else {
        echo "Benutzerordner existiert bereits.";
    } 
// Überprüfen, ob eine Datei hochgeladen wurde
if (!isset($_FILES['profilbild'])) {
    die("Bitte laden Sie ein Profilbild hoch.");
}
$uploadDir = "user/$benutzername/"; // Verzeichnis, in dem das Bild gespeichert wird
$uploadFile = $uploadDir . "profil.jpg"; // Festen Namen zuweisen

$imageFileType = strtolower(pathinfo($_FILES['profilbild']['name'], PATHINFO_EXTENSION)); // Dateityp des hochgeladenen Bildes überprüfen
if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "gif") {
    die("Bitte verwende JPG, JPEG, PNG oder GIF-Dateien.");
}

// Datei auf den Server hochladen (nur wenn es sich um ein Bild handelt)
if (move_uploaded_file($_FILES['profilbild']['tmp_name'], $uploadFile)) {
    echo "Profilbild wurde erfolgreich hochgeladen.";
} else {
    die("Fehler beim Hochladen des Profilbildes.");
}
    // Fortsetzung der Registrierung hier
    // Füge die restlichen Registrierungsdaten in die Datenbank ein
    // ...

// Verbindung zur Datenbank schließen
$conn->close();
?>
