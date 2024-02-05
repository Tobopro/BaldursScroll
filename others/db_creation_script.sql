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
INSERT INTO Races (`name`) VALUES
('Dwarf'),
('Elf'),
('Halfling'),
('Human'),
('Dragonborn'),
('Gnome'),
('Half-Elf'),
('Half-Orc'),
('Tiefling');

-- Insert data into Classes table
INSERT INTO Classes (`name`, startingHp, onLevelUpHp, savingThrowProficency1, savingThrowProficency2) VALUES
('Barbarian', 12, 7, 'STR', 'CON'),
('Bard', 8, 5, 'DEX', 'CHA'),
('Cleric', 8, 5, 'WIS', 'CHA'),
('Druid', 8, 5, 'INT', 'WIS'),
('Fighter', 10, 6, 'STR', 'CON'),
('Monk', 8, 5, 'STR', 'DEX'),
('Paladin', 10, 6, 'WIS', 'CHA'),
('Ranger', 10, 6, 'STR', 'DEX'),
('Rogue', 8, 5, 'DEX', 'INT'),
('Sorcerer', 6, 4, 'CON', 'CHA'),
('Warlock', 8, 5, 'WIS', 'CHA'),
('Wizard', 6, 4, 'INT', 'WIS');

-- Insert data into Levels table
INSERT INTO Levels (`level`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7),
(8),
(9),
(10);

-- Insert data into Spells table-- Insert data into Spells table for Barbarian actions
INSERT INTO Spells (idSpell, `name`, `description`, damageType, damageRoll, icon) VALUES
(1, 'Rage', 'You go into a berserker rage, gaining advantage on Strength checks and saving throws, and dealing extra damage with melee weapons.', 'None', 'None', 'rage_icon.png'),
(2, 'Reckless Attack', 'You can throw aside all concern for defense to attack with fierce desperation. When you make your first attack on your turn, you can decide to attack recklessly.', 'None', 'None', 'reckless_attack_icon.png'),
(3, 'Frenzy', 'You can go into a frenzy when you rage. If you do so, for the duration of your rage, you can make a single melee weapon attack as a bonus action on each of your turns.', 'None', 'None', 'frenzy_icon.png'),
(4, 'Primal Surge', 'As a Wildheart Barbarian, you can tap into the primal energies around you, gaining temporary hit points and a bonus to your next attack roll.', 'None', 'None', 'primal_surge_icon.png'),
(5, 'Wild Magic Surge', 'As a Wild Magic Barbarian, you embrace the chaos of magic. After you enter your rage, roll on the Wild Magic Surge table to determine the effect.', 'Magical', 'See Wild Magic Surge table', 'wild_magic_surge_icon.png');



-- Insert data into Users table
INSERT INTO Users (username, email, `password`, profilePicture, isAdmin) VALUES
('adventurer1', 'adventurer1@example.com', 'password123', 'adventurer1_profile.jpg', 0),
('dungeonmaster', 'dm@example.com', 'dmpassword', 'dm_profile.jpg', 1);

-- Insert data into SubClasses table
INSERT INTO SubClasses (`name`, icon, idClass) VALUES
('Berserker', 'berserker_icon.png', 1),
('College of Lore', 'lore_icon.png', 2),
('Life Domain', 'life_domain_icon.png', 3),
('Circle of the Moon', 'moon_icon.png', 4),
('Champion', 'champion_icon.png', 5),
('Way of the Open Hand', 'open_hand_icon.png', 6),
('Oath of Devotion', 'devotion_icon.png', 7),
('Hunter', 'hunter_icon.png', 8),
('Thief', 'thief_icon.png', 9),
('Draconic Bloodline', 'draconic_icon.png', 10),
('The Archfey', 'archfey_icon.png', 11),
('School of Evocation', 'evocation_icon.png', 12);

-- Insert data into SubRaces table
INSERT INTO SubRaces (`name`, speed, icon, idRace) VALUES
('Hill Dwarf', 9.5, 'hill_dwarf_icon.png', 1),
('High Elf', 10.5, 'high_elf_icon.png', 2),
('Lightfoot Halfling', 9.5, 'lightfoot_halfling_icon.png', 3),
('Human', 9, 'human_icon.png', 4);

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