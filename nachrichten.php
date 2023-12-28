<table align="center" cellspacing="0" cellpadding="0" border="0" style="width: 100%;">
    <tr>
        <td valign="top" style="display: inline-block; padding: 5px;">
<?php

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

// Überprüfen, ob der Benutzer angemeldet ist
if (!isset($_SESSION['benutzername'])) {
    //echo "<a href='loginpage.html'>Anmelden</a>";
    //header("Location: loginpage.html");
    exit();
}

// Verbindung zur Datenbank herstellen
include('connex.php');

// Benutzer-ID abrufen
$benutzer_id = $_SESSION['user_id'];

$eingeloggteBenutzerID = $benutzer_id;
echo "<h2>Meine Nachrichten</h2>";

// Holen Sie sich die Nachrichten mit Benutzernamen aus der Datenbank
$sql = "SELECT nachrichten.*, benutzer.benutzername, benutzer.color FROM nachrichten INNER JOIN benutzer ON nachrichten.absender_id = benutzer.id WHERE nachrichten.empfaenger_id = $eingeloggteBenutzerID";
$result = $conn->query($sql);

// Anzeigen der eigenen empfangenen Nachrichten
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $benutzername = $row["benutzername"];
        $farbcode = $row["color"];
        $nachricht = $row["nachricht"];
        $zeitstempel = $row["zeitstempel"];

        // Den Benutzernamen in der entsprechenden Farbe anzeigen
        echo "<p><i>$zeitstempel:</i><br>  <a href='/user/$benutzername'><strong style='color: #$farbcode;'>$benutzername</a>: </strong> $nachricht</p>";
    }
} else {
    echo "Keine Nachrichten vorhanden.";
}
?>
</td>
        <td valign="top" style="display: inline-block; padding: 5px;">
<?php
// Anzeigen der eigenen gesendeten Nachrichten
$sql_nachrichten = "SELECT * FROM nachrichten WHERE absender_id = '$benutzer_id'";
$result_nachrichten = $conn->query($sql_nachrichten);

echo "<h2>Gesendete Nachrichten</h2>";
if ($result->num_rows > 0) {
while ($row = $result_nachrichten->fetch_assoc()) {
    echo "<p> Empfänger-Id.: " . $row['absender_id'] . "<br> Nachricht: " . $row['nachricht'] . "<br> Zeit: " . $row['zeitstempel'] . "</p>";
    //    echo "<p> Name: " . $row['absender_id'] . "<br> Nachricht: " . $row['nachricht'] . "<br> Zeit: " . $row['zeitstempel'] . "</p>";
}
} else {
    echo "Du hast eine Nachrichten gesendet.";
}
// Verbindung zur Datenbank schließen
$conn->close();
?>
</td>
</tr>
</table>
