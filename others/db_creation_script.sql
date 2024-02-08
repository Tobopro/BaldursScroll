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
-- Human
(1, 'Human', 9, 1),
-- Elf
(2, 'High Elf', 9, 2),
(3, 'Wood Elf', 10.5, 2),
-- Drow
(4, 'Lolth-Sworn Drow', 9, 3),
(5, 'Seldarine', 9, 3),
-- Half-Elf
(6, 'High Half-Elf', 9, 4),
(7, 'Wood Half-Elf', 10.5, 4),
(8, 'Drow Half-Elf', 9, 4),
-- Half-Orc
(9, 'Half-Orc', 9, 5),
-- Halfling
(10, 'Lightfoot Halfling', 7.5, 6),
(11, 'Strongheart Halfling', 7.5, 6),
-- Dwarf
(12, 'Gold Dwarf', 7.5, 7),
(13, 'Shield Dward', 7.5, 7),
(14, 'Duergar', 7.5, 7),
-- Gnome
(15, 'Forest Gnome', 7.5, 8),
(16, 'Deep Gnome', 7.5, 8),
(17, 'Rock Gnome', 7.5, 8),
-- Tiefling
(18, 'Asmodeus Tiefling', 9, 9),
(19, 'Mephistopheles Tiefling', 9, 9),
(20, 'Zariel Tiefling', 9, 9),
-- Githyanki
(21, 'Githyanki', 9, 10),
-- Dragonborn
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
-- Barbarian
(1, 'Berserker', 1),
(2, 'Wild Magic', 1),
(3, 'Wildheart', 1),
-- Bard
(4, 'College of Lore', 2),
(5, 'College of Swords', 2),
(6, 'College of Valour', 2),
-- Cleric
(7, 'Knowledge Domain', 3),
(8, 'Life Domain', 3),
(9, 'Light Domain', 3),
(10, 'Nature Domain', 3),
(11, 'Tempest Domain', 3),
(12, 'Trickery Domain', 3),
(13, 'War Domain', 3),
-- Druid
(14, 'Circle of the Land', 4),
(15, 'Circle of the Moon', 4),
(16, 'Circle of the Spores', 4),
-- Fighter
(17, 'Battle Master', 5),
(18, 'Champion', 5),
(19, 'Eldritch Knight', 5),
-- Monk
(20, 'Way of the Open Hand', 6),
(21, 'Way of Shadow', 6),
(22, 'Way of the Four Elements', 6),
-- Paladin
(23, 'Oath of the Ancients', 7),
(24, 'Oath of Devotion', 7),
(25, 'Oath of Vengeance', 7),
(26, 'Oathbreaker', 7),
-- Ranger
(27, 'Hunter', 8),
(28, 'Beast Master', 8),
(29, 'Gloom Stalker', 8),
-- Rogue
(30, 'Arcane Trickster', 9),
(31, 'Thief', 9),
(32, 'Assassin', 9),
-- Sorcerer
(33, 'Draconic Bloodline', 10),
(34, 'Wild Magic', 10),
(35, 'Storm Sorcery', 10),
-- Warlock
(36, 'The Archfey', 11),
(37, 'The Fiend', 11),
(38, 'The Great Old One', 11),
-- Wizard
(39, 'Abjuration School', 12),
(40, 'Conjuration School', 12),
(41, 'Divination School', 12),
(42, 'Enchantment School', 12),
(43, 'Evocation School', 12),
(44, 'Illusion School', 12),
(45, 'Necromancy School', 12),
(46, 'Transmutation School', 12);

-- Insert data into Levels table
INSERT INTO levels (`id`, `level`) VALUES
(1, 1),
(2, 2),
(3, 3);

