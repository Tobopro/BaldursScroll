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
-- Cantrips ###########################
-- Acid Splash ###########################
-- Sorcerer sub-classes
(1, 1, 33, 1),
(1, 1, 34, 1),
(1, 1, 35, 1),
-- Wizard sub-classes
(1, 1, 39, 1),
(1, 1, 40, 1),
(1, 1, 41, 1),
(1, 1, 42, 1),
(1, 1, 43, 1),
(1, 1, 44, 1),
(1, 1, 45, 1),
(1, 1, 46, 1),
-- Eldritch Knight Fighter / Arcane Trickster Rogue Lvl3
(1, 1, 30, 3),
(1, 1, 19, 3),
-- Blade Ward ###########################
-- Bard
(2, 2, 4, 1),
(2, 2, 5, 1),
(2, 2, 6, 1),
-- Cleric
(2, 2, 7, 1),
(2, 2, 8, 1),
(2, 2, 9, 1),
(2, 2, 10, 1),
(2, 2, 11, 1),
(2, 2, 12, 1),
(2, 2, 13, 1),
-- Sorcerer
(2, 2, 33, 1),
(2, 2, 34, 1),
(2, 2, 35, 1),
-- Wizard
(2, 2, 39, 1),
(2, 2, 40, 1),
(2, 2, 41, 1),
(2, 2, 42, 1),
(2, 2, 43, 1),
(2, 2, 44, 1),
(2, 2, 45, 1),
(2, 2, 46, 1),
-- Eldritch Knight Fighter / Arcane Trickster Rogue Lvl3
(2, 2, 30, 3),
(2, 2, 19, 3),
-- Bone Chill ###########################
-- Sorcerer
(3, 3, 33, 1),
(3, 3, 34, 1),
(3, 3, 35, 1),
-- Warlock
(3, 3, 36, 1),
(3, 3, 37, 1),
(3, 3, 38, 1),
-- Wizard
(3, 3, 39, 1),
(3, 3, 40, 1),
(3, 3, 41, 1),
(3, 3, 42, 1),
(3, 3, 43, 1),
(3, 3, 44, 1),
(3, 3, 45, 1),
(3, 3, 46, 1),
-- Spore Druid Lvl2
(3, 3, 16, 2),
-- Eldritch Knight Fighter / Arcane Trickster Rogue Lvl3
(3, 3, 30, 3),
(3, 3, 19, 3),
-- Dancing Lights ###########################
-- Bard
(4, 4, 4, 1),
(4, 4, 5, 1),
(4, 4, 6, 1),
-- Sorcerer
(4, 4, 33, 1),
(4, 4, 34, 1),
(4, 4, 35, 1),
-- Wizard
(4, 4, 39, 1),
(4, 4, 40, 1),
(4, 4, 41, 1),
(4, 4, 42, 1),
(4, 4, 43, 1),
(4, 4, 44, 1),
(4, 4, 45, 1),
(4, 4, 46, 1),
-- Eldritch Knight Fighter / Arcane Trickster Rogue Lvl3
(4, 4, 30, 3),
(4, 4, 19, 3),
-- Eldritch Blast ###########################
-- Warlock
(5, 5, 36, 1),
(5, 5, 37, 1),
(5, 5, 38, 1),
-- Fire Bolt ###########################
-- Sorcerer
(6, 6, 33, 1),
(6, 6, 34, 1),
(6, 6, 35, 1),
-- Wizard
(6, 6, 39, 1),
(6, 6, 40, 1),
(6, 6, 41, 1),
(6, 6, 42, 1),
(6, 6, 43, 1),
(6, 6, 44, 1),
(6, 6, 45, 1),
(6, 6, 46, 1),
-- Eldritch Knight Fighter / Arcane Trickster Rogue Lvl3
(6, 6, 30, 3),
(6, 6, 19, 3),
-- Friends ###########################
-- Bard
(7, 7, 4, 1),
(7, 7, 5, 1),
(7, 7, 6, 1),
-- Sorcerer
(7, 7, 33, 1),
(7, 7, 34, 1),
(7, 7, 35, 1),
-- Warlock
(7, 7, 36, 1),
(7, 7, 37, 1),
(7, 7, 38, 1),
-- Wizard
(7, 7, 39, 1),
(7, 7, 40, 1),
(7, 7, 41, 1),
(7, 7, 42, 1),
(7, 7, 43, 1),
(7, 7, 44, 1),
(7, 7, 45, 1),
(7, 7, 46, 1),
-- Eldritch Knight Fighter / Arcane Trickster Rogue Lvl3
(7, 7, 30, 3),
(7, 7, 19, 3),
-- Guidance ###########################
-- Cleric
(8, 8, 7, 1),
(8, 8, 8, 1),
(8, 8, 9, 1),
(8, 8, 10, 1),
(8, 8, 11, 1),
(8, 8, 12, 1),
(8, 8, 13, 1),
-- Druid
(8, 8, 14, 1),
(8, 8, 15, 1),
(8, 8, 16, 1),
-- Light ###########################
-- Bard
(9, 9, 4, 1),
(9, 9, 5, 1),
(9, 9, 6, 1),
-- Cleric
(9, 9, 7, 1),
(9, 9, 8, 1),
(9, 9, 9, 1),
(9, 9, 10, 1),
(9, 9, 11, 1),
(9, 9, 12, 1),
(9, 9, 13, 1),
-- Sorcerer
(9, 9, 33, 1),
(9, 9, 34, 1),
(9, 9, 35, 1),
-- Wizard
(9, 9, 39, 1),
(9, 9, 40, 1),
(9, 9, 41, 1),
(9, 9, 42, 1),
(9, 9, 43, 1),
(9, 9, 44, 1),
(9, 9, 45, 1),
(9, 9, 46, 1),
-- Eldritch Knight Fighter / Arcane Trickster Rogue Lvl3
(9, 9, 30, 3),
(9, 9, 19, 3),
-- Mage Hand ###########################
-- Bard
(10, 10, 4, 1),
(10, 10, 5, 1),
(10, 10, 6, 1),
-- Sorcerer
(10, 10, 33, 1),
(10, 10, 34, 1),
(10, 10, 35, 1),
-- Warlock
(10, 10, 36, 1),
(10, 10, 37, 1),
(10, 10, 38, 1),
-- Wizard
(10, 10, 39, 1),
(10, 10, 40, 1),
(10, 10, 41, 1),
(10, 10, 42, 1),
(10, 10, 43, 1),
(10, 10, 44, 1),
(10, 10, 45, 1),
(10, 10, 46, 1),
-- Eldritch Knight Fighter / Arcane Trickster Rogue Lvl3
(10, 10, 30, 3),
(10, 10, 19, 3),
-- Minor Illusion ###########################
-- Bard
(11, 11, 4, 1),
(11, 11, 5, 1),
(11, 11, 6, 1),
-- Sorcerer
(11, 11, 33, 1),
(11, 11, 34, 1),
(11, 11, 35, 1),
-- Warlock
(11, 11, 36, 1),
(11, 11, 37, 1),
(11, 11, 38, 1),
-- Wizard
(11, 11, 39, 1),
(11, 11, 40, 1),
(11, 11, 41, 1),
(11, 11, 42, 1),
(11, 11, 43, 1),
(11, 11, 44, 1),
(11, 11, 45, 1),
(11, 11, 46, 1),
-- Eldritch Knight Fighter / Arcane Trickster Rogue / Way of Shadow Monk Lvl3
(11, 11, 30, 3),
(11, 11, 19, 3),
(11, 11, 21, 3),
-- Poison Spray ###########################
-- Cleric
(12, 12, 10, 1),
-- Druid
(12, 12, 14, 1),
(12, 12, 15, 1),
(12, 12, 16, 1),
-- Sorcerer
(12, 12, 33, 1),
(12, 12, 34, 1),
(12, 12, 35, 1),
-- Warlock
(12, 12, 36, 1),
(12, 12, 37, 1),
(12, 12, 38, 1),
-- Wizard
(12, 12, 39, 1),
(12, 12, 40, 1),
(12, 12, 41, 1),
(12, 12, 42, 1),
(12, 12, 43, 1),
(12, 12, 44, 1),
(12, 12, 45, 1),
(12, 12, 46, 1),
-- Eldritch Knight Fighter / Arcane Trickster Rogue Lvl3
(12, 12, 30, 3),
(12, 12, 19, 3),
-- Produce Flame ###########################
-- Cleric
(13, 13, 7, 1),
(13, 13, 8, 1),
(13, 13, 9, 1),
(13, 13, 10, 1),
(13, 13, 11, 1),
(13, 13, 12, 1),
(13, 13, 13, 1),
-- Druid
(13, 13, 14, 1),
(13, 13, 15, 1),
(13, 13, 16, 1),
-- Ray of Frost ###########################
-- Sorcerer
(14, 14, 33, 1),
(14, 14, 34, 1),
(14, 14, 35, 1),
-- Wizard
(14, 14, 39, 1),
(14, 14, 40, 1),
(14, 14, 41, 1),
(14, 14, 42, 1),
(14, 14, 43, 1),
(14, 14, 44, 1),
(14, 14, 45, 1),
(14, 14, 46, 1),
-- Eldritch Knight Fighter / Arcane Trickster Rogue Lvl3
(14, 14, 30, 3),
(14, 14, 19, 3),
-- Resistance ###########################
-- Cleric
(15, 15, 7, 1),
(15, 15, 8, 1),
(15, 15, 9, 1),
(15, 15, 10, 1),
(15, 15, 11, 1),
(15, 15, 12, 1),
(15, 15, 13, 1),
-- Druid
(15, 15, 14, 1),
(15, 15, 15, 1),
(15, 15, 16, 1),
-- Sacred Flame ###########################
-- Cleric
(16, 16, 7, 1),
(16, 16, 8, 1),
(16, 16, 9, 1),
(16, 16, 10, 1),
(16, 16, 11, 1),
(16, 16, 12, 1),
(16, 16, 13, 1),
-- Ranger
(16, 16, 27, 1),
(16, 16, 28, 1),
(16, 16, 29, 1),
-- Shillelagh ###########################
-- Druid
(17, 17, 14, 1),
(17, 17, 15, 1),
(17, 17, 16, 1),
-- Cleric
(17, 17, 10, 1),
-- Shocking Grasp ###########################
-- Sorcerer
(18, 18, 33, 1),
(18, 18, 34, 1),
(18, 18, 35, 1),
-- Wizard
(18, 18, 39, 1),
(18, 18, 40, 1),
(18, 18, 41, 1),
(18, 18, 42, 1),
(18, 18, 43, 1),
(18, 18, 44, 1),
(18, 18, 45, 1),
(18, 18, 46, 1),
-- Eldritch Knight Fighter / Arcane Trickster Rogue Lvl3
(18, 18, 30, 3),
(18, 18, 19, 3),
-- Thaumaturgy ###########################
-- Cleric
(19, 19, 7, 1),
(19, 19, 8, 1),
(19, 19, 9, 1),
(19, 19, 10, 1),
(19, 19, 11, 1),
(19, 19, 12, 1),
(19, 19, 13, 1),
-- Thorn Whip ###########################
-- Druid
(20, 20, 14, 1),
(20, 20, 15, 1),
(20, 20, 16, 1),
-- Cleric
(20, 20, 10, 1),
-- True Strike ###########################
-- Bard
(21, 21, 4, 1),
(21, 21, 5, 1),
(21, 21, 6, 1),
-- Sorcerer
(21, 21, 33, 1),
(21, 21, 34, 1),
(21, 21, 35, 1),
-- Warlock
(21, 21, 36, 1),
(21, 21, 37, 1),
(21, 21, 38, 1),
-- Wizard
(21, 21, 39, 1),
(21, 21, 40, 1),
(21, 21, 41, 1),
(21, 21, 42, 1),
(21, 21, 43, 1),
(21, 21, 44, 1),
(21, 21, 45, 1),
(21, 21, 46, 1),
-- Eldritch Knight Fighter / Arcane Trickster Rogue Lvl3
(21, 21, 30, 3),
(21, 21, 19, 3),
-- Vicious Mockery ###########################
-- Bard
(22, 22, 4, 1),
(22, 22, 5, 1),
(22, 22, 6, 1),
--  ########################### ###########################
-- Spells lvl 1 ###########################
-- Animal Friendship ###########################
-- Bard
(23, 23, 4, 1),
(23, 23, 5, 1),
(23, 23, 6, 1),
-- Druid
(23, 23, 14, 1),
(23, 23, 15, 1),
(23, 23, 16, 1),
-- Cleric
(23, 23, 10, 1),
-- Ranger Lvl 2
(23, 23, 27, 2),
(23, 23, 28, 2),
(23, 23, 29, 2),
-- Armour of Agathys ###########################
-- Sorcerer
(24, 24, 33, 1),
-- Warlock
(24, 24, 36, 1),
(24, 24, 37, 1),
(24, 24, 38, 1),
-- Arms of Hadar ###########################
-- Warlock
(25, 25, 36, 1),
(25, 25, 37, 1),
(25, 25, 38, 1),
-- Bane ###########################
-- Bard
(26, 26, 4, 1),
(26, 26, 5, 1),
(26, 26, 6, 1),
-- Cleric
(26, 26, 7, 1),
(26, 26, 8, 1),
(26, 26, 9, 1),
(26, 26, 10, 1),
(26, 26, 11, 1),
(26, 26, 12, 1),
(26, 26, 13, 1),
-- Paladin
(26, 26, 25, 1),
-- Bless ###########################
-- Cleric
(27, 27, 7, 1),
(27, 27, 8, 1),
(27, 27, 9, 1),
(27, 27, 10, 1),
(27, 27, 11, 1),
(27, 27, 12, 1),
(27, 27, 13, 1),
-- Paladin
(27, 27, 23, 2),
(27, 27, 24, 2),
(27, 27, 25, 2),
(27, 27, 26, 2),
-- Burning Hands ###########################
-- Cleric
(28, 28, 9, 1),
-- Sorcerer
(28, 28, 33, 1),
(28, 28, 34, 1),
(28, 28, 35, 1),
-- Warlock
(28, 28, 37, 1),
-- Wizard
(28, 28, 39, 1),
(28, 28, 40, 1),
(28, 28, 41, 1),
(28, 28, 42, 1),
(28, 28, 43, 1),
(28, 28, 44, 1),
(28, 28, 45, 1),
(28, 28, 46, 1),
-- Eldritch Knight Fighter / Arcane Trickster Rogue Lvl3
(28, 28, 30, 3),
(28, 28, 19, 3),
-- Charm Person ###########################
-- Bard
(29, 29, 4, 1),
(29, 29, 5, 1),
(29, 29, 6, 1),
-- Cleric
(29, 29, 12, 1),
-- Druid
(29, 29, 14, 1),
(29, 29, 15, 1),
(29, 29, 16, 1),
-- Sorcerer
(29, 29, 33, 1),
(29, 29, 34, 1),
(29, 29, 35, 1),
-- Warlock
(29, 29, 36, 1),
(29, 29, 37, 1),
(29, 29, 38, 1),
-- Wizard
(29, 29, 39, 1),
(29, 29, 40, 1),
(29, 29, 41, 1),
(29, 29, 42, 1),
(29, 29, 43, 1),
(29, 29, 44, 1),
(29, 29, 45, 1),
(29, 29, 46, 1),
-- Eldritch Knight Fighter / Arcane Trickster Rogue Lvl3
(29, 29, 30, 3),
(29, 29, 19, 3),
-- Chromatic Orb ###########################
-- Sorcerer
(30, 30, 33, 1),
(30, 30, 34, 1),
(30, 30, 35, 1),
-- Wizard
(30, 30, 39, 1),
(30, 30, 40, 1),
(30, 30, 41, 1),
(30, 30, 42, 1),
(30, 30, 43, 1),
(30, 30, 44, 1),
(30, 30, 45, 1),
(30, 30, 46, 1),
-- Eldritch Knight Fighter / Arcane Trickster Rogue Lvl3
(30, 30, 30, 3),
(30, 30, 19, 3),
-- Colour Spray ###########################
-- Sorcerer
(31, 31, 33, 1),
(31, 31, 34, 1),
(31, 31, 35, 1),
-- Wizard
(31, 31, 39, 1),
(31, 31, 40, 1),
(31, 31, 41, 1),
(31, 31, 42, 1),
(31, 31, 43, 1),
(31, 31, 44, 1),
(31, 31, 45, 1),
(31, 31, 46, 1),
-- Eldritch Knight Fighter / Arcane Trickster Rogue Lvl3
(31, 31, 30, 3),
(31, 31, 19, 3),
-- Command ###########################
-- Cleric
(32, 32, 7, 1),
(32, 32, 8, 1),
(32, 32, 9, 1),
(32, 32, 10, 1),
(32, 32, 11, 1),
(32, 32, 12, 1),
(32, 32, 13, 1),
-- Warlock
(32, 32, 37, 1),
-- Paladin Lvl2
(32, 32, 23, 2),
(32, 32, 24, 2),
(32, 32, 25, 2),
(32, 32, 26, 2),
-- Compelled Duel ###########################
-- Paladin
(33, 33, 23, 2),
(33, 33, 24, 2),
(33, 33, 25, 2),
(33, 33, 26, 2),
-- Create or Destroy Water ###########################
-- Cleric
(34, 34, 7, 1),
(34, 34, 8, 1),
(34, 34, 9, 1),
(34, 34, 10, 1),
(34, 34, 11, 1),
(34, 34, 12, 1),
(34, 34, 13, 1),
-- Druid
(34, 34, 14, 1),
(34, 34, 15, 1),
(34, 34, 16, 1),
-- Wizard
(34, 34, 40, 2),
-- Cure Wounds ###########################
-- Bard
(35, 35, 4, 1),
(35, 35, 5, 1),
(35, 35, 6, 1),
-- Cleric
(35, 35, 7, 1),
(35, 35, 8, 1),
(35, 35, 9, 1),
(35, 35, 10, 1),
(35, 35, 11, 1),
(35, 35, 12, 1),
(35, 35, 13, 1),
-- Druid
(35, 35, 14, 1),
(35, 35, 15, 1),
(35, 35, 16, 1),
-- Paladin Lvl2
(35, 35, 23, 2),
(35, 35, 24, 2),
(35, 35, 25, 2),
(35, 35, 26, 2),
-- Ranger Lvl2
(35, 35, 27, 2),
(35, 35, 28, 2),
(35, 35, 29, 2),
-- Disguise Self ###########################
-- Bard
(36, 36, 4, 1),
(36, 36, 5, 1),
(36, 36, 6, 1),
-- Cleric
(36, 36, 12, 1),
-- Sorcerer
(36, 36, 33, 1),
(36, 36, 34, 1),
(36, 36, 35, 1),
-- Wizard
(36, 36, 39, 1),
(36, 36, 40, 1),
(36, 36, 41, 1),
(36, 36, 42, 1),
(36, 36, 43, 1),
(36, 36, 44, 1),
(36, 36, 45, 1),
(36, 36, 46, 1),
-- Eldritch Knight Fighter / Arcane Trickster Rogue / Gloom Stalker Ranger Lvl3
(36, 36, 30, 3),
(36, 36, 19, 3),
(36, 36, 29, 3),
-- Dissonant Whispers ###########################
-- Bard
(37, 37, 4, 1),
(37, 37, 5, 1),
(37, 37, 6, 1),
-- Warlock
(37, 37, 38, 1),
-- Divine Favour ###########################
-- Cleric
(38, 38, 13, 1),
-- Paladin Lvl2
(38, 38, 23, 2),
(38, 38, 24, 2),
(38, 38, 25, 2),
(38, 38, 26, 2),
-- Enhance Leap ###########################
-- Druid
(39, 39, 14, 1),
(39, 39, 15, 1),
(39, 39, 16, 1),
-- Sorcerer
(39, 39, 33, 1),
(39, 39, 34, 1),
(39, 39, 35, 1),
-- Wizard
(39, 39, 39, 1),
(39, 39, 40, 1),
(39, 39, 41, 1),
(39, 39, 42, 1),
(39, 39, 43, 1),
(39, 39, 44, 1),
(39, 39, 45, 1),
(39, 39, 46, 1),
-- Ranger Lvl2
(39, 39, 27, 2),
(39, 39, 28, 2),
(39, 39, 29, 2),
-- Eldritch Knight Fighter / Arcane Trickster Rogue Lvl3
(39, 39, 30, 3),
(39, 39, 19, 3),
-- Ensnaring Strike ###########################
-- No one ??
-- Entangle ###########################
-- Druid
(41, 41, 14, 1),
(41, 41, 15, 1),
(41, 41, 16, 1),
-- Expeditious Retreat ###########################
-- Sorcerer
(42, 42, 33, 1),
(42, 42, 34, 1),
(42, 42, 35, 1),
-- Warlock
(42, 42, 36, 1),
(42, 42, 37, 1),
(42, 42, 38, 1),
-- Wizard
(42, 42, 39, 1),
(42, 42, 40, 1),
(42, 42, 41, 1),
(42, 42, 42, 1),
(42, 42, 43, 1),
(42, 42, 44, 1),
(42, 42, 45, 1),
(42, 42, 46, 1),
-- Eldritch Knight Fighter / Arcane Trickster Rogue Lvl3
(42, 42, 30, 3),
(42, 42, 19, 3),
-- Faerie Fire ###########################
-- Bard
(43, 43, 4, 1),
(43, 43, 5, 1),
(43, 43, 6, 1),
-- Cleric
(43, 43, 9, 1),
-- Druid
(43, 43, 14, 1),
(43, 43, 15, 1),
(43, 43, 16, 1),
-- Warlock
(43, 43, 36, 1),
-- False Life ###########################
-- Sorcerer
(44, 44, 33, 1),
(44, 44, 34, 1),
(44, 44, 35, 1),
-- Wizard
(44, 44, 39, 1),
(44, 44, 40, 1),
(44, 44, 41, 1),
(44, 44, 42, 1),
(44, 44, 43, 1),
(44, 44, 44, 1),
(44, 44, 45, 1),
(44, 44, 46, 1),
-- Eldritch Knight Fighter / Arcane Trickster Rogue Lvl3
(44, 44, 30, 3),
(44, 44, 19, 3),
-- Feather Fall ###########################
-- Bard
(45, 45, 4, 1),
(45, 45, 5, 1),
(45, 45, 6, 1),
-- Sorcerer
(45, 45, 33, 1),
(45, 45, 34, 1),
(45, 45, 35, 1),
-- Wizard
(45, 45, 39, 1),
(45, 45, 40, 1),
(45, 45, 41, 1),
(45, 45, 42, 1),
(45, 45, 43, 1),
(45, 45, 44, 1),
(45, 45, 45, 1),
(45, 45, 46, 1),
-- Eldritch Knight Fighter / Arcane Trickster Rogue Lvl3
(45, 45, 30, 3),
(45, 45, 19, 3),
-- Find Familiar ###########################
-- Ranger
(46, 46, 27, 1),
(46, 46, 28, 1),
(46, 46, 29, 1),
-- Wizard
(46, 46, 39, 1),
(46, 46, 40, 1),
(46, 46, 41, 1),
(46, 46, 42, 1),
(46, 46, 43, 1),
(46, 46, 44, 1),
(46, 46, 45, 1),
(46, 46, 46, 1),
-- Eldritch Knight Fighter / Arcane Trickster Rogue Lvl3
(46, 46, 30, 3),
(46, 46, 19, 3),
-- Fog Cloud ###########################
-- Bard
(47, 47, 4, 1),
(47, 47, 5, 1),
(47, 47, 6, 1),
-- Cleric
(47, 47, 11, 1),
-- Sorcerer
(47, 47, 33, 1),
(47, 47, 34, 1),
(47, 47, 35, 1),
-- Wizard
(47, 47, 39, 1),
(47, 47, 40, 1),
(47, 47, 41, 1),
(47, 47, 42, 1),
(47, 47, 43, 1),
(47, 47, 44, 1),
(47, 47, 45, 1),
(47, 47, 46, 1),
-- Ranger Lvl2
(47, 47, 27, 2),
(47, 47, 28, 2),
(47, 47, 29, 2),
-- Eldritch Knight Fighter / Arcane Trickster Rogue Lvl3
(47, 47, 30, 3),
(47, 47, 19, 3),
-- Goodberry ###########################
-- Druid
(48, 48, 14, 1),
(48, 48, 15, 1),
(48, 48, 16, 1),
-- Ranger Lvl2
(48, 48, 27, 2),
(48, 48, 28, 2),
(48, 48, 29, 2),
-- Grease ###########################
-- Sorcerer
(49, 49, 33, 1),
-- Wizard
(49, 49, 39, 1),
(49, 49, 40, 1),
(49, 49, 41, 1),
(49, 49, 42, 1),
(49, 49, 43, 1),
(49, 49, 44, 1),
(49, 49, 45, 1),
(49, 49, 46, 1),
-- Eldritch Knight Fighter / Arcane Trickster Rogue Lvl3
(49, 49, 30, 3),
(49, 49, 19, 3),
-- Guiding Light ###########################
-- Cleric
(50, 50, 7, 1),
(50, 50, 8, 1),
(50, 50, 9, 1),
(50, 50, 10, 1),
(50, 50, 11, 1),
(50, 50, 12, 1),
(50, 50, 13, 1),
-- Hail of Thorns ###########################
-- Ranger Lvl2
(51, 51, 27, 2),
(51, 51, 28, 2),
(51, 51, 29, 2),
-- Healing Word ###########################
-- Bard
(52, 52, 4, 1),
(52, 52, 5, 1),
(52, 52, 6, 1),
-- Cleric
(52, 52, 7, 1),
(52, 52, 8, 1),
(52, 52, 9, 1),
(52, 52, 10, 1),
(52, 52, 11, 1),
(52, 52, 12, 1),
(52, 52, 13, 1),
-- Druid
(52, 52, 14, 1),
(52, 52, 15, 1),
(52, 52, 16, 1),
-- Hellish Rebuke ###########################
-- Warlock
(53, 53, 36, 1),
(53, 53, 37, 1),
(53, 53, 38, 1),
-- Paladin Lvl3
(53, 53, 26, 3),
-- Heroism ###########################
-- Bard
(54, 54, 4, 1),
(54, 54, 5, 1),
(54, 54, 6, 1),
-- Paladin Lvl2
(54, 54, 23, 2),
(54, 54, 24, 2),
(54, 54, 25, 2),
(54, 54, 26, 2),
-- Hex ###########################
-- Warlock
(55, 55, 36, 1),
(55, 55, 37, 1),
(55, 55, 38, 1),
-- Hunter's Mark ###########################
-- Ranger Lvl2
(56, 56, 27, 2),
(56, 56, 28, 2),
(56, 56, 29, 2),
-- Paladin Lvl3
(56, 56, 25, 3),
-- Ice Knife ###########################
-- Druid
(57, 57, 14, 1),
(57, 57, 15, 1),
(57, 57, 16, 1),
-- Sorcerer
(57, 57, 33, 1),
(57, 57, 34, 1),
(57, 57, 35, 1),
-- Wizard
(57, 57, 39, 1),
(57, 57, 40, 1),
(57, 57, 41, 1),
(57, 57, 42, 1),
(57, 57, 43, 1),
(57, 57, 44, 1),
(57, 57, 45, 1),
(57, 57, 46, 1),
-- Eldritch Knight Fighter / Arcane Trickster Rogue Lvl3
(57, 57, 30, 3),
(57, 57, 19, 3),
-- Inflict Wounds ###########################
-- Cleric
(58, 58, 7, 1),
(58, 58, 8, 1),
(58, 58, 9, 1),
(58, 58, 10, 1),
(58, 58, 11, 1),
(58, 58, 12, 1),
(58, 58, 13, 1),
-- Paladin OathBreaker Lvl3
(58, 58, 26, 3),
-- Longstrider ###########################
-- Bard
(59, 59, 4, 1),
(59, 59, 5, 1),
(59, 59, 6, 1),
-- Druid
(59, 59, 14, 1),
(59, 59, 15, 1),
(59, 59, 16, 1),
-- Wizard
(59, 59, 39, 1),
(59, 59, 40, 1),
(59, 59, 41, 1),
(59, 59, 42, 1),
(59, 59, 43, 1),
(59, 59, 44, 1),
(59, 59, 45, 1),
(59, 59, 46, 1),
-- Ranger Lvl2
(59, 59, 27, 2),
(59, 59, 28, 2),
(59, 59, 29, 2),
-- Eldritch Knight Fighter / Arcane Trickster Rogue Lvl3
(59, 59, 30, 3),
(59, 59, 19, 3),
-- Mage Armour ###########################
-- Sorcerer
(60, 60, 33, 1),
(60, 60, 34, 1),
(60, 60, 35, 1),
-- Wizard
(60, 60, 39, 1),
(60, 60, 40, 1),
(60, 60, 41, 1),
(60, 60, 42, 1),
(60, 60, 43, 1),
(60, 60, 44, 1),
(60, 60, 45, 1),
(60, 60, 46, 1),
-- Eldritch Knight Fighter / Arcane Trickster Rogue Lvl3
(60, 60, 30, 3),
(60, 60, 19, 3),
-- Magic Missile ###########################
-- Sorcerer
(61, 61, 33, 1),
(61, 61, 34, 1),
(61, 61, 35, 1),
-- Wizard
(61, 61, 39, 1),
(61, 61, 40, 1),
(61, 61, 41, 1),
(61, 61, 42, 1),
(61, 61, 43, 1),
(61, 61, 44, 1),
(61, 61, 45, 1),
(61, 61, 46, 1),
-- Eldritch Knight Fighter / Arcane Trickster Rogue Lvl3
(61, 61, 30, 3),
(61, 61, 19, 3),
-- Protection from Good and Evil ###########################
-- Cleric
(62, 62, 7, 1),
(62, 62, 8, 1),
(62, 62, 9, 1),
(62, 62, 10, 1),
(62, 62, 11, 1),
(62, 62, 12, 1),
(62, 62, 13, 1),
-- Warlock
(62, 62, 36, 1),
(62, 62, 37, 1),
(62, 62, 38, 1),
-- Wizard
(62, 62, 39, 1),
(62, 62, 40, 1),
(62, 62, 41, 1),
(62, 62, 42, 1),
(62, 62, 43, 1),
(62, 62, 44, 1),
(62, 62, 45, 1),
(62, 62, 46, 1),
-- Paladin Lvl2
(62, 62, 23, 2),
(62, 62, 24, 2),
(62, 62, 25, 2),
(62, 62, 26, 2),
-- Eldritch Knight Fighter / Arcane Trickster Rogue Lvl3
(62, 62, 30, 3),
(62, 62, 19, 3),
-- Ray of Sickness ###########################
-- Sorcerer
(63, 63, 33, 1),
(63, 63, 34, 1),
(63, 63, 35, 1),
-- Wizard
(63, 63, 39, 1),
(63, 63, 40, 1),
(63, 63, 41, 1),
(63, 63, 42, 1),
(63, 63, 43, 1),
(63, 63, 44, 1),
(63, 63, 45, 1),
(63, 63, 46, 1),
-- Eldritch Knight Fighter / Arcane Trickster Rogue Lvl3
(63, 63, 30, 3),
(63, 63, 19, 3),
-- Sanctuary ###########################
-- Cleric
(64, 64, 7, 1),
(64, 64, 8, 1),
(64, 64, 9, 1),
(64, 64, 10, 1),
(64, 64, 11, 1),
(64, 64, 12, 1),
(64, 64, 13, 1),
-- Paladin Devotion Lvl3
(64, 64, 24, 3),
-- Searing Smite ###########################
-- Paladin
(65, 65, 23, 2),
(65, 65, 24, 2),
(65, 65, 25, 2),
(65, 65, 26, 2),
-- Shield ###########################
-- Sorcerer
(66, 66, 33, 1),
(66, 66, 34, 1),
(66, 66, 35, 1),
-- Wizard
(66, 66, 39, 1),
(66, 66, 40, 1),
(66, 66, 41, 1),
(66, 66, 42, 1),
(66, 66, 43, 1),
(66, 66, 44, 1),
(66, 66, 45, 1),
(66, 66, 46, 1),
-- Eldritch Knight Fighter / Arcane Trickster Rogue Lvl3
(66, 66, 30, 3),
(66, 66, 19, 3),
-- Shield of Faith ###########################
-- Cleric
(67, 67, 7, 1),
(67, 67, 8, 1),
(67, 67, 9, 1),
(67, 67, 10, 1),
(67, 67, 11, 1),
(67, 67, 12, 1),
(67, 67, 13, 1),
-- Paladin
(67, 67, 23, 2),
(67, 67, 24, 2),
(67, 67, 25, 2),
(67, 67, 26, 2),
-- Sleep ###########################
-- Bard
(68, 68, 4, 1),
(68, 68, 5, 1),
(68, 68, 6, 1),
-- Cleric
(68, 68, 7, 1),
-- Sorcerer
(68, 68, 33, 1),
(68, 68, 34, 1),
(68, 68, 35, 1),
-- Warlock
(68, 68, 36, 1),
-- Wizard
(68, 68, 39, 1),
(68, 68, 40, 1),
(68, 68, 41, 1),
(68, 68, 42, 1),
(68, 68, 43, 1),
(68, 68, 44, 1),
(68, 68, 45, 1),
(68, 68, 46, 1),
-- Eldritch Knight Fighter / Arcane Trickster Rogue Lvl3
(68, 68, 30, 3),
(68, 68, 19, 3),
-- Speak with Animals ###########################
-- Bard
(69, 69, 4, 1),
(69, 69, 5, 1),
(69, 69, 6, 1),
-- Druid
(69, 69, 14, 1),
(69, 69, 15, 1),
(69, 69, 16, 1),
-- Cleric
(69, 69, 10, 1),
-- Ranger Lvl2
(69, 69, 27, 2),
(69, 69, 28, 2),
(69, 69, 29, 2),
-- Paladin Oath of the Ancient Lvl3
(69, 69, 23, 1),
-- Barbarian Wildheart Lvl3
(69, 69, 3, 1),
-- Tasha's Hideous Laughter ###########################
-- Bard
(70, 70, 4, 1),
(70, 70, 5, 1),
(70, 70, 6, 1),
-- Sorcerer
(70, 70, 33, 1),
-- Warlock
(70, 70, 38, 1),
-- Wizard
(70, 70, 39, 1),
(70, 70, 40, 1),
(70, 70, 41, 1),
(70, 70, 42, 1),
(70, 70, 43, 1),
(70, 70, 44, 1),
(70, 70, 45, 1),
(70, 70, 46, 1),
-- Eldritch Knight Fighter / Arcane Trickster Rogue Lvl3
(70, 70, 30, 3),
(70, 70, 19, 3),
-- Thunderous Smite ###########################
-- Paladin Lvl2
(71, 71, 23, 2),
(71, 71, 24, 2),
(71, 71, 25, 2),
(71, 71, 26, 2),
-- Thunderwave ###########################
-- Bard
(72, 72, 4, 1),
(72, 72, 5, 1),
(72, 72, 6, 1),
-- Cleric
(72, 72, 11, 1),
-- Druid
(72, 72, 14, 1),
(72, 72, 15, 1),
(72, 72, 16, 1),
-- Sorcerer
(72, 72, 33, 1),
(72, 72, 34, 1),
(72, 72, 35, 1),
-- Wizard
(72, 72, 39, 1),
(72, 72, 40, 1),
(72, 72, 41, 1),
(72, 72, 42, 1),
(72, 72, 43, 1),
(72, 72, 44, 1),
(72, 72, 45, 1),
(72, 72, 46, 1),
-- Eldritch Knight Fighter / Arcane Trickster Rogue Lvl3
(72, 72, 30, 3),
(72, 72, 19, 3),
-- Witch Bolt ###########################
-- Sorcerer
(73, 73, 33, 1),
(73, 73, 34, 1),
(73, 73, 35, 1),
-- Warlock
(73, 73, 36, 1),
(73, 73, 37, 1),
(73, 73, 38, 1),
-- Wizard
(73, 73, 39, 1),
(73, 73, 40, 1),
(73, 73, 41, 1),
(73, 73, 42, 1),
(73, 73, 43, 1),
(73, 73, 44, 1),
(73, 73, 45, 1),
(73, 73, 46, 1),
-- Eldritch Knight Fighter / Arcane Trickster Rogue Lvl3
(73, 73, 30, 3),
(73, 73, 19, 3),
-- Wrathful Smite ###########################
-- Paladin Lvl2
(74, 74, 23, 2),
(74, 74, 24, 2),
(74, 74, 25, 2),
(74, 74, 26, 2),



