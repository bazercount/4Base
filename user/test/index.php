<!DOCTYPE html>
<html>
<head>
    <title>test, Nutzerinfo's</title>
</head>
<body>
    <h1>Benutzername anzeigen: test</h1>
    <img src="profil.jpg"><br><a href="profil.jpg">../profil.jpg</a></img>
    <p>Geburtsdatum:</p>
    <p>Alter: 32</p>
    <p>Geschlecht: 32</p>
    <p>Bio:
        <?php
            include('../../connex.php');
            $user_id = 78;
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
</body>
</html>