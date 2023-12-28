<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nachricht senden</title>
</head>
<body>
    <h1>Nachricht senden</h1>
    <form action="senden.php" method="post">
        <label for="empfaenger">Empfänger:</label>
        <input type="text" name="empfaenger" required>
        <br>
        <label for="nachricht">Nachricht:</label>
        <textarea name="nachricht" rows="4" required></textarea>
        <br>
        <input type="submit" value="Senden">
    </form>
</body>
</html>