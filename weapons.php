<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Waffen Generator</title>
    <style>
        body {
            font-family: Verdana, sans-serif;
            margin: 20px;
        }
        .weapon-container {
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
        }
        .weapon-name {
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }
        .weapon-quality {
            font-size: 14px;
            color: #888;
            margin-bottom: 10px;
        }
        .weapon-stats {
            margin-top: 10px;
        }
        .stat-item {
            margin-bottom: 5px;
        }
        .rare .weapon-name {
            color: #FFD700; /* More gold/yellow color for rare items */
        }
        .magical .weapon-name {
            color: #4682B4; /* Bluish-gray color for magical items */
        }
    </style>
</head>
<body>

<?php

class WaffenGenerator {

    private $prefixes = array(
        'neuter' => array("Schweres", "Geschärftes", "Magisches", "Dämonisches", "Meisterliches", "Eisernes"),
        'masculine' => array("Schwerer", "Geschärfter", "Magischer", "Dämonischer", "Meisterlicher", "Eiserner"),
        'feminine' => array("Schwere", "Geschärfte", "Magische", "Dämonische", "Meisterliche", "Eiserne")
    );
    private $suffixes = array(
        "Feuerschaden" => array("der Glut", "des Feuers", "der Infernos"),
        "Kälteschaden" => array("des Frostes", "der Kälte", "des Eises"),
        "Blitzschaden" => array("des Blitzes", "der Elektrizität", "des Donners"),
        "Giftschaden" => array("der Vergiftung", "des Giftes", "der Toxine"),
        "Lebensraub" => array("der Heilung", "des Bluttrinkens", "des Lebensentzugs"),
        "Verteidigung" => array("der Verteidigung", "der Abwehr", "der Panzerung"),
        "Feuerresistenz" => array("der Feuerresistenz", "des Feuerschutzes", "der Hitzeabwehr"),
        "Blitzresistenz" => array("der Blitzresistenz", "des Blitzschutzes", "der Elektroabwehr"),
        "Giftresistenz" => array("der Giftresistenz", "des Giftdurchhaltevermögens", "der Toxinimmunität"),
        "Kälteresistenz" => array("der Kälteresistenz", "des Kälteschutzes", "der Eisabwehr"),
        "default" => array("der Macht", "der Stärke", "der Gewalt") // Fallback, falls kein passender Schadentyp gefunden wird
    );
    private $stats = array(
        "Angriffskraft", "Lebensraub", "Kritischer Treffer", "Magiestärke", "Magischer Bonus",
        "Feuerschaden", "Kälteschaden", "Blitzschaden", "Giftschaden", "Rüstungsdurchdringung",
        "Verteidigung", "Feuerresistenz", "Blitzresistenz", "Giftresistenz", "Kälteresistenz"
    );

