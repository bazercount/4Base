<!DOCTYPE html>
<html>
    <head>
        <title>CouNTiNG, Nutzerinfo's</title>
        <link rel="stylesheet" type="text/css" href="../../style.css">
    </head>
    <body><div>
        <h1>Hallo, das hier ist CouNTiNG's Nickpage ;)</h1>
        <table valign="top" cellspacing="0" cellpadding="0" border="0" style="width: 100%;">
            <tr>
                <td valign="top" style="display: inline-block; padding: 5px;">
                    [ chat ] . [ <a href="../../board.php" target="_blank">user</a> ] . [ area ] . [ news ]<br>
                    <?php
                    include '../../connex.php';
                    session_start(); // Session starten (wichtig: vor jedem Zugriff auf $_SESSION)
                    
                    // Überprüfen, ob der Benutzer angemeldet ist
                    if(isset($_SESSION['benutzername'])) {
                        // Benutzer ist angemeldet, zeige z.B. Willkommensnachricht und Logout-Link
                        echo '[ <font color="#00FF00"><u>online</u></font> ] . ';
                        echo '[ <a href="../../logoutpage.php">Abmelden</a> ]';
                    } else {
                        // Benutzer ist nicht angemeldet, zeige Login-Link
                        echo '[ <a href="../../loginpage.html">Anmelden</a> ]';
                    }
                    ?>
</br>
&nbsp;._______________________________. <br>
<i><u>Steckbrief</u>:</i>
<p align="center">
    Name/Spitzname: <b>Alex</b><br>
    <br>Geschlecht: <b>männlich</b>
    <br><i>Geburtstag: <?php
        include('../../connex.php'); // Geburtstagsformat
        $sql = "SELECT DATE_FORMAT(geburtsdatum, '%d.%m.%Y') AS formatted_date FROM benutzer WHERE id = 1";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $formatted_birthdate = $row["formatted_date"];
            echo "$formatted_birthdate";
        } else {
            echo "Datum nicht gefunden.";
        }
        $conn->close();
        ?></i><br><br>
<br>Alter: <?php

// Verbindung zur MySQL-Datenbank herstellen
include('../../connex.php');
// Annahme: Benutzer-ID ist bekannt, und wir möchten das Alter des Benutzers mit ID 1 abrufen
$user_id = 1; //$_SESSION['user_id'];

// SQL-Abfrage, um das Geburtsdatum des Benutzers abzurufen
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
    echo "$age Jahre.";
} else {
    echo "Das Alter des Benutzers konnte nicht übermittelt werden.";
}

$conn->close();
?>
 <br><i>Wohnraum: <b>Salzburg City</b></i><br>
 <br></p>
 <i>- hat
     <?php
      include('../../connex.php');
      $sql = "SELECT chattime FROM benutzer WHERE id = 1";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();
        $chattime = $row['chattime'];
        echo "$chattime Sekunden im Chat verbracht";
    } else {
        echo "Freunde nicht gefunden.";
    }
    $conn->close();
    ?></i>
    <br>
<i>- hat <?php
      include('../../connex.php');
       $sql = "SELECT punkte FROM punktesystem WHERE benutzer_id = 1";
         $result = $conn->query($sql);
     if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $punkte = $row['punkte'];
        echo "$punkte Punkte in Besitz";
    } else {
        echo "noch keine Punkte";
    }
    $conn->close();
    ?></i><br>
 </br>
&nbsp; - - - - - - - - - - - - - - - - - - - - - - - - - -
<br><br><u>Freundesliste</u>:<br><br>
<?php
      include('../../connex.php');
       $sql = "SELECT friends FROM benutzer WHERE id = 1";
         $result = $conn->query($sql);

     if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $friends = $row['friends'];
        echo "$friends";
    } else {
        echo "Freunde nicht gefunden.";
    }

    $conn->close();
    ?><br>
<br>------------------------------------------------<br><b><u>Über mich</b></u>:<p>
<?php
      include('../../connex.php');
       $sql = "SELECT bio FROM benutzer WHERE id = 1";
         $result = $conn->query($sql);

     if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $bio = $row['bio'];
        echo "$bio";
    } else {
        echo "Bio nicht gefunden.";
    }

    $conn->close();
    ?>
    </p>
<p>Link 1:
<a href="http://<?php include('../../connex.php');
                $sql = "SELECT homepage1 FROM benutzer WHERE id = 1";
                $result = $conn->query($sql);
     if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $homepage1 = $row['homepage1'];
        echo "$homepage1";
    } else {
        echo "Link nicht gefunden.";
    }
    $conn->close();
    ?>"><?php
    include('../../connex.php');
        $sql = "SELECT homepage1 FROM benutzer WHERE id = 1";
        $result = $conn->query($sql);
if ($result->num_rows > 0) {
$row = $result->fetch_assoc();
$homepage1 = $row['homepage1'];
echo "$homepage1";
} else {
echo "Link nicht gefunden.";
}
$conn->close();
?></a>
<br>Link 2:
<a href="http://<?php include('../../connex.php');
                $sql = "SELECT homepage2 FROM benutzer WHERE id = 1";
                $result = $conn->query($sql);
     if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $homepage2 = $row['homepage2'];
        echo "$homepage2";
    } else {
        echo "Link nicht gefunden.";
    }
    $conn->close();
    ?>"><?php
    include('../../connex.php');
        $sql = "SELECT homepage2 FROM benutzer WHERE id = 1";
        $result = $conn->query($sql);