-- Insert data into RacesSpells table
INSERT INTO races_spells (`id`, id_spell_id, id_sub_race_id, id_level_id) VALUES
-- Cantrips ###########################
-- Acid Splash ###########################
(1, 1, 2, 1),
(1, 1, 6, 1),
-- Blade Ward ###########################
(2, 2, 2, 1),
(2, 2, 6, 1),
-- Bone Chill ###########################
(3, 3, 2, 1),
(3, 3, 6, 1),
-- Dancing Lights ###########################
(4, 4, 2, 1),
(4, 4, 4, 1),
(4, 4, 5, 1),
(4, 4, 6, 1),
(4, 4, 8, 1),
-- Eldritch Blast ###########################
-- None
-- Fire Bolt ###########################
(6, 6, 2, 1),
(6, 6, 6, 1),
-- Friends ###########################
(7, 7, 2, 1),
(7, 7, 6, 1),
-- Guidance ###########################
-- None
-- Light ###########################
(9, 9, 2, 1),
(9, 9, 6, 1),
-- Mage Hand ###########################
(10, 10, 2, 1),
(10, 10, 6, 1),
(10, 10, 19, 1),
(10, 10, 21, 1),
-- Mage Illusion ###########################
(11, 11, 2, 1),
(11, 11, 6, 1),
-- Poison Spray ###########################
(12, 12, 2, 1),
(12, 12, 6, 1),
-- Produce Flame ###########################
(13, 13, 18, 1)
-- Ray of Frost ###########################
(14, 14, 2, 1),
(14, 14, 6, 1),
-- Resistance ###########################
-- None
-- Sacred Flame ###########################
-- None
-- Shillelagh ###########################
-- None
-- Shocking Grasp ###########################
(18, 18, 2, 1),
(18, 18, 6, 1),
-- Thaumaturgy ###########################
(19, 19, 20, 1),
-- Thorn Whip ###########################
-- None
-- True Strike ###########################
(21, 21, 2, 1),
(21, 21, 6, 1),
-- Vicious Mockery ###########################
-- None
--  ########################### ###########################
-- Spells lvl 1 ###########################
-- Burning Hands ###########################
(28, 28, 19, 3),
-- Enhance Leap ###########################
(39, 39, 21, 3),
-- Faerie Fire ###########################
(43, 43, 4, 1),
(43, 43, 5, 1),
(43, 43, 8, 1),
-- Hellish Rebuke ###########################
(53, 53, 18, 3),
-- Searing Smite ###########################
(65, 65, 20, 3),
-- Speak with Animals ###########################
(69, 69, 15, 1),


CREATE USER IF NOT EXISTS "baldursscroll"@"localhost"
IDENTIFIED BY "/baldurs.scroll69(pAsSwOrD)/";

GRANT ALL PRIVILEGES ON BaldursScroll.* TO "baldursscroll"@"localhost";


COMMIT;
SET AUTOCOMMIT = 1;