    public function generiereWaffe($qualitaet = 'normal') {
        $waffenTyp = $this->waffenTyp();
        $stats = array();

// Alle Waffen haben Angriffskraft
$stats["Angriffskraft"] = rand(75, 315);


        // Setze die Wahrscheinlichkeiten für magische, seltene und normale Waffen
        $magischeWahrscheinlichkeit = 40; // z.B., 20% für magische Waffen
        $selteneWahrscheinlichkeit = 10;   // z.B., 5% für seltene Waffen

// Wenn es sich um eine magische Waffe handelt
if ($qualitaet == 'magisch' || (rand(1, 100) <= $magischeWahrscheinlichkeit)) {
    $qualitaet = 'magisch';

    // Festlegen der Grenzen für die Anzahl der insgesamt generierten Stats für magische Waffen
    $minStats = 1;
    $maxStats = 5;
    $anzahlStats = rand($minStats, $maxStats);

    // Limitiere die Anzahl der "verschiedenen" Stats auf 4
    $maxDifferentStats = 4;
    $statsCount = 0;

    // Generiere zusätzliche magische Stats
    for ($i = 0; $i < $anzahlStats; $i++) {
        $stat = $this->stats[array_rand($this->stats)];
        $wert = rand(1, 455);

        if (array_key_exists($stat, $stats)) {
            // Falls der Stat bereits existiert, addiere den Wert
            $stats[$stat] += $wert;
        } else {
            // Ansonsten setze den Wert für den Stat
            $stats[$stat] = $wert;
            $statsCount++;

            // Überprüfe, ob die maximale Anzahl verschiedener Stats erreicht ist
            if ($statsCount >= $maxDifferentStats) {
                break;
            }
        }
    }

    // Füge einen vorhandenen Stat zu einem anderen hinzu
    $existingStats = array_keys($stats);
    if (count($existingStats) >= 2) {
        $statToAdd = $existingStats[array_rand($existingStats)];
        $stats[$statToAdd] += rand(275, 415);
    }
}

    
// Wenn es sich um eine seltene Waffe handelt
if ($qualitaet == 'selten' || (rand(1, 100) <= $selteneWahrscheinlichkeit)) {
    $qualitaet = 'selten';

    // Festlegen der Grenzen für die Anzahl der insgesamt generierten Stats für seltene Waffen
    $minStats = 3;
    $maxStats = 9;
    $anzahlStats = rand($minStats, $maxStats);

    // Limitiere die Anzahl der "verschiedenen" Stats auf 6
    $maxDifferentStats = 5;
    $statsCount = 0;

    // Generiere zusätzliche seltene Stats
    for ($i = 0; $i < $anzahlStats; $i++) {
        $stat = $this->stats[array_rand($this->stats)];
        $wert = rand(1, 625);

        if (array_key_exists($stat, $stats)) {
            // Falls der Stat bereits existiert, addiere den Wert
            $stats[$stat] += $wert;
        } else {
            // Ansonsten setze den Wert für den Stat
            $stats[$stat] = $wert;
            $statsCount++;

            // Überprüfe, ob die maximale Anzahl verschiedener Stats erreicht ist
            if ($statsCount >= $maxDifferentStats) {
                break;
            }
        }
    }
    // Füge einen vorhandenen Stat zu einem anderen hinzu
    $existingStats = array_keys($stats);
    if (count($existingStats) >= 2) {
        $statToAdd = $existingStats[array_rand($existingStats)];
        $stats[$statToAdd] += rand(475, 525);
    }
}

// Wenn es sich um eine normale Waffe handelt
if ($qualitaet == 'normal') {
    // Festlegen der Grenzen für die Anzahl der insgesamt generierten Stats für normale Waffen
    $minStats = 0;
    $maxStats = 3; // Set the maximum number of different stats for normal items
    $anzahlStats = rand($minStats, $maxStats);

    // Limitiere die Anzahl der "verschiedenen" Stats auf 3
    $maxDifferentStats = 2;
    $statsCount = 0;

    // Generiere zusätzliche normale Stats
    for ($i = 0; $i < $anzahlStats; $i++) {
        $stat = $this->stats[array_rand($this->stats)];
        $wert = rand(9, 500);

        if (array_key_exists($stat, $stats)) {
            // Falls der Stat bereits existiert, addiere den Wert
            $stats[$stat] += $wert;
        } else {
            // Ansonsten setze den Wert für den Stat
            $stats[$stat] = $wert;
            $statsCount++;

            // Überprüfe, ob die maximale Anzahl verschiedener Stats erreicht ist
            if ($statsCount >= $maxDifferentStats) {
                break;
            }
        }
    }
        // Füge einen vorhandenen Stat zu einem anderen hinzu
        $existingStats = array_keys($stats);
        if (count($existingStats) >= 2) {
            $statToAdd = $existingStats[array_rand($existingStats)];
            $stats[$statToAdd] += rand(275, 325);
        }
}

// Wenn "Magiestärke" vorhanden ist, reduziere die Angriffskraft um 50% und verstärke "Magiestärke" um 50%
if (array_key_exists("Magiestärke", $stats)) {
    $stats["Angriffskraft"] = round($stats["Angriffskraft"] * 0.50); // Runde auf ganze Zahl
    $stats["Magiestärke"] = round($stats["Magiestärke"] * 1.50);     // Runde auf ganze Zahl
} else {
    // Wenn keine "Magiestärke" vorhanden ist, erhöhe Angriffskraft um 50%
    $stats["Angriffskraft"] = round($stats["Angriffskraft"] * 1.50); // Runde auf ganze Zahl
}

        $prefix = $this->getCorrectPrefix($waffenTyp, $stats);
        $suffix = $this->getCorrectSuffix($stats);

        $waffe = array(
            'Name' => "$prefix $waffenTyp $suffix",
            'Qualitaet' => $qualitaet,
            'Stats' => $stats
        );
        return $waffe;
    }