if ($result->num_rows > 0) {
$row = $result->fetch_assoc();
$homepage2 = $row['homepage2'];
echo "$homepage2";
} else {
echo "Link nicht gefunden.";
}
$conn->close();
?></a>
<br>Link 3:
<a href="http://<?php include('../../connex.php');
                $sql = "SELECT homepage3 FROM benutzer WHERE id = 1";
                $result = $conn->query($sql);
     if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $homepage3 = $row['homepage3'];
        echo "$homepage3";
    } else {
        echo "Link nicht gefunden.";
    }
    $conn->close();
    ?>"><?php
    include('../../connex.php');
        $sql = "SELECT homepage3 FROM benutzer WHERE id = 1";
        $result = $conn->query($sql);
if ($result->num_rows > 0) {
$row = $result->fetch_assoc();
$homepage3 = $row['homepage3'];
echo "$homepage3";
} else {
echo "Link nicht gefunden.";
}
$conn->close();
?></a>
<br>Link 4:
<a href="http://<?php include('../../connex.php');
                $sql = "SELECT homepage4 FROM benutzer WHERE id = 1";
                $result = $conn->query($sql);
     if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $homepage4 = $row['homepage4'];
        echo "$homepage4";
    } else {
        echo "Link nicht gefunden.";
    }
    $conn->close();
    ?>"><?php
    include('../../connex.php');
        $sql = "SELECT homepage4 FROM benutzer WHERE id = 1";
        $result = $conn->query($sql);
if ($result->num_rows > 0) {
$row = $result->fetch_assoc();
$homepage4 = $row['homepage4'];
echo "$homepage4";
} else {
echo "Link nicht gefunden.";
}
$conn->close();
?></a>
<br>Link 5:
<a href="http://<?php include('../../connex.php');
                $sql = "SELECT homepage5 FROM benutzer WHERE id = 1";
                $result = $conn->query($sql);
     if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $homepage5 = $row['homepage5'];
        echo "$homepage5";
    } else {
        echo "Link nicht gefunden.";
    }
    $conn->close();
    ?>"><?php
    include('../../connex.php');
        $sql = "SELECT homepage5 FROM benutzer WHERE id = 1";
        $result = $conn->query($sql);
if ($result->num_rows > 0) {
$row = $result->fetch_assoc();
$homepage5 = $row['homepage5'];
echo "$homepage5";
} else {
echo "Link nicht gefunden.";
}
$conn->close();
?>
</td>
<td valign="top" style="display: inline-block; padding: 5px;">
    <div class="image-container"><img src="profil.jpg" alt="Profilbild"><br>
    > <a href="profil.jpg">./profil.jpg</a></img> - <b>(</b> <a href="profil.jpg"><font color="<?php include('../../connex.php');
                $sql = "SELECT color FROM benutzer WHERE id = 1";
                $result = $conn->query($sql);
     if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $color = $row['color'];
        echo "$color";
    } else {
        echo "Farbe nicht gefunden.";
    }
    $conn->close();
    ?>">ganzes Bild</font></a> <b>)</b><br>
 -----------------------------------------------------------<br><br>
    <i><b>> Herzlich Willkommen!</b></i> Das hier ist die Nickpage von: <a href="../counting"><font color="#<?php include('../../connex.php');
                    $user_id = 1;
                $sql = "SELECT color FROM benutzer WHERE id = 1";
                $result = $conn->query($sql);
     if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $color = $row['color'];
        echo "$color";
    } else {
        echo "Link nicht gefunden.";
    }
    $conn->close();
    ?>"><u>CouNTiNG</u></font></a>. <i>Na, du? Wie geht es dir, ist bei dir auch alles gut?
        Hinterlasse doch einfach mal einen kurzen/netten oder sogar ganz süßen Eintrag im (*)Gästebuch? Unterhaltungen mit tollen Menschen können oft interessant oder gar auch sehr
        nützlich werden. - Wer weiß, vielleicht macht es dir ja auch so viel Spaß? <u>Kurzer Tipp</u>: Überlege dir schon vorher ein Thema über das du gerne sprechen möchtest.
        Bleibe stets höflich, nett und hilfsbereit. Denke bitte auch daran, niemals jemanden über das Internet zu drohen, zu beschimpfen oder gar auszulachen aka. zu mobben. So
        krasse MF's sind wir dann auch wieder nicht. Ich denke wohl, wir kommen alle miteinander aus. Also, egal ob lockig oder flockig: "Genießt die Zeit und habt Spaß".
        Wünsche euch allen viel Glück und Erfolg! ;)</i><br><br>
        </i>
</div>
</td>
<td valign="top" style="display: inline-block; padding: 5px;">
            <?php
                include '../../connex.php';
                    // Überprüfen, ob der Benutzer angemeldet ist
                    if(isset($_SESSION['benutzername'])) {
                    // Benutzer ist angemeldet, zeige z.B. Willkommensnachricht und Logout-Link
                        echo '
                                <form action="../../senden.php" method="post">
                                    <table>
                                        <tr>
                                            <td>
                                                <label for="empfaenger">Benutzer schreiben:</label>
                                            </td>
                                            <td>
                                                <input type="text" name="empfaenger" required> [ <a href="../">einen bestimmten Benutzernamen suchen</a> ] - <i>*Hotkey: <b>STRG</b> + <b>F</b> drücken!</i>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td valign="top">
                                                <label for="nachricht">Nachricht:</label>
                                            </td>
                                            <td>
                                                <textarea name="nachricht" cols ="42" rows="9" required></textarea>
                                                <br>
                                                <input type="submit" value="Senden">
                                            </td>
                                        </tr>
                                    </table>
                                </form>';
                        echo '[ <a href="../../logoutpage.php">Abmelden</a> ]';
                    } else {
                    // Benutzer ist nicht angemeldet, zeige Login-Link
                        echo '[ <a href="../../loginpage.html">Anmelden</a> ]';
                    }
                ?>
         <p> <?php include '../../nachrichten.php'; ?> </p>
     </td>
</tr>
                </table>
</body>
</html>