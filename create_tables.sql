--
-- Tabellenstruktur für Tabelle `attribute`
--

CREATE TABLE `attribute` (
  `user_id` int(11) NOT NULL,
  `available_points` int(11) NOT NULL DEFAULT 0,
  `vitality` int(11) NOT NULL DEFAULT 0,
  `energy` int(11) NOT NULL DEFAULT 0,
  `geschicklichkeit` int(11) NOT NULL DEFAULT 0,
  `staerke` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `attribute`
--

INSERT INTO `attribute` (`user_id`, `available_points`, `vitality`, `energy`, `geschicklichkeit`, `staerke`) VALUES
(1, 41311, 49, 103, 123, 134);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `benutzer`
--

CREATE TABLE `benutzer` (
  `id` int(11) NOT NULL,
  `benutzername` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `passwort` varchar(32) NOT NULL,
  `geburtsdatum` date NOT NULL,
  `friends` text DEFAULT NULL,
  `color` varchar(6) DEFAULT NULL,
  `fadecolor` varchar(6) DEFAULT NULL,
  `lastlogin` int(11) DEFAULT NULL,
  `chattime` int(11) DEFAULT NULL,
  `userright` int(11) DEFAULT 33,
  `homepage` text DEFAULT NULL,
  `homepage1` varchar(255) DEFAULT NULL,
  `homepage2` varchar(255) DEFAULT NULL,
  `homepage3` varchar(255) DEFAULT NULL,
  `homepage4` varchar(255) DEFAULT NULL,
  `homepage5` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `rolle` enum('leser','mitarbeiter','admin') DEFAULT 'leser',
  `aktuelle_mission_id` int(11) DEFAULT NULL,
  `health` int(11) DEFAULT 100,
  `attack` int(11) DEFAULT 10,
  `defense` int(11) DEFAULT 5,
  `equipped_weapon_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `benutzer`
--

INSERT INTO `benutzer` (`id`, `benutzername`, `email`, `passwort`, `geburtsdatum`, `friends`, `color`, `fadecolor`, `lastlogin`, `chattime`, `userright`, `homepage`, `homepage1`, `homepage2`, `homepage3`, `homepage4`, `homepage5`, `bio`, `rolle`, `aktuelle_mission_id`, `health`, `attack`, `defense`, `equipped_weapon_id`) VALUES

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `charlevels`
--

CREATE TABLE `charlevels` (
  `id` int(11) NOT NULL,
  `char_lvl` int(11) NOT NULL,
  `xp_needed` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `charlevels`
--

INSERT INTO `charlevels` (`id`, `char_lvl`, `xp_needed`) VALUES
(1, 1, 100),
(2, 2, 200),
(3, 3, 500),
(4, 4, 900),
(5, 5, 1500),
(6, 6, 2250),
(7, 7, 3500),
(8, 8, 4750),
(9, 9, 7275),
(10, 10, 14500),
(11, 11, 24750),
(12, 12, 37125),
(13, 13, 50000),
(14, 14, 75000),
(15, 15, 115000),
(16, 16, 146500),
(17, 17, 178187),
(18, 18, 225000),
(19, 19, 300000),
(20, 20, 385000),
(21, 21, 495000);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `gaestebuch`
--

CREATE TABLE `gaestebuch` (
  `id` int(11) NOT NULL,
  `benutzer_id` int(11) NOT NULL,
  `eintrag` text NOT NULL,
  `datum` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `inventar`
--

CREATE TABLE `inventar` (
  `id` int(11) NOT NULL,
  `benutzer_id` int(11) NOT NULL,
  `waffen_id` int(11) NOT NULL,
  `equipped` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `inventar`
--

INSERT INTO `inventar` (`id`, `benutzer_id`, `waffen_id`, `equipped`) VALUES
(4926, 1, 5982, 0),
(4927, 1, 5983, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `missionen`
--

CREATE TABLE `missionen` (
  `id` int(11) NOT NULL,
  `dauer` int(11) NOT NULL,
  `gold_belohnung` int(11) NOT NULL,
  `xp_belohnung` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `missionen`
--

INSERT INTO `missionen` (`id`, `dauer`, `gold_belohnung`, `xp_belohnung`) VALUES
(1, 10, 395, 5000),
(2, 20, 711, 10),
(3, 30, 30, 15),
(4, 40, 25, 20),
(5, 50, 20, 25),
(6, 60, 15, 30),
(7, 70, 10, 35),
(8, 80, 8, 250000),
(9, 90, 5, 100000),
(10, 100, 3, 50000),
(11, 110, 2, 1000),
(12, 120, 1, 500);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `nachrichten`
--

CREATE TABLE `nachrichten` (
  `id` int(11) NOT NULL,
  `absender_id` int(11) NOT NULL,
  `empfaenger_id` int(11) NOT NULL,
  `nachricht` text NOT NULL,
  `zeitstempel` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `headline` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `publication_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `punktesystem`
--

CREATE TABLE `punktesystem` (
  `benutzer_id` int(11) NOT NULL,
  `punkte` int(11) DEFAULT 0,
  `mission_startzeit` timestamp NULL DEFAULT NULL,
  `level` int(11) DEFAULT 1,
  `experience_points` int(11) DEFAULT 0,
  `xp_total` int(11) NOT NULL DEFAULT 0,
  `missions_total` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `punktesystem`
--

INSERT INTO `punktesystem` (`benutzer_id`, `punkte`, `mission_startzeit`, `level`, `experience_points`, `xp_total`, `missions_total`) VALUES
(1, 47557, '2023-12-28 06:46:59', 6, 0, 1280001, 12),
(2, 1588, NULL, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `stats`
--

CREATE TABLE `stats` (
  `benutzer_id` int(11) NOT NULL,
  `level` int(11) DEFAULT 1,
  `experience_points` int(11) DEFAULT 0,
  `attack` int(11) NOT NULL DEFAULT 10,
  `defense` int(11) NOT NULL DEFAULT 5,
  `health` int(11) NOT NULL DEFAULT 100,
  `mana` int(11) DEFAULT NULL,
  `magic_power` int(11) DEFAULT NULL,
  `life_steal` int(11) DEFAULT NULL,
  `critical_hit` int(11) DEFAULT NULL,
  `magic_bonus` int(11) DEFAULT NULL,
  `fire_damage` int(11) DEFAULT NULL,
  `ice_damage` int(11) DEFAULT NULL,
  `lightning_damage` int(11) DEFAULT NULL,
  `poison_damage` int(11) DEFAULT NULL,
  `armor_penetration` int(11) DEFAULT NULL,
  `fire_resistance` int(11) DEFAULT NULL,
  `ice_resistance` int(11) DEFAULT NULL,
  `lightning_resistance` int(11) DEFAULT NULL,
  `poison_resistance` int(11) DEFAULT NULL,
  `cold_resistance` int(11) DEFAULT NULL,
  `critical_damage` int(11) DEFAULT NULL,
  `spell_vamp` int(11) DEFAULT NULL,
  `attack_speed` int(11) DEFAULT NULL,
  `cast_speed` int(11) DEFAULT NULL,
  `mana_regeneration_per_hour` int(11) DEFAULT NULL,
  `mana_leech` int(11) DEFAULT NULL,
  `vitality` int(11) NOT NULL DEFAULT 5,
  `geschicklichkeit` int(11) NOT NULL DEFAULT 5,
  `staerke` int(11) NOT NULL DEFAULT 5,
  `energy` int(11) NOT NULL DEFAULT 5,
  `hit_chance` int(11) DEFAULT NULL,
  `speed` int(11) DEFAULT NULL,
  `damage` int(11) DEFAULT NULL,
  `armor` int(11) DEFAULT NULL,
  `elemental_power` int(11) DEFAULT NULL,
  `energy_regeneration` int(11) DEFAULT NULL,
  `equipped_weapon_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `stats`
--

INSERT INTO `stats` (`benutzer_id`, `level`, `experience_points`, `attack`, `defense`, `health`, `mana`, `magic_power`, `life_steal`, `critical_hit`, `magic_bonus`, `fire_damage`, `ice_damage`, `lightning_damage`, `poison_damage`, `armor_penetration`, `fire_resistance`, `ice_resistance`, `lightning_resistance`, `poison_resistance`, `cold_resistance`, `critical_damage`, `spell_vamp`, `attack_speed`, `cast_speed`, `mana_regeneration_per_hour`, `mana_leech`, `vitality`, `geschicklichkeit`, `staerke`, `energy`, `hit_chance`, `speed`, `damage`, `armor`, `elemental_power`, `energy_regeneration`, `equipped_weapon_id`) VALUES
(1, 1, 0, 306, 205, 2392, 401, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, 5, 5, 5, 166, 6, 9, 2, 2, 2, 5983);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `waffen`
--

CREATE TABLE `waffen` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `qualitaet` varchar(10) NOT NULL,
  `angriffskraft` int(11) NOT NULL,
  `magiestaerke` int(11) DEFAULT NULL,
  `lebensraub` int(11) DEFAULT NULL,
  `kritischer_treffer` int(11) DEFAULT NULL,
  `magischer_bonus` int(11) DEFAULT NULL,
  `feuerschaden` int(11) DEFAULT NULL,
  `kaeltedchaden` int(11) DEFAULT NULL,
  `blitzschaden` int(11) DEFAULT NULL,
  `giftschaden` int(11) DEFAULT NULL,
  `ruestungsdurchdringung` int(11) DEFAULT NULL,
  `verteidigung` int(11) DEFAULT NULL,
  `feuerresistenz` int(11) DEFAULT NULL,
  `blitzresistenz` int(11) DEFAULT NULL,
  `giftresistenz` int(11) DEFAULT NULL,
  `kaelteresistenz` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `waffen`
--

INSERT INTO `waffen` (`id`, `name`, `qualitaet`, `angriffskraft`, `magiestaerke`, `lebensraub`, `kritischer_treffer`, `magischer_bonus`, `feuerschaden`, `kaeltedchaden`, `blitzschaden`, `giftschaden`, `ruestungsdurchdringung`, `verteidigung`, `feuerresistenz`, `blitzresistenz`, `giftresistenz`, `kaelteresistenz`) VALUES
(5982, 'Eiserner Streitkolben des Lebensentzugs', 'selten', 1634, NULL, 369, NULL, 765, NULL, 1038, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 108),
(5983, 'Magisches Szepter der Vergiftung', 'magisch', 251, NULL, NULL, NULL, NULL, NULL, NULL, 498, 401, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `attribute`
--
ALTER TABLE `attribute`
  ADD PRIMARY KEY (`user_id`);

--
-- Indizes für die Tabelle `benutzer`
--
ALTER TABLE `benutzer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_benutzer_mission` (`aktuelle_mission_id`),
  ADD KEY `fk_benutzer_waffen` (`equipped_weapon_id`);

--
-- Indizes für die Tabelle `charlevels`
--
ALTER TABLE `charlevels`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `gaestebuch`
--
ALTER TABLE `gaestebuch`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_gaestebuch_benutzer` (`benutzer_id`);

--
-- Indizes für die Tabelle `inventar`
--
ALTER TABLE `inventar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_inventar_benutzer` (`benutzer_id`),
  ADD KEY `fk_inventar_waffen` (`waffen_id`);

--
-- Indizes für die Tabelle `missionen`
--
ALTER TABLE `missionen`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `nachrichten`
--
ALTER TABLE `nachrichten`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indizes für die Tabelle `punktesystem`
--
ALTER TABLE `punktesystem`
  ADD PRIMARY KEY (`benutzer_id`);

--
-- Indizes für die Tabelle `stats`
--
ALTER TABLE `stats`
  ADD PRIMARY KEY (`benutzer_id`);

--
-- Indizes für die Tabelle `waffen`
--
ALTER TABLE `waffen`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `benutzer`
--
ALTER TABLE `benutzer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT für Tabelle `charlevels`
--
ALTER TABLE `charlevels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT für Tabelle `gaestebuch`
--
ALTER TABLE `gaestebuch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT für Tabelle `inventar`
--
ALTER TABLE `inventar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4928;

--
-- AUTO_INCREMENT für Tabelle `nachrichten`
--
ALTER TABLE `nachrichten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT für Tabelle `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT für Tabelle `waffen`
--
ALTER TABLE `waffen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5984;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `attribute`
--
ALTER TABLE `attribute`
  ADD CONSTRAINT `attribute_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `benutzer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `benutzer`
--
ALTER TABLE `benutzer`
  ADD CONSTRAINT `fk_benutzer_mission` FOREIGN KEY (`aktuelle_mission_id`) REFERENCES `missionen` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_benutzer_waffen` FOREIGN KEY (`equipped_weapon_id`) REFERENCES `waffen` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints der Tabelle `gaestebuch`
--
ALTER TABLE `gaestebuch`
  ADD CONSTRAINT `fk_gaestebuch_benutzer` FOREIGN KEY (`benutzer_id`) REFERENCES `benutzer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `inventar`
--
ALTER TABLE `inventar`
  ADD CONSTRAINT `fk_inventar_benutzer` FOREIGN KEY (`benutzer_id`) REFERENCES `benutzer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_inventar_waffen` FOREIGN KEY (`waffen_id`) REFERENCES `waffen` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `benutzer` (`id`);

--
-- Constraints der Tabelle `punktesystem`
--
ALTER TABLE `punktesystem`
  ADD CONSTRAINT `fk_punktesystem_benutzer` FOREIGN KEY (`benutzer_id`) REFERENCES `benutzer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `stats`
--
ALTER TABLE `stats`
  ADD CONSTRAINT `fk_stats_benutzer` FOREIGN KEY (`benutzer_id`) REFERENCES `benutzer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
