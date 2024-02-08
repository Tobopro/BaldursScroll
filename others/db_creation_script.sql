SET AUTOCOMMIT = 0;
START TRANSACTION;

DROP DATABASE
    IF EXISTS BaldursScroll;
CREATE DATABASE BaldursScroll
    DEFAULT CHARACTER SET utf8mb4
    COLLATE utf8mb4_general_ci;
USE BaldursScroll;


CREATE TABLE Races(
   -- Primary key(s)
   idRace INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
   -- Table Content
   `name` VARCHAR(20) NOT NULL DEFAULT "default race"
   -- Constraints / Foreign Key(s)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE Classes(
   -- Primary key(s)
   idClass INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
   -- Table Content
   `name` VARCHAR(20) NOT NULL DEFAULT "default class",
   startingHp INT UNSIGNED NOT NULL DEFAULT 5,
   onLevelUpHp INT UNSIGNED NOT NULL DEFAULT 5,
   savingThrowProficency1 VARCHAR(50) NOT NULL DEFAULT "STR",
   savingThrowProficency2 VARCHAR(50) NOT NULL DEFAULT "CON"
   -- Constraints / Foreign Key(s)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE Levels(
   -- Primary key(s)
   idLevel INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
   -- Table Content
   `level` INT UNSIGNED NOT NULL
   -- Constraints / Foreign Key(s)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE Spells(
   -- Primary key(s)
   idSpell INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
   -- Table Content
  `name` VARCHAR(50) NOT NULL DEFAULT "default spell",
   `description` VARCHAR(255),
   damageType VARCHAR(50),
   damageRoll VARCHAR(50),
   icon VARCHAR(100)
   -- Constraints / Foreign Key(s)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE Users(
   -- Primary key(s)
   idUsers INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
   -- Table Content
   username VARCHAR(50) NOT NULL,
   email VARCHAR(50) NOT NULL,
   `password` VARCHAR(255) NOT NULL,
   signInDate DATETIME NOT NULL DEFAULT NOW(),
   profilePicture VARCHAR(100),
   isBanned BOOLEAN NOT NULL DEFAULT FALSE,
   isAdmin BOOLEAN NOT NULL DEFAULT FALSE
   -- Constraints / Foreign Key(s)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE SubClasses(
   -- Primary key(s)
   idSubClasses INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
   -- Table Content
   `name` VARCHAR(30) NOT NULL DEFAULT "default subclass",
   icon VARCHAR(100),
   -- Constraints / Foreign Key(s)
   idClass INT UNSIGNED NOT NULL,
   FOREIGN KEY(idClass) REFERENCES Classes(idClass)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE SubRaces(
   -- Primary key(s)
   idSubRace INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
   -- Table Content
   `name` VARCHAR(30) NOT NULL DEFAULT "default race",
   speed DECIMAL(3,1) NOT NULL DEFAULT 9,
   icon VARCHAR(100),
   -- Constraints / Foreign Key(s)
   idRace INT UNSIGNED NOT NULL,
   FOREIGN KEY(idRace) REFERENCES Races(idRace)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE Characters(
   -- Primary key(s)
   idCharacter INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
   -- Table Content
   `name` VARCHAR(50) NOT NULL DEFAULT "Tav",
   strength INT NOT NULL DEFAULT 17,
   dexterity INT NOT NULL DEFAULT 13,
   constitution INT NOT NULL DEFAULT 15,
   intelligence INT NOT NULL DEFAULT 13,
   wisdom INT NOT NULL DEFAULT 12,
   charisma INT NOT NULL DEFAULT 8,
   abilityScoreBonus1 VARCHAR(20) NOT NULL DEFAULT "STR",
   abilityScoreBonus2 VARCHAR(20) NOT NULL DEFAULT "CON",
   -- Constraints / Foreign Key(s)
   idSubRace INT UNSIGNED NOT NULL,
   idSubClasses INT UNSIGNED NOT NULL,
   idUsers INT UNSIGNED NOT NULL,
   FOREIGN KEY(idSubRace) REFERENCES SubRaces(idSubRace),
   FOREIGN KEY(idSubClasses) REFERENCES SubClasses(idSubClasses),
   FOREIGN KEY(idUsers) REFERENCES Users(idUsers)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE ClassesSpells(
   -- Primary key(s)
   idSpell INT UNSIGNED NOT NULL,
   idSubClasses INT UNSIGNED NOT NULL,
   PRIMARY KEY(idSpell, idSubClasses),
   -- Constraints / Foreign Key(s)
   FOREIGN KEY(idSpell) REFERENCES Spells(idSpell),
   FOREIGN KEY(idSubClasses) REFERENCES SubClasses(idSubClasses)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE RacesSpells(
   -- Primary key(s)
   idSpell INT UNSIGNED NOT NULL,
   idSubRace INT UNSIGNED NOT NULL,
   PRIMARY KEY(idSpell, idSubRace),
   -- Constraints / Foreign Key(s)
   FOREIGN KEY(idSpell) REFERENCES Spells(idSpell),
   FOREIGN KEY(idSubRace) REFERENCES SubRaces(idSubRace)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE SpellsLevel(
   idLevel INT UNSIGNED NOT NULL,
   idSpell INT UNSIGNED NOT NULL,
   PRIMARY KEY(idLevel, idSpell),
   -- Constraints / Foreign Key(s)
   FOREIGN KEY(idLevel) REFERENCES Levels(idLevel),
   FOREIGN KEY(idSpell) REFERENCES Spells(idSpell)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Self inserted data
-- -- Insert Data
-- INSERT INTO Levels (level)
-- VALUES 
--     (1),
--     (2),
--     (3),
--     (4);

-- INSERT INTO Classes (name, startingHp, onLevelUpHp, savingThrowProficiency1, savingThrowProficiency2)
-- VALUES 
--     ("Barbarian", 12, 7, "STR", "CON"),
--     ("Bard", 8, 5, "DEX", "CHA"),
--     ("Cleric", 8, 5, "WIS", "CHA"),
--     ("Druid", 8, 5, "WIS", "INT"),
--     ("Fighter", 10, 6, "STR", "CON"),
--     ("Monk", 8, 5, "STR", "DEX")

-- ChatGPT data
-- Insert data into Races table
INSERT INTO races (`id`, `name`) VALUES
(1, 'Human'),
(2, 'Elf'),
(3, 'Drow'),
(4, 'Half-Elf'),
(5, 'Half-Orc'),
(6, 'Halfling'),
(7, 'Dwarf'),
(8, 'Gnome'),
(9, 'Tiefling'),
(10, 'Githyanki'),
(11, 'Dragonborn');

-- Insert data into SubRaces table
INSERT INTO sub_races (`id`, `name`, speed, id_race_id) VALUES
(1, 'Human', 9, 1),
(2, 'High Elf', 9, 2),
(3, 'Wood Elf', 10.5, 2),
(4, 'Lolth-Sworn Drow', 9, 3),
(5, 'Seldarine', 9, 3),
(6, 'High Half-Elf', 9, 4),
(7, 'Wood Half-Elf', 10.5, 4),
(8, 'Drow Half-Elf', 9, 4),
(9, 'Half-Orc', 9, 5),
(10, 'Lightfoot Halfling', 7.5, 6),
(11, 'Strongheart Halfling', 7.5, 6),
(12, 'Gold Dwarf', 7.5, 7),
(13, 'Shield Dward', 7.5, 7),
(14, 'Duergar', 7.5, 7),
(15, 'Forest Gnome', 7.5, 8),
(16, 'Deep Gnome', 7.5, 8),
(17, 'Rock Gnome', 7.5, 8),
(18, 'Asmodeus Tiefling', 9, 9),
(19, 'Mephistopheles Tiefling', 9, 9),
(20, 'Zariel Tiefling', 9, 9),
(21, 'Githyanki', 9, 10),
(22, 'Black Dragonborn', 9, 11),
(23, 'Blue Dragonborn', 9, 11),
(24, 'Brass Dragonborn', 9, 11),
(25, 'Bronze Dragonborn', 9, 11),
(26, 'Copper Dragonborn', 9, 11),
(27, 'Gold Dragonborn', 9, 11),
(28, 'Green Dragonborn', 9, 11),
(29, 'Red Dragonborn', 9, 11),
(30, 'Silver Dragonborn', 9, 11),
(31, 'White Dragonborn', 9, 11);

-- Insert data into Classes table
INSERT INTO classes (`id`, `name`, starting_hp, on_level_up_hp, saving_throw_proficency1, saving_throw_proficency2) VALUES
(1, 'Barbarian', 12, 7, 'STR', 'CON'),
(2, 'Bard', 8, 5, 'DEX', 'CHA'),
(3, 'Cleric', 8, 5, 'WIS', 'CHA'),
(4, 'Druid', 8, 5, 'INT', 'WIS'),
(5, 'Fighter', 10, 6, 'STR', 'CON'),
(6, 'Monk', 8, 5, 'STR', 'DEX'),
(7, 'Paladin', 10, 6, 'WIS', 'CHA'),
(8, 'Ranger', 10, 6, 'STR', 'DEX'),
(9, 'Rogue', 8, 5, 'DEX', 'INT'),
(10, 'Sorcerer', 6, 4, 'CON', 'CHA'),
(11, 'Warlock', 8, 5, 'WIS', 'CHA'),
(12, 'Wizard', 6, 4, 'INT', 'WIS');

-- Insert data into SubClasses table
INSERT INTO sub_classes (`id`, `name`, `id_class_id`) VALUES
(1, 'Berserker', 1),
(2, 'Wild Magic', 1),
(3, 'Wildheart', 1),
(4, 'College of Lore', 2),
(5, 'College of Swords', 2),
(6, 'College of Valour', 2),
(7, 'Knowledge Domain', 3),
(8, 'Life Domain', 3),
(9, 'Light Domain', 3),
(10, 'Nature Domain', 3),
(11, 'Tempest Domain', 3),
(12, 'Trickery Domain', 3),
(13, 'War Domain', 3),
(14, 'Circle of the Land', 4),
(15, 'Circle of the Moon', 4),
(16, 'Circle of the Spores', 4),
(17, 'Battle Master', 5),
(18, 'Champion', 5),
(19, 'Eldritch Knight', 5),
(20, 'Way of the Open Hand', 6),
(21, 'Way of Shadow', 6),
(22, 'Way of the Four Elements', 6),
(23, 'Oath of the Ancients', 7),
(24, 'Oath of Devotion', 7),
(25, 'Oath of Vengeance', 7),
(26, 'Oathbreaker', 7),
(27, 'Hunter', 8),
(28, 'Beast Master', 8),
(29, 'Gloom Stalker', 8),
(30, 'Arcane Trickster', 9),
(31, 'Thief', 9),
(32, 'Assassin', 9),
(33, 'Draconic Bloodline', 10),
(34, 'Wild Magic', 10),
(35, 'Storm Sorcery', 10),
(36, 'The Archfey', 11),
(37, 'The Fiend', 11),
(38, 'The Great Old One', 11),
(39, 'Abjuration School', 12),
(40, 'Conjuration School', 12),
(41, 'Divination School', 12),
(42, 'Enchantment School', 12),
(43, 'Evocation School', 12),
(44, 'Illusion School', 12),
(45, 'Necromancy School', 12),
(46, 'Transmutation School', 12);

-- Insert data into Levels table
INSERT INTO Levels (`level`) VALUES
(0),
(1),
(2),
(3);

-- Insert data into Spells table-- Insert data into Spells table for Barbarian actions
INSERT INTO Spells (idSpell, `name`, `description`, damageType, damageRoll) VALUES
-- Cantrips
(1, "Acid Splash", "Throw a bubble of acid that damages each creature it hits.", "Acid", "1d6"),
(2, "Blade Ward", "Take only half the damage from Bludgeoning, Piercing, and Slashing attacks.", "None", "None"),
(3, "Bone Chill", "Prevent the target from healing until your next turn. An undead target receives Disadvantage on Attack rolls.", "Necrotic", "1d8"),
(4, "Dancing Light", "Creates magical orbs of light that brighten an area.", "None", "None"),
(5, "Eldritch Blast", "Conjure a beam of crackling energy. Deals Force damage to a target.", "Force", "1d10"),
(6, "Fire Bolt", "Hurl a mote of fire.", "Fire", "1d10"),
(7, "Friends", "Gain Advantage on Charisma Checks against a non-hostile creature.", "None", "None");



-- Insert data into Users table
INSERT INTO Users (username, email, `password`, profilePicture, isAdmin) VALUES
('adventurer1', 'adventurer1@example.com', 'password123', 'adventurer1_profile.jpg', 0),
('dungeonmaster', 'dm@example.com', 'dmpassword', 'dm_profile.jpg', 1);

-- Insert data into Characters table
INSERT INTO Characters (`name`, strength, dexterity, constitution, intelligence, wisdom, charisma, idSubRace, idSubClasses, idUsers) VALUES
('Thorin', 18, 12, 16, 10, 12, 8, 1, 1, 1),
('Larethian', 10, 18, 12, 16, 14, 8, 2, 2, 2);

-- Insert data into ClassesSpells table

-- Barbarian spells/actions
INSERT INTO ClassesSpells (idSpell, idSubClasses) VALUES
(1, 1),  -- Rage for Berserker
(2, 1),  -- Reckless Attack for Berserker
(3, 1),  -- Frenzy for Berserker
(4, 2),  -- Primal Surge for Wildheart
(5, 3);  -- Wild Magic Surge for Wild Magic

-- Insert data into RacesSpells table
INSERT INTO RacesSpells (idSpell, idSubRace) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4);

-- Insert data into SpellsLevel table
INSERT INTO SpellsLevel (idLevel, idSpell) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4);



CREATE USER IF NOT EXISTS "baldursscroll"@"localhost"
IDENTIFIED BY "/baldurs.scroll69(pAsSwOrD)/";

GRANT ALL PRIVILEGES ON BaldursScroll.* TO "baldursscroll"@"localhost";


COMMIT;
SET AUTOCOMMIT = 1;