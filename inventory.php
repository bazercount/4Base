<?php
// Connect to your database (replace these with your actual database credentials)
include('connex.php');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch weapons data
$sql = "SELECT * FROM waffen";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
<body>

<div class="container">
    <h2>Weapon List</h2>

    <?php if ($result->num_rows > 0): ?>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Waffen ID</th>
                        <th>Name</th>
                        <th>Typ</th>
                        <th>Atk Dmg</th>
                        <th>Magie</th>
                        <th>LL</th>
                        <th>Crit</th>
                        <th>Magie %</th>
                        <th>Feuer Dmg</th>
                        <th>Kälte Dmg</th>
                        <th>Blitz Dmg</th>
                        <th>Gift Dmg</th>
                        <th>Armor Pen</th>
                        <th>Def</th>
                        <th>Feuer Res</th>
                        <th>Blitz Res</th>
                        <th>Kälte Res</th>
                        <th>Gift Res</th>
                        <!-- Add more table headers for additional fields -->
                    </tr>
                </thead>
                <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><a href="get_weapon_details.php?weapon_id=<?php echo $row['id']; ?>"><?php echo $row['id']; ?></a></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['qualitaet']; ?></td>
                        <td><?php echo $row['angriffskraft']; ?></td>
                        <td><?php echo $row['magiestaerke']; ?></td>
                        <td><?php echo $row['lebensraub']; ?></td>
                        <td><?php echo $row['kritischer_treffer']; ?></td>
                        <td><?php echo $row['magischer_bonus']; ?></td>
                        <td><?php echo $row['feuerschaden']; ?></td>
                        <td><?php echo $row['kaeltedchaden']; ?></td>
                        <td><?php echo $row['blitzschaden']; ?></td>
                        <td><?php echo $row['giftschaden']; ?></td>
                        <td><?php echo $row['ruestungsdurchdringung']; ?></td>
                        <td><?php echo $row['verteidigung']; ?></td>
                        <td><?php echo $row['feuerresistenz']; ?></td>
                        <td><?php echo $row['blitzresistenz']; ?></td>
                        <td><?php echo $row['kaelteresistenz']; ?></td>
                        <td><?php echo $row['giftresistenz']; ?></td>
                        <!-- Add more table data for additional fields -->
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p class="text-center">No weapons found.</p>
    <?php endif; ?>
</div>

<!-- Optional: Add jQuery and Bootstrap JS for enhanced functionality -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