    public function zeigeWaffeAn($waffe) {
        $containerClass = '';
        if ($waffe['Qualitaet'] == 'selten') {
            $containerClass = 'rare';
        } elseif ($waffe['Qualitaet'] == 'magisch') {
            $containerClass = 'magical';
        }

        echo '<div class="weapon-container ' . $containerClass . '">';
        echo '<div class="weapon-name">' . $waffe['Name'] . '</div>';
        echo '<div class="weapon-quality">Qualität: ' . $waffe['Qualitaet'] . '</div>';
        echo '<div class="weapon-stats"><strong>Stats:</strong>';
        echo '<ul>';
        foreach ($waffe['Stats'] as $stat => $wert) {
            echo '<li class="stat-item"><strong>' . $stat . ':</strong> ' . $wert . '</li>';
        }
        echo '</ul>';
        echo '</div>';
        echo '</div>';
    }

    private function waffenTyp() {
        $waffenTypen = array("Langschwert", "Dolch", "Bogen", "Streitkolben", "Szepter", "Kriegsaxt");
        return $waffenTypen[array_rand($waffenTypen)];
    }

    private function getCorrectPrefix($waffenTyp, $stats) {
        $gender = $this->getGrammaticalGender($waffenTyp);
        $prefixOptions = $this->prefixes[$gender];
    
        // Prüfe, ob der Stat "Magiestärke" vorhanden ist
        $magiestaerkeExists = array_key_exists("Magiestärke", $stats);
    
        // Füge einen Zusatz zum Präfix basierend auf den Stats hinzu
        foreach ($stats as $stat => $wert) {
            switch ($stat) {
                case "Magiestärke":
                    // Verwende die korrekte Form abhängig vom grammatischen Geschlecht
                    switch ($gender) {
                        case 'neuter':
                            $prefixOptions[] = $magiestaerkeExists ? "Magisches" : "Verzaubertes";
                            break;
                        case 'masculine':
                            $prefixOptions[] = $magiestaerkeExists ? "Magischer" : "Verzauberter";
                            break;
                        case 'feminine':
                            $prefixOptions[] = $magiestaerkeExists ? "Magische" : "Verzauberte";
                            break;
                    }
                    break;
                // Füge weitere Cases für andere Stats hinzu, falls gewünscht
            }
        }
    
        $prefix = $prefixOptions[array_rand($prefixOptions)];
    
        return $prefix;
    }

    private function getCorrectSuffix($stats) {
        foreach ($stats as $stat => $wert) {
            if (array_key_exists($stat, $this->suffixes)) {
                $suffixOptions = $this->suffixes[$stat];
                return $suffixOptions[array_rand($suffixOptions)];
            }
        }

        // Falls kein passender Schadentyp gefunden wurde, verwende den Standard-Suffix
        $defaultOptions = $this->suffixes['default'];
        return $defaultOptions[array_rand($defaultOptions)];
    }

    private function getGrammaticalGender($waffenTyp) {
        $genderMapping = array(
            "Langschwert" => "neuter",
            "Dolch" => "masculine",
            "Bogen" => "masculine",
            "Streitkolben" => "masculine",
            "Szepter" => "neuter",
            "Kriegsaxt" => "feminine"
        );

        return isset($genderMapping[$waffenTyp]) ? $genderMapping[$waffenTyp] : "neuter";
    }


