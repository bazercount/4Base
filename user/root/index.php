<!DOCTYPE html>
<html>
<head>
    <title>root, Nutzerinfo's</title>
</head>
<body>
    <h1>Benutzername anzeigen: root</h1>
    <img src="profil.jpg">profil.jpg</img>
    <p>Geburtsdatum: 1111-11-11</p>
    <p>Bio:
        <?php
            include('../../connex.php');
            $user_id = 76;
                $sql = "SELECT bio FROM benutzer WHERE id = $user_id";
                $result = $conn->query($sql);

     if ($result->num_rows > 0) {
        // Benutzer gefunden, den Benutzernamen auslesen
        $row = $result->fetch_assoc();
        $bio = $row['bio'];
        echo "$bio";
    } else {
        echo "Bio nicht gefunden.";
    }

    $conn->close();
    ?>
    </p>
</body>
</html>