-- Insert data into Spells table-- Insert data into Spells table for Barbarian actions
INSERT INTO spells (`id`, `name`, `description`, damage_type, damage_roll) VALUES
-- Cantrips
(1, "Acid Splash", "Throw a bubble of acid that damages each creature it hits.", "Acid", "1d6"),
(2, "Blade Ward", "Take only half the damage from Bludgeoning, Piercing, and Slashing attacks.", "None", "None"),
(3, "Bone Chill", "Prevent the target from healing until your next turn. An undead target receives Disadvantage on Attack rolls.", "Necrotic", "1d8"),
(4, "Dancing Light", "Creates magical orbs of light that brighten an area.", "None", "None"),
(5, "Eldritch Blast", "Conjure a beam of crackling energy. Deals Force damage to a target.", "Force", "1d10"),
(6, "Fire Bolt", "Hurl a mote of fire.", "Fire", "1d10"),
(7, "Friends", "Gain Advantage on Charisma Checks against a non-hostile creature.", "None", "None"),
(8, "Guidance", "The target gains +1d4 bonus to Ability Checks.", "None", "None"),
(9, "Light", "Infuse an object with an aura of light.", "None", "None"),
(10, "Mage Hand", "Create a spectral hand that can manipulate and interact with objects.", "None", "None"),
(11, "Minor Illusion", "Create an illusion that compels nearby creatures to investigate.", "None", "None"),
(12, "Poison Spray", "Project a puff of noxious gas, dealing Poison dmage to a target.", "Poison", "1d12"),
(13, "Produce Flame", "A flame in your hand sheds a light in a radius and deals Fire damage when thrown.", "Fire", "1d8"),
(14, "Ray of Frost", "It deals Cold damage to the target and slows it down.", "Cold", "1d8"),
(15, "Resistance", "Make a target more resistant to spell effects and conditions: it receives a +1d4 bonus to Saving throws.", "None", "None"),
(16, "Sacred Flame", "Engulf a target in a flame-like radiance.", "Sacred", "1d8"),
(17, "Shillelagh", "Your staff or club becomes magical: it deals 1d8 + Wisdom ModifierDamage Bludgeoning damage, and uses your Spellcasting Ability for Attack rolls.", "None", "None"),
(18, "Shocking Grasp", " It makes a melee attack that inflictsDamage Types Lightning damage and prevents the target from taking Reactions. This spell has Advantage Icon.png Advantage on creatures with metal Armour.", "Lightning", "1d8"),
(19, "Thaumaturgy", "Gain Advantage on Intimidation and Performance Checks.", "None", "None"),
(20, "Thorn Whip", "It deals damage to a target and pulls it closer to the caster.", "Piercing", "1d6"),
(21, "True Strike", "Gain Advantage on your next Attack roll.", "None", "None"),
(22, "Vicious Mockery", "It deals Psychic damage to enemies and inflicts Disadvantage on their Attack Rolls.", "Psychic", "1d4"),
-- Level 1 Spells
(23, "Animal Friendship", "Convince a beast not to attack you.", "None", "None"),
(24, "Armour of Agathys", "Gain 5 temporary hit points and deal 5 Cold damage to any creature that hits you with a melee attack.", "None", "None"),
(25, "Arms of Hadar", "This spell allows the caster to summon dark tendrils and deal Necrotic damage to enemies in an area centered on the caster, preventing them from taking Reactions.", "Necrotic", "2d6"),
(26, "Bane", "Up to 3 creatures receive a -1d4 penalty to Attack rolls and Saving throws.", "None", "None"),
(27, "Bless", "Bless up to 3 creatures. They gain a +1d4 bonus to Attack rolls and Saving throws.", "None", "None"),
(28, "Burning Hands", "It allows spellcasters to shoot a flaming cone from their fingertips and deal Fire damage to enemies.", "Fire", "3d6"),
(29, "Charm Person", "Blind creatures up to a combined 33 Hit Points.", "None", "None"),
(30, "Chromatic Orb", "Hurl a sphere of energy. It deals 3d8 Thunder damage, or 2d8 Acid ,Cold ,Fire ,Lightning or Poison damage and creates a surface.", "Multiples", "3d8"),
(31, "Colour Spray", "Gain Advantage on Charisma Checks against a non-hostile creature.", "None", "None"),
(32, "Command", "Command a creature to flee, move closer, freeze, drop to the ground or drop its weapon. The target must succeed on a Wisdom saving throw in order to resist the effects.", "None", "None"),
(33, "Compelled Duel", "Force an enemy to attack only you, giving it Disadvantage against other targets.", "None", "None"),
(34, "Create or Destroy Water", "Choose to call forth rain or destroy a water-based surface.", "None", "None"),
(35, "Cure Wounds", "This spell allows spellcasters to heal allies with divine magic through touch.", "Heal", "1d8 + Spellcasting modifier"),
(36, "Disguise Self", "This spell allows spellcasters to temporarily change their appearance. While active, gain access to the action Dispel Disguise to end the effect.", "Ritual", "None"),
(37, "Dissonant Whispers", "This spell allows spellcasters to fill a target with terror and deal Psychic damage to them.", "Psychic", "3d6"),
(38, "Divine Favour", "Your prayer empowers you with divine radiance. Your weapons deal an additional 1d4Damage TypesRadiant damage.", "None", "None"),
(39, "Enhance Leap", "This spell allows spellcasters to increase a creature's Jumping distance.", "Ritual", "None"),
(40, "Ensnaring Strike", "This spell allows spellcasters to use ranged weapon attacks to ensnare enemies with thorny vines and deal Piercing damage to them each turn.", "None", "None"),
(41, "Entangle", "This spell allows spellcasters to conjure magical vines and turn an area within range into difficult terrain. Creatures are possibly Entangled and move at half speed while standing in this area.", "None", "None"),
(42, "Expeditious Retreat", "Gain Dash immediately and as a bonus action on each of your turns until this spell ends.", "None", "None"),
(43, "Faerie Fire", "All targets within the light turn visible, and Attack rolls against them have Advantage.", "None", "None"),
(44, "False Life", "Bolster yourself with a necromantic facsimile of life to gain 7 temporary hit points.", "None", "None"),
(45, "Feather Fall", "You and nearby allies gain Immunity to Falling damage.", "Ritual", "None"),
(46, "Find Familiar", "Summon a familiar, a fey spirit that takes an animal form of your choosing.", "Ritual", "None"),
(47, "Fog Cloud", "It allows spellcasters to summon a sphere of fog on an area in range and heavily obscure the area. Creatures within the area are Blinded.", "None", "None"),
(48, "Goodberry", "Conjure four magical berries for yourself or a companion. Creatures who eat a berry regain 1d4 hit points.", "None", "None"),
(49, "Grease", "Cover the ground in flammable grease. It becomes Difficult Terrain and creatures within can fall Prone.", "None", "None"),
(50, "Guiding Bolt", " This spell allows spellcasters to hit enemies with radiant bolt that deals Radiant damage and grants advantage to attack rolls made against them.", "Radiant", "4d6"),
(51, "Hail of Thorns", "Shoot a volley of thorns. The thorns deal weapon damage to the target and then explode. The explosion deals an additional 1d10 Piercing damage to the target and surrounding creatures. On miss, the thorns still explode.", "Piercing", "1d10"),
(52, "Healing Word", "This spell allows spellcasters to heal allies that they can see within range.", "Heal", "1d4 + Spellcasting modifier"),
(53, "Hellish Rebuke", "This spell allows spellcasters to surround a creature in hellfire that deals Fire damage as a Reaction when taking damage from them.", "Fire", "2d10"),
(54, "Heroism", "This spell allows spellcasters to instill themselves or an ally with courage. The affected creature cannot be Frightened and gains Temporary Hit Points.", "None", "None"),
(55, "Hex", "Make your attacks deal an additional 1d6 Necrotic damage to the target and give it Disadvantage on Checks on an Ability of your choosing. If the target dies before the spell ends, you can Reapply Hex to a new creature without expending a Spell Slot.", "Necrotic", "1d6"),
(56, "Hunter's Mark", "Mark a creature as your quarry to deal an additional 1d6 Physical damage whenever you hit it with a weapon attack. If the target dies before the spell ends, you can use Reapply Hunter's Mark to mark a new creature.", "None", "None"),
(57, "Ice Knife", "Throw a shard of ice that deals 1d10 Piercing damage. It explodes and deals 2d6 Cold damage to anyone nearby. It leaves an Ice Surface. On miss, the shard of ice still explodes.", "Piercing + Cold", "1d10 + 2d6"),
(58, "Inflict Wounds", "This spell allows the spellcaster to make a melee attack that inflicts Necrotic damage.", "Necrotic", "3d10"),
(59, "Longstrider", "Increase a creature's Movement Speed by 3 m.", "Ritual", "None"),
(60, "Mage Armour", "Surround an unarmoured creature in a protective magical force. Its Armour Class increases to 13 + its Dexterity modifier. Prerequisite: The target can't be wearing Armour.", "None", "None"),
(61, "Magic Missiles", "Create three darts of magical force, each dealing 1d4 + 1 damage to its target. The darts always hit their target, and can each be targeted individually.", "Force", "1d4 + 1"),
(62, "Protection from Evil and Good", "Protect an ally against the attacks and powers of Aberrations, Celestials, Elementals, Fey, Fiends, and Undead. The targets can't be Charmed, Frightened, or possessed by them, and when these creatures attack it, they have Disadvantage.", "None", "None"),
(63, "Ray of Sickness", "This spell allows spellcasters to hit enemies with a ray of nauseating energy that deals Poison damage, and potentially Poisons them.", "Poison", "2d8"),
(64, "Sanctuary", "You or an ally cannot be targeted until you attack or harm a creature. You can still take damage from area spells.", "None", "None"),
(65, "Searing Smite", "Your weapon flares with white-hot intensity. It deals, on top of weapon damage, an extra 1d6 Fire damage and marks the target with Searing Smite.", "Fire", "1d6"),
(66, "Shield", "When you are about to be hit by an enemy, use your Reaction to increase your Armour Class by 5. You also take no damage from Magic Missile. These effects last until the start of your next turn.", "None", "None"),
(67, "Shield of Faith", "Surround a creature with a shimmering field of magic that increases its Armour Class by 2.", "None", "None"),
(68, "Sleep", "Put creatures into a magical slumber. Select targets up to a combined 24 Hit Points.", "None", "None"),
(69, "Speak with Animals", "This spell allows spellcasters to understand and talk to beasts and animals for a day.", "Ritual", "None"),
(70, "Tasha's Hideous Laughter", "It allows spellcasters to send a targeted creature into a fit of laughter, falling Prone.", "None", "None"),
(71, "Thunderous Smite", "This spell allows spellcasters to cause their weapon to ring with Thunder as they strike, pushing targets away and potentially knocking them Prone.", "Thunder", "2d6"),
(72, "Thunderwave", "Release a wave of thunderous force that pushes away all creatures and objects in an area, while also dealing Thunder damage.", "Thunder", "2d8"),
(73, "Witch Bolt", "Link yourself to a target with a bolt of lightning. Deal an additional 1d12 Lightning damage each turn by activating it.", "Lightning", "1d12"),
(74, "Wrathful Smite", "This spell allows spellcasters to channel their wrath through their melee weapon, possibly Frightened their target on hit.", "Psychic", "1d6");