        // Füge diese Funktion hinzu, um eine Waffe in die Datenbank einzutragen
        public function eintragenInDatenbank($waffe) {
            $servername = "localhost";
            $username = "root";
            $password = "counter4fun";
            $dbname = "dibadudb";
    
            try {
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
                $stmt = $conn->prepare("INSERT INTO waffen (name, qualitaet, angriffskraft, magiestaerke, lebensraub, kritischer_treffer, magischer_bonus, feuerschaden, kaeltedchaden, blitzschaden, giftschaden, ruestungsdurchdringung, verteidigung, feuerresistenz, blitzresistenz, giftresistenz, kaelteresistenz) 
                                       VALUES (:name, :qualitaet, :angriffskraft, :magiestaerke, :lebensraub, :kritischer_treffer, :magischer_bonus, :feuerschaden, :kaeltedchaden, :blitzschaden, :giftschaden, :ruestungsdurchdringung, :verteidigung, :feuerresistenz, :blitzresistenz, :giftresistenz, :kaelteresistenz)");
    
            // Binden der Parameter
            $stmt->bindParam(':name', $waffe['Name']);
            $stmt->bindParam(':qualitaet', $waffe['Qualitaet']);
            $stmt->bindParam(':angriffskraft', $waffe['Stats']['Angriffskraft']);
            $stmt->bindParam(':magiestaerke', $waffe['Stats']['Magiestärke']);
            $stmt->bindParam(':lebensraub', $waffe['Stats']['Lebensraub']);
            $stmt->bindParam(':kritischer_treffer', $waffe['Stats']['Kritischer Treffer']);
            $stmt->bindParam(':magischer_bonus', $waffe['Stats']['Magischer Bonus']);
            $stmt->bindParam(':feuerschaden', $waffe['Stats']['Feuerschaden']);
            $stmt->bindParam(':kaeltedchaden', $waffe['Stats']['Kälteschaden']);
            $stmt->bindParam(':blitzschaden', $waffe['Stats']['Blitzschaden']);
            $stmt->bindParam(':giftschaden', $waffe['Stats']['Giftschaden']);
            $stmt->bindParam(':ruestungsdurchdringung', $waffe['Stats']['Rüstungsdurchdringung']);
            $stmt->bindParam(':verteidigung', $waffe['Stats']['Verteidigung']);
            $stmt->bindParam(':feuerresistenz', $waffe['Stats']['Feuerresistenz']);
            $stmt->bindParam(':blitzresistenz', $waffe['Stats']['Blitzresistenz']);
            $stmt->bindParam(':giftresistenz', $waffe['Stats']['Giftresistenz']);
            $stmt->bindParam(':kaelteresistenz', $waffe['Stats']['Kälteresistenz']);
// Binden der Parameter

// ...
            // Ausführen des vorbereiteten Statements
            $stmt->execute();

            // Get the ID of the inserted weapon
        $weaponId = $conn->lastInsertId();

        // Insert the weapon into the user's inventory
        $userId = 1; // Replace with the actual user ID
        $stmt = $conn->prepare("INSERT INTO inventar (benutzer_id, waffen_id) VALUES (:benutzer_id, :waffen_id)");
        $stmt->bindParam(':benutzer_id', $userId);
        $stmt->bindParam(':waffen_id', $weaponId);
        $stmt->execute();

        echo "<div>Waffe erfolgreich in die Datenbank und das Inventar eingetragen.</div>";


            echo "<div>Waffe erfolgreich in die Datenbank eingetragen.</div>";
    
            } catch(PDOException $e) {
                echo "Fehler: " . $e->getMessage();
            }
            $conn = null;
        }
}

$waffenGenerator = new WaffenGenerator();

try {
    // Beispiel: Generiere eine normale Waffe
    //$normaleWaffe = $waffenGenerator->generiereWaffe();
    //$waffenGenerator->zeigeWaffeAn($normaleWaffe);

    // Beispiel: Generiere eine magische Waffe
   // $magischeWaffe = $waffenGenerator->generiereWaffe('magisch');
    //$waffenGenerator->zeigeWaffeAn($magischeWaffe);

    // Beispiel: Generiere eine seltene (rare) Waffe
    //$selteneWaffe = $waffenGenerator->generiereWaffe('selten');
    //$waffenGenerator->eintragenInDatenbank($selteneWaffe);
    //$waffenGenerator->zeigeWaffeAn($selteneWaffe);

    // Beispiel: Generiere eine normale Waffe und trage sie in die Datenbank ein
    $normaleWaffe2 = $waffenGenerator->generiereWaffe();
    $waffenGenerator->eintragenInDatenbank($normaleWaffe2);
    $waffenGenerator->zeigeWaffeAn($normaleWaffe2);


} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>

