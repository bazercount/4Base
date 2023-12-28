<!DOCTYPE html>
<html>
<head>
    <title>root2, Nutzerinfo's</title>
</head>
<body>
    <h1>Benutzername anzeigen: root2</h1>
    <img src="profil.jpg"><br>> <a href="profil.jpg">../profil.jpg</a></img> - 1 2 3 4 5 6 7 8 9 .. <
    <p>Alter: <?php
                include('../../connex.php'); // SQL-Abfrage, um das Geburtsdatum des Benutzers abzurufen
                $user_id = 77;
$sql = "SELECT geburtsdatum FROM benutzer WHERE id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Benutzer gefunden, das Geburtsdatum abrufen
    $row = $result->fetch_assoc();
    $geburtsdatum = $row["geburtsdatum"];

    // Berechne das Alter
    $today = new DateTime('today');
    $diff = date_diff(new DateTime($geburtsdatum), $today);
    $age = $diff->y;

    echo "$age";
} else {
    echo "Benutzer nicht gefunden.";
}
$conn->close();
?>
    <p>Geschlecht: männlich</p>
</p>
    <p>Bio:
        <?php
            include('../../connex.php');
            $user_id = 77;
                $sql = "SELECT bio FROM benutzer WHERE id = $user_id";
                $result = $conn->query($sql);

     if ($result->num_rows > 0) {
        // gefunden, auslesen
        $row = $result->fetch_assoc();
        $bio = $row['bio'];
        echo "$bio";
    } else {
        echo "Bio nicht gefunden.";
    }

    $conn->close();
    ?>
    </p>

    <p>Geburtstag: <?php
        include('../../connex.php'); // SQL-Abfrage, um das Geburtsdatum des Benutzers abzurufen
        $user_id = 77;
$sql = "SELECT DATE_FORMAT(geburtsdatum, '%d.%m.%Y') AS formatted_date FROM benutzer WHERE id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Benutzer gefunden, das formatierte Geburtsdatum abrufen
    $row = $result->fetch_assoc();
    $formatted_birthdate = $row["formatted_date"];

    echo "$formatted_birthdate";
} else {
    echo "Benutzer nicht gefunden.";
}

$conn->close();
?></p>
<p>Link 1<br>
Link 2<br>
Link 3<br>
Link 4<br>
Link 5</p>
</body>
</html>