-- Insert data into Users table
INSERT INTO users (`id`, username, email, `password`, sign_in_date, profile_picture, is_banned, is_admin) VALUES
(1, 'adventurer1', 'adventurer1@example.com', 'password123', NOW(), '', 0, 0),
(2, 'dungeonmaster', 'dm@example.com', 'dmpassword', Now(), '', 0, 1);

-- Insert data into Characters table
INSERT INTO `characters` (`id`, `name`, strength, dexterity, constitution, intelligence, wisdom, charisma, ability_score_bonus1, ability_score_bonus2, id_sub_race_id, id_sub_classes_id, id_users_id) VALUES
(1, "Astarion", 8, 15, 14, 12, 13, 10, "AGI", "INT" 2, 30, 1),
(2, "Gale", 8, 13, 14, 10, 12, 8, "INT", "CON", 1, 39, 1),
(3, "Karlach", 15, 13, 14, 8, 12, 10, "STR", "CON", 20, 1, 1),
(4, "Lae'zel", 15, 13, 14, 10, 12, 8, "STR", "CON", 21, 17, 1),
(5, "Shadowheart", 13, 12, 14, 10, 17, 8, "WIS", "AGI", 6, 12, 1),
(6, "Wyll", 8, 13, 14, 12, 10, 15, "CHA", "INT", 1, 37, 1),
(7, "Dark Urge", 8, 13, 14, 12, 10, 15, "CHA", "CON", 31, 33, 1);


-- Insert data into ClassesSpells table
INSERT INTO classes_spells (`id`, id_spell_id, id_sub_classes_id, id_level_id) VALUES
-- Acid Splash
(1, 1, 33, 1),
(1, 1, 34, 1),
(1, 1, 35, 1),
(1, 1, 35, 1),
(1, 1, 35, 1),
(1, 1, 35, 1),

-- Insert data into RacesSpells table
INSERT INTO RacesSpells (idSpell, idSubRace) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4);

-- Insert data into SpellsLevel table
-- INSERT INTO SpellsLevel (idLevel, idSpell) VALUES
-- (1, 1),
-- (2, 2),
-- (3, 3),
-- (4, 4);



CREATE USER IF NOT EXISTS "baldursscroll"@"localhost"
IDENTIFIED BY "/baldurs.scroll69(pAsSwOrD)/";

GRANT ALL PRIVILEGES ON BaldursScroll.* TO "baldursscroll"@"localhost";


COMMIT;
SET AUTOCOMMIT = 1;