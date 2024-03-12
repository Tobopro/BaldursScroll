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


CREATE USER IF NOT EXISTS "baldursscroll"@"localhost"
IDENTIFIED BY "/baldurs.scroll69(pAsSwOrD)/";

GRANT ALL PRIVILEGES ON BaldursScroll.* TO "baldursscroll"@"localhost";

CREATE USER IF NOT EXISTS "baldursscrolldb"
IDENTIFIED BY "tesT_123_Test";

GRANT ALL PRIVILEGES ON BaldursScroll.* TO "baldursscrolldb";


COMMIT;
SET AUTOCOMMIT = 1;