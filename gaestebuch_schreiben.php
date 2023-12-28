<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gästebuch</title>
</head>
<body>
    <h2>Gästebuch</h2>
    
    <!-- Formular für Gästebucheintrag -->
    <form action="gaestebucheintrag.php" method="post">
        <label for="eintrag">Gästebucheintrag:</label><br>
        <textarea id="eintrag" name="eintrag" rows="8" cols="50" required></textarea><br>
        <input type="hidden" name="benutzer_id" value="BENUTZER_ID">
        <input type="submit" value="Eintragen">
    </form>
</body>
</html>