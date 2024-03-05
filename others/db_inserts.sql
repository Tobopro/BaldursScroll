-- Insert data into Levels table
INSERT INTO levels (`id`, `level`) VALUES
(1, 1),
(2, 2),
(3, 3);

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
INSERT INTO classes (`id`, `name`, starting_hp, on_level_up_hp, saving_throw_proficency1, saving_throw_proficency2, subclass_unlock_id) VALUES
(1, 'Barbarian', 12, 7, 'STR', 'CON', 3),
(2, 'Bard', 8, 5, 'DEX', 'CHA', 3),
(3, 'Cleric', 8, 5, 'WIS', 'CHA', 1),
(4, 'Druid', 8, 5, 'INT', 'WIS', 2),
(5, 'Fighter', 10, 6, 'STR', 'CON', 3),
(6, 'Monk', 8, 5, 'STR', 'DEX', 3),
(7, 'Paladin', 10, 6, 'WIS', 'CHA', 1),
(8, 'Ranger', 10, 6, 'STR', 'DEX', 3),
(9, 'Rogue', 8, 5, 'DEX', 'INT', 3),
(10, 'Sorcerer', 6, 4, 'CON', 'CHA', 1),
(11, 'Warlock', 8, 5, 'WIS', 'CHA', 1),
(12, 'Wizard', 6, 4, 'INT', 'WIS', 2);

-- Insert data into SubClasses table
INSERT INTO sub_classes (`id`, `name`, `id_class_id`, icon) VALUES
-- Barbarian
(1, 'Berserker', 1, "Barbarian.jpg"),
(2, 'Wild Magic', 1, "Barbarian.jpg"),
(3, 'Wildheart', 1, "Barbarian.jpg"),
-- Bard
(4, 'College of Lore', 2, "Bard.jpg"),
(5, 'College of Swords', 2, "Bard.jpg"),
(6, 'College of Valour', 2, "Bard.jpg"),
-- Cleric
(7, 'Knowledge Domain', 3, "Cleric.jpg"),
(8, 'Life Domain', 3, "Cleric.jpg"),
(9, 'Light Domain', 3, "Cleric.jpg"),
(10, 'Nature Domain', 3, "Cleric.jpg"),
(11, 'Tempest Domain', 3, "Cleric.jpg"),
(12, 'Trickery Domain', 3, "Cleric.jpg"),
(13, 'War Domain', 3, "Cleric.jpg"),
-- Druid
(14, 'Circle of the Land', 4, "Druid.jpg"),
(15, 'Circle of the Moon', 4, "Druid.jpg"),
(16, 'Circle of the Spores', 4, "Druid.jpg"),
-- Fighter
(17, 'Battle Master', 5, "Fighter.jpg"),
(18, 'Champion', 5, "Fighter.jpg"),
(19, 'Eldritch Knight', 5, "Fighter.jpg"),
-- Monk
(20, 'Way of the Open Hand', 6, "Monk.jpg"),
(21, 'Way of Shadow', 6, "Monk.jpg"),
(22, 'Way of the Four Elements', 6, "Monk.jpg"),
-- Paladin
(23, 'Oath of the Ancients', 7, "Paladin.jpg"),
(24, 'Oath of Devotion', 7, "Paladin.jpg"),
(25, 'Oath of Vengeance', 7, "Paladin.jpg"),
(26, 'Oathbreaker', 7, "Paladin.jpg"),
-- Ranger
(27, 'Hunter', 8, "Ranger.jpg"),
(28, 'Beast Master', 8, "Ranger.jpg"),
(29, 'Gloom Stalker', 8, "Ranger.jpg"),
-- Rogue
(30, 'Arcane Trickster', 9, "Rogue.jpg"),
(31, 'Thief', 9, "Rogue.jpg"),
(32, 'Assassin', 9, "Rogue.jpg"),
-- Sorcerer
(33, 'Draconic Bloodline', 10, "Sorcerer.jpg"),
(34, 'Wild Magic', 10, "Sorcerer.jpg"),
(35, 'Storm Sorcery', 10, "Sorcerer.jpg"),
-- Warlock
(36, 'The Archfey', 11, "Warlock.jpg"),
(37, 'The Fiend', 11, "Warlock.jpg"),
(38, 'The Great Old One', 11, "Warlock.jpg"),
-- Wizard
(39, 'Abjuration School', 12, "Wizard.jpg"),
(40, 'Conjuration School', 12, "Wizard.jpg"),
(41, 'Divination School', 12, "Wizard.jpg"),
(42, 'Enchantment School', 12, "Wizard.jpg"),
(43, 'Evocation School', 12, "Wizard.jpg"),
(44, 'Illusion School', 12, "Wizard.jpg"),
(45, 'Necromancy School', 12, "Wizard.jpg"),
(46, 'Transmutation School', 12, "Wizard.jpg");

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
INSERT INTO `user` (`id`, roles, username, email, `password`, sign_in_date, profile_picture, is_banned) VALUES
(1, "[]", 'adventurer1', 'adventurer1@example.com', 'password123', NOW(), '', 0),
(2, "[]", 'dungeonmaster', 'dm@example.com', 'dmpassword', Now(), '', 0);

-- Insert data into Characters table
INSERT INTO `characters` (`id`, `name`, strength, dexterity, constitution, intelligence, wisdom, charisma, ability_score_bonus1, ability_score_bonus2, id_sub_race_id, id_sub_classes_id, id_users_id, id_level_id, is_public) VALUES
(1, "Astarion", 8, 15, 14, 12, 13, 10, "DEX", "INT", 2, 30, 1, 1, 1),
(2, "Gale", 8, 13, 14, 10, 12, 8, "INT", "CON", 1, 39, 1, 1, 1),
(3, "Karlach", 15, 13, 14, 8, 12, 10, "STR", "CON", 20, 1, 1, 1, 1),
(4, "Lae'zel", 15, 13, 14, 10, 12, 8, "STR", "CON", 21, 17, 1, 1, 1),
(5, "Shadowheart", 13, 12, 14, 10, 17, 8, "WIS", "DEX", 6, 12, 1, 1, 1),
(6, "Wyll", 8, 13, 14, 12, 10, 15, "CHA", "INT", 1, 37, 1, 1, 1),
(7, "Dark Urge", 8, 13, 14, 12, 10, 15, "CHA", "CON", 31, 33, 1, 1, 1);


-- Insert data into ClassesSpells table
INSERT INTO classes_spells (`id`, id_spell_id, id_sub_classes_id, id_level_id) VALUES
-- Cantrips ###########################
-- Acid Splash ###########################
-- Sorcerer sub-classes
(1, 1, 33, 1),
(2, 1, 34, 1),
(3, 1, 35, 1),
-- Wizard sub-classes
(4, 1, 39, 1),
(5, 1, 40, 1),
(6, 1, 41, 1),
(7, 1, 42, 1),
(8, 1, 43, 1),
(9, 1, 44, 1),
(10, 1, 45, 1),
(11, 1, 46, 1),
-- Eldritch Knight Fighter / Arcane Trickster Rogue Lvl3
(12, 1, 30, 3),
(13, 1, 19, 3),
-- Blade Ward ###########################
-- Bard
(14, 2, 4, 1),
(15, 2, 5, 1),
(16, 2, 6, 1),
-- Cleric
(17, 2, 7, 1),
(18, 2, 8, 1),
(19, 2, 9, 1),
(20, 2, 10, 1),
(21, 2, 11, 1),
(22, 2, 12, 1),
(23, 2, 13, 1),
-- Sorcerer
(24, 2, 33, 1),
(25, 2, 34, 1),
(26, 2, 35, 1),
-- Wizard
(27, 2, 39, 1),
(28, 2, 40, 1),
(29, 2, 41, 1),
(30, 2, 42, 1),
(31, 2, 43, 1),
(32, 2, 44, 1),
(33, 2, 45, 1),
(34, 2, 46, 1),
-- Eldritch Knight Fighter / Arcane Trickster Rogue Lvl3
(35, 2, 30, 3),
(36, 2, 19, 3),
-- Bone Chill ###########################
-- Sorcerer
(37, 3, 33, 1),
(38, 3, 34, 1),
(39, 3, 35, 1),
-- Warlock
(40, 3, 36, 1),
(41, 3, 37, 1),
(42, 3, 38, 1),
-- Wizard
(43, 3, 39, 1),
(44, 3, 40, 1),
(45, 3, 41, 1),
(46, 3, 42, 1),
(47, 3, 43, 1),
(48, 3, 44, 1),
(49, 3, 45, 1),
(50, 3, 46, 1),
-- Spore Druid Lvl2
(51, 3, 16, 2),-- Eldritch Knight Fighter / Arcane Trickster Rogue Lvl3
(52, 3, 30, 3),
(53, 3, 19, 3),
-- Dancing Lights ###########################
-- Bard
(54, 4, 4, 1),
(55, 4, 5, 1),
(56, 4, 6, 1),
-- Sorcerer
(57, 4, 33, 1),
(58, 4, 34, 1),
(59, 4, 35, 1),
-- Wizard
(60, 4, 39, 1),
(61, 4, 40, 1),
(62, 4, 41, 1),
(63, 4, 42, 1),
(64, 4, 43, 1),
(65, 4, 44, 1),
(66, 4, 45, 1),
(67, 4, 46, 1),
-- Eldritch Knight Fighter / Arcane Trickster Rogue Lvl3
(68, 4, 30, 3),
(69, 4, 19, 3),
-- Eldritch Blast ###########################
-- Warlock
(70, 5, 36, 1),
(71, 5, 37, 1),
(72, 5, 38, 1),
-- Fire Bolt ###########################
-- Sorcerer
(73, 6, 33, 1),
(74, 6, 34, 1),
(75, 6, 35, 1),
-- Wizard
(76, 6, 39, 1),
(77, 6, 40, 1),
(78, 6, 41, 1),
(79, 6, 42, 1),
(80, 6, 43, 1),
(81, 6, 44, 1),
(82, 6, 45, 1),
(83, 6, 46, 1),
-- Eldritch Knight Fighter / Arcane Trickster Rogue Lvl3
(84, 6, 30, 3),
(85, 6, 19, 3),
-- Friends ###########################
-- Bard
(86, 7, 4, 1),
(87, 7, 5, 1),
(88, 7, 6, 1),
-- Sorcerer
(89, 7, 33, 1),
(90, 7, 34, 1),
(91, 7, 35, 1),
-- Warlock
(92, 7, 36, 1),
(93, 7, 37, 1),
(94, 7, 38, 1),
-- Wizard
(95, 7, 39, 1),
(96, 7, 40, 1),
(97, 7, 41, 1),
(98, 7, 42, 1),
(99, 7, 43, 1),
(100, 7, 44, 1),
(101, 7, 45, 1),
(102, 7, 46, 1),
-- Eldritch Knight Fighter / Arcane Trickster Rogue Lvl3
(103, 7, 30, 3),
(104, 7, 19, 3),
-- Guidance ###########################
-- Cleric
(105, 8, 7, 1),
(106, 8, 8, 1),
(107, 8, 9, 1),
(108, 8, 10, 1),
(109, 8, 11, 1),
(110, 8, 12, 1),
(111, 8, 13, 1),
-- Druid
(112, 8, 14, 1),
(113, 8, 15, 1),
(114, 8, 16, 1),
-- Light ###########################
-- Bard
(115, 9, 4, 1),
(116, 9, 5, 1),
(117, 9, 6, 1),
-- Cleric
(118, 9, 7, 1),
(119, 9, 8, 1),
(120, 9, 9, 1),
(121, 9, 10, 1),
(122, 9, 11, 1),
(123, 9, 12, 1),
(124, 9, 13, 1),
-- Sorcerer
(125, 9, 33, 1),
(126, 9, 34, 1),
(127, 9, 35, 1),
-- Wizard
(128, 9, 39, 1),
(129, 9, 40, 1),
(130, 9, 41, 1),
(131, 9, 42, 1),
(132, 9, 43, 1),
(133, 9, 44, 1),
(134, 9, 45, 1),
(135, 9, 46, 1),
-- Eldritch Knight Fighter / Arcane Trickster Rogue Lvl3
(136, 9, 30, 3),
(137, 9, 19, 3),
-- Mage Hand ###########################
-- Bard
(138, 10, 4, 1),
(139, 10, 5, 1),
(140, 10, 6, 1),
-- Sorcerer
(141, 10, 33, 1),
(142, 10, 34, 1),
(143, 10, 35, 1),
-- Warlock
(144, 10, 36, 1),
(145, 10, 37, 1),
(146, 10, 38, 1),
-- Wizard
(147, 10, 39, 1),
(148, 10, 40, 1),
(149, 10, 41, 1),
(150, 10, 42, 1),
(151, 10, 43, 1),
(152, 10, 44, 1),
(153, 10, 45, 1),
(154, 10, 46, 1),
-- Eldritch Knight Fighter / Arcane Trickster Rogue Lvl3
(155, 10, 30, 3),
(156, 10, 19, 3),
-- Minor Illusion ###########################
-- Bard
(157, 11, 4, 1),
(158, 11, 5, 1),
(159, 11, 6, 1),
-- Sorcerer
(160, 11, 33, 1),
(161, 11, 34, 1),
(162, 11, 35, 1),
-- Warlock
(163, 11, 36, 1),
(164, 11, 37, 1),
(165, 11, 38, 1),
-- Wizard
(166, 11, 39, 1),
(167, 11, 40, 1),
(168, 11, 41, 1),
(169, 11, 42, 1),
(170, 11, 43, 1),
(171, 11, 44, 1),
(172, 11, 45, 1),
(173, 11, 46, 1),
-- Eldritch Knight Fighter / Arcane Trickster Rogue / Way of Shadow Monk Lvl3
(174, 11, 30, 3),
(175, 11, 19, 3),
(176, 11, 21, 3),
-- Poison Spray ###########################
-- Cleric
(177, 12, 10, 1),
-- Druid
(178, 12, 14, 1),
(179, 12, 15, 1),
(180, 12, 16, 1),
-- Sorcerer
(181, 12, 33, 1),
(182, 12, 34, 1),
(183, 12, 35, 1),
-- Warlock
(184, 12, 36, 1),
(185, 12, 37, 1),
(186, 12, 38, 1),
-- Wizard
(187, 12, 39, 1),
(188, 12, 40, 1),
(189, 12, 41, 1),
(190, 12, 42, 1),
(191, 12, 43, 1),
(192, 12, 44, 1),
(193, 12, 45, 1),
(194, 12, 46, 1),
-- Eldritch Knight Fighter / Arcane Trickster Rogue Lvl3
(195, 12, 30, 3),
(196, 12, 19, 3),
-- Produce Flame ###########################
-- Cleric
(197, 13, 7, 1),
(198, 13, 8, 1),
(199, 13, 9, 1),
(200, 13, 10, 1),
(201, 13, 11, 1),
(202, 13, 12, 1),
(203, 13, 13, 1),
-- Druid
(204, 13, 14, 1),
(205, 13, 15, 1),
(206, 13, 16, 1),
-- Ray of Frost ###########################
-- Sorcerer
(207, 14, 33, 1),
(208, 14, 34, 1),
(209, 14, 35, 1),
-- Wizard
(210, 14, 39, 1),
(211, 14, 40, 1),
(212, 14, 41, 1),
(213, 14, 42, 1),
(214, 14, 43, 1),
(215, 14, 44, 1),
(216, 14, 45, 1),
(217, 14, 46, 1),
-- Eldritch Knight Fighter / Arcane Trickster Rogue Lvl3
(218, 14, 30, 3),
(219, 14, 19, 3),
-- Resistance ###########################
-- Cleric
(220, 15, 7, 1),
(221, 15, 8, 1),
(222, 15, 9, 1),
(223, 15, 10, 1),
(224, 15, 11, 1),
(225, 15, 12, 1),
(226, 15, 13, 1),
-- Druid
(227, 15, 14, 1),
(228, 15, 15, 1),
(229, 15, 16, 1),
-- Sacred Flame ###########################
-- Cleric
(230, 16, 7, 1),
(231, 16, 8, 1),
(232, 16, 9, 1),
(233, 16, 10, 1),
(234, 16, 11, 1),
(235, 16, 12, 1),
(236, 16, 13, 1),
-- Ranger
(237, 16, 27, 1),
(238, 16, 28, 1),
(239, 16, 29, 1),
-- Shillelagh ###########################
-- Druid
(240, 17, 14, 1),
(241, 17, 15, 1),
(242, 17, 16, 1),
-- Cleric
(243, 17, 10, 1),
-- Shocking Grasp ###########################
-- Sorcerer
(244, 18, 33, 1),
(245, 18, 34, 1),
(246, 18, 35, 1),
-- Wizard
(247, 18, 39, 1),
(248, 18, 40, 1),
(249, 18, 41, 1),
(250, 18, 42, 1),
(251, 18, 43, 1),
(252, 18, 44, 1),
(253, 18, 45, 1),
(254, 18, 46, 1),
-- Eldritch Knight Fighter / Arcane Trickster Rogue Lvl3
(255, 18, 30, 3),
(256, 18, 19, 3),
-- Thaumaturgy ###########################
-- Cleric
(257, 19, 7, 1),
(258, 19, 8, 1),
(259, 19, 9, 1),
(260, 19, 10, 1),
(261, 19, 11, 1),
(262, 19, 12, 1),
(263, 19, 13, 1),
-- Thorn Whip ###########################
-- Druid
(264, 20, 14, 1),
(265, 20, 15, 1),
(266, 20, 16, 1),
-- Cleric
(267, 20, 10, 1),
-- True Strike ###########################
-- Bard
(268, 21, 4, 1),
(269, 21, 5, 1),
(270, 21, 6, 1),
-- Sorcerer
(271, 21, 33, 1),
(272, 21, 34, 1),
(273, 21, 35, 1),
-- Warlock
(274, 21, 36, 1),
(275, 21, 37, 1),
(276, 21, 38, 1),
-- Wizard
(277, 21, 39, 1),
(278, 21, 40, 1),
(279, 21, 41, 1),
(280, 21, 42, 1),
(281, 21, 43, 1),
(282, 21, 44, 1),
(283, 21, 45, 1),
(284, 21, 46, 1),
-- Eldritch Knight Fighter / Arcane Trickster Rogue Lvl3
(285, 21, 30, 3),
(286, 21, 19, 3),
-- Vicious Mockery ###########################
-- Bard
(287, 22, 4, 1),
(288, 22, 5, 1),
(289, 22, 6, 1),
--  ########################### ###########################
-- Spells lvl 1 ###########################
-- Animal Friendship ###########################
-- Bard
(290, 23, 4, 1),
(291, 23, 5, 1),
(292, 23, 6, 1),
-- Druid
(293, 23, 14, 1),
(294, 23, 15, 1),
(295, 23, 16, 1),
-- Cleric
(296, 23, 10, 1),
-- Ranger Lvl 2
(297, 23, 27, 2),
(298, 23, 28, 2),
(299, 23, 29, 2),
-- Armour of Agathys ###########################
-- Sorcerer
(300, 24, 33, 1),
-- Warlock
(301, 24, 36, 1),
(302, 24, 37, 1),
(303, 24, 38, 1),
-- Arms of Hadar ###########################
-- Warlock
(304, 25, 36, 1),
(305, 25, 37, 1),
(306, 25, 38, 1),
-- Bane ###########################
-- Bard
(307, 26, 4, 1),
(308, 26, 5, 1),
(309, 26, 6, 1),
-- Cleric
(310, 26, 7, 1),
(311, 26, 8, 1),
(312, 26, 9, 1),
(313, 26, 10, 1),
(314, 26, 11, 1),
(315, 26, 12, 1),
(316, 26, 13, 1),
-- Paladin
(317, 26, 25, 1),
-- Bless ###########################
-- Cleric
(318, 27, 7, 1),
(319, 27, 8, 1),
(320, 27, 9, 1),
(321, 27, 10, 1),
(322, 27, 11, 1),
(323, 27, 12, 1),
(324, 27, 13, 1),
-- Paladin
(325, 27, 23, 2),
(326, 27, 24, 2),
(327, 27, 25, 2),
(328, 27, 26, 2),
-- Burning Hands ###########################
-- Cleric
(329, 28, 9, 1),
-- Sorcerer
(330, 28, 33, 1),
(331, 28, 34, 1),
(332, 28, 35, 1),
-- Warlock
(333, 28, 37, 1),
-- Wizard
(334, 28, 39, 1),
(335, 28, 40, 1),
(336, 28, 41, 1),
(337, 28, 42, 1),
(338, 28, 43, 1),
(339, 28, 44, 1),
(340, 28, 45, 1),
(341, 28, 46, 1),
-- Eldritch Knight Fighter / Arcane Trickster Rogue Lvl3
(342, 28, 30, 3),
(343, 28, 19, 3),
-- Charm Person ###########################
-- Bard
(344, 29, 4, 1),
(345, 29, 5, 1),
(346, 29, 6, 1),
-- Cleric
(347, 29, 12, 1),
-- Druid
(348, 29, 14, 1),
(349, 29, 15, 1),
(350, 29, 16, 1),
-- Sorcerer
(351, 29, 33, 1),
(352, 29, 34, 1),
(353, 29, 35, 1),
-- Warlock
(354, 29, 36, 1),
(355, 29, 37, 1),
(356, 29, 38, 1),
-- Wizard
(357, 29, 39, 1),
(358, 29, 40, 1),
(359, 29, 41, 1),
(360, 29, 42, 1),
(361, 29, 43, 1),
(362, 29, 44, 1),
(363, 29, 45, 1),
(364, 29, 46, 1),
-- Eldritch Knight Fighter / Arcane Trickster Rogue Lvl3
(365, 29, 30, 3),
(366, 29, 19, 3),
-- Chromatic Orb ###########################
-- Sorcerer
(367, 30, 33, 1),
(368, 30, 34, 1),
(369, 30, 35, 1),
-- Wizard
(370, 30, 39, 1),
(371, 30, 40, 1),
(372, 30, 41, 1),
(373, 30, 42, 1),
(374, 30, 43, 1),
(375, 30, 44, 1),
(376, 30, 45, 1),
(377, 30, 46, 1),
-- Eldritch Knight Fighter / Arcane Trickster Rogue Lvl3
(378, 30, 30, 3),
(379, 30, 19, 3),
-- Colour Spray ###########################
-- Sorcerer
(380, 31, 33, 1),
(381, 31, 34, 1),
(382, 31, 35, 1),
-- Wizard
(383, 31, 39, 1),
(384, 31, 40, 1),
(385, 31, 41, 1),
(386, 31, 42, 1),
(387, 31, 43, 1),
(388, 31, 44, 1),
(389, 31, 45, 1),
(390, 31, 46, 1),
-- Eldritch Knight Fighter / Arcane Trickster Rogue Lvl3
(391, 31, 30, 3),
(392, 31, 19, 3),
-- Command ###########################
-- Cleric
(393, 32, 7, 1),
(394, 32, 8, 1),
(395, 32, 9, 1),
(396, 32, 10, 1),
(397, 32, 11, 1),
(398, 32, 12, 1),
(399, 32, 13, 1),
-- Warlock
(400, 32, 37, 1),
-- Paladin Lvl2
(401, 32, 23, 2),
(402, 32, 24, 2),
(403, 32, 25, 2),
(404, 32, 26, 2),
-- Compelled Duel ###########################
-- Paladin
(405, 33, 23, 2),
(406, 33, 24, 2),
(407, 33, 25, 2),
(408, 33, 26, 2),
-- Create or Destroy Water ###########################
-- Cleric
(409, 34, 7, 1),
(410, 34, 8, 1),
(411, 34, 9, 1),
(412, 34, 10, 1),
(413, 34, 11, 1),
(414, 34, 12, 1),
(415, 34, 13, 1),
-- Druid
(416, 34, 14, 1),
(417, 34, 15, 1),
(418, 34, 16, 1),
-- Wizard
(419, 34, 40, 2),
-- Cure Wounds ###########################
-- Bard
(420, 35, 4, 1),
(421, 35, 5, 1),
(422, 35, 6, 1),
-- Cleric
(423, 35, 7, 1),
(424, 35, 8, 1),
(425, 35, 9, 1),
(426, 35, 10, 1),
(427, 35, 11, 1),
(428, 35, 12, 1),
(429, 35, 13, 1),
-- Druid
(430, 35, 14, 1),
(431, 35, 15, 1),
(432, 35, 16, 1),
-- Paladin Lvl2
(433, 35, 23, 2),
(434, 35, 24, 2),
(435, 35, 25, 2),
(436, 35, 26, 2),
-- Ranger Lvl2
(437, 35, 27, 2),
(438, 35, 28, 2),
(439, 35, 29, 2),
-- Disguise Self ###########################
-- Bard
(440, 36, 4, 1),
(441, 36, 5, 1),
(442, 36, 6, 1),
-- Cleric
(443, 36, 12, 1),
-- Sorcerer
(444, 36, 33, 1),
(445, 36, 34, 1),
(446, 36, 35, 1),
-- Wizard
(447, 36, 39, 1),
(448, 36, 40, 1),
(449, 36, 41, 1),
(450, 36, 42, 1),
(451, 36, 43, 1),
(452, 36, 44, 1),
(453, 36, 45, 1),
(454, 36, 46, 1),
-- Eldritch Knight Fighter / Arcane Trickster Rogue / Gloom Stalker Ranger Lvl3
(455, 36, 30, 3),
(456, 36, 19, 3),
(457, 36, 29, 3),
-- Dissonant Whispers ###########################
-- Bard
(458, 37, 4, 1),
(459, 37, 5, 1),
(460, 37, 6, 1),
-- Warlock
(461, 37, 38, 1),
-- Divine Favour ###########################
-- Cleric
(462, 38, 13, 1),
-- Paladin Lvl2
(463, 38, 23, 2),
(464, 38, 24, 2),
(465, 38, 25, 2),
(466, 38, 26, 2),
-- Enhance Leap ###########################
-- Druid
(467, 39, 14, 1),
(468, 39, 15, 1),
(469, 39, 16, 1),
-- Sorcerer
(470, 39, 33, 1),
(471, 39, 34, 1),
(472, 39, 35, 1),
-- Wizard
(473, 39, 39, 1),
(474, 39, 40, 1),
(475, 39, 41, 1),
(476, 39, 42, 1),
(477, 39, 43, 1),
(478, 39, 44, 1),
(479, 39, 45, 1),
(480, 39, 46, 1),
-- Ranger Lvl2
(481, 39, 27, 2),
(482, 39, 28, 2),
(483, 39, 29, 2),
-- Eldritch Knight Fighter / Arcane Trickster Rogue Lvl3
(484, 39, 30, 3),
(485, 39, 19, 3),
-- Ensnaring Strike ###########################
-- No one ??-- Entangle ###########################
-- Druid
(486, 41, 14, 1),
(487, 41, 15, 1),
(488, 41, 16, 1),
-- Expeditious Retreat ###########################
-- Sorcerer
(489, 42, 33, 1),
(490, 42, 34, 1),
(491, 42, 35, 1),
-- Warlock
(492, 42, 36, 1),
(493, 42, 37, 1),
(494, 42, 38, 1),
-- Wizard
(495, 42, 39, 1),
(496, 42, 40, 1),
(497, 42, 41, 1),
(498, 42, 42, 1),
(499, 42, 43, 1),
(500, 42, 44, 1),
(501, 42, 45, 1),
(502, 42, 46, 1),
-- Eldritch Knight Fighter / Arcane Trickster Rogue Lvl3
(503, 42, 30, 3),
(504, 42, 19, 3),
-- Faerie Fire ###########################
-- Bard
(505, 43, 4, 1),
(506, 43, 5, 1),
(507, 43, 6, 1),
-- Cleric
(508, 43, 9, 1),
-- Druid
(509, 43, 14, 1),
(510, 43, 15, 1),
(511, 43, 16, 1),
-- Warlock
(512, 43, 36, 1),
-- False Life ###########################
-- Sorcerer
(513, 44, 33, 1),
(514, 44, 34, 1),
(515, 44, 35, 1),
-- Wizard
(516, 44, 39, 1),
(517, 44, 40, 1),
(518, 44, 41, 1),
(519, 44, 42, 1),
(520, 44, 43, 1),
(521, 44, 44, 1),
(522, 44, 45, 1),
(523, 44, 46, 1),
-- Eldritch Knight Fighter / Arcane Trickster Rogue Lvl3
(524, 44, 30, 3),
(525, 44, 19, 3),
-- Feather Fall ###########################
-- Bard
(526, 45, 4, 1),
(527, 45, 5, 1),
(528, 45, 6, 1),
-- Sorcerer
(529, 45, 33, 1),
(530, 45, 34, 1),
(531, 45, 35, 1),
-- Wizard
(532, 45, 39, 1),
(533, 45, 40, 1),
(534, 45, 41, 1),
(535, 45, 42, 1),
(536, 45, 43, 1),
(537, 45, 44, 1),
(538, 45, 45, 1),
(539, 45, 46, 1),
-- Eldritch Knight Fighter / Arcane Trickster Rogue Lvl3
(540, 45, 30, 3),
(541, 45, 19, 3),
-- Find Familiar ###########################
-- Ranger
(542, 46, 27, 1),
(543, 46, 28, 1),
(544, 46, 29, 1),
-- Wizard
(545, 46, 39, 1),
(546, 46, 40, 1),
(547, 46, 41, 1),
(548, 46, 42, 1),
(549, 46, 43, 1),
(550, 46, 44, 1),
(551, 46, 45, 1),
(552, 46, 46, 1),
-- Eldritch Knight Fighter / Arcane Trickster Rogue Lvl3
(553, 46, 30, 3),
(554, 46, 19, 3),
-- Fog Cloud ###########################
-- Bard
(555, 47, 4, 1),
(556, 47, 5, 1),
(557, 47, 6, 1),
-- Cleric
(558, 47, 11, 1),
-- Sorcerer
(559, 47, 33, 1),
(560, 47, 34, 1),
(561, 47, 35, 1),
-- Wizard
(562, 47, 39, 1),
(563, 47, 40, 1),
(564, 47, 41, 1),
(565, 47, 42, 1),
(566, 47, 43, 1),
(567, 47, 44, 1),
(568, 47, 45, 1),
(569, 47, 46, 1),
-- Ranger Lvl2
(570, 47, 27, 2),
(571, 47, 28, 2),
(572, 47, 29, 2),
-- Eldritch Knight Fighter / Arcane Trickster Rogue Lvl3
(573, 47, 30, 3),
(574, 47, 19, 3),
-- Goodberry ###########################
-- Druid
(575, 48, 14, 1),
(576, 48, 15, 1),
(577, 48, 16, 1),
-- Ranger Lvl2
(578, 48, 27, 2),
(579, 48, 28, 2),
(580, 48, 29, 2),
-- Grease ###########################
-- Sorcerer
(581, 49, 33, 1),
-- Wizard
(582, 49, 39, 1),
(583, 49, 40, 1),
(584, 49, 41, 1),
(585, 49, 42, 1),
(586, 49, 43, 1),
(587, 49, 44, 1),
(588, 49, 45, 1),
(589, 49, 46, 1),
-- Eldritch Knight Fighter / Arcane Trickster Rogue Lvl3
(590, 49, 30, 3),
(591, 49, 19, 3),
-- Guiding Light ###########################
-- Cleric
(592, 50, 7, 1),
(593, 50, 8, 1),
(594, 50, 9, 1),
(595, 50, 10, 1),
(596, 50, 11, 1),
(597, 50, 12, 1),
(598, 50, 13, 1),
-- Hail of Thorns ###########################
-- Ranger Lvl2
(599, 51, 27, 2),
(600, 51, 28, 2),
(601, 51, 29, 2),
-- Healing Word ###########################
-- Bard
(602, 52, 4, 1),
(603, 52, 5, 1),
(604, 52, 6, 1),
-- Cleric
(605, 52, 7, 1),
(606, 52, 8, 1),
(607, 52, 9, 1),
(608, 52, 10, 1),
(609, 52, 11, 1),
(610, 52, 12, 1),
(611, 52, 13, 1),
-- Druid
(612, 52, 14, 1),
(613, 52, 15, 1),
(614, 52, 16, 1),
-- Hellish Rebuke ###########################
-- Warlock
(615, 53, 36, 1),
(616, 53, 37, 1),
(617, 53, 38, 1),
-- Paladin Lvl3
(618, 53, 26, 3),
-- Heroism ###########################
-- Bard
(619, 54, 4, 1),
(620, 54, 5, 1),
(621, 54, 6, 1),
-- Paladin Lvl2
(622, 54, 23, 2),
(623, 54, 24, 2),
(624, 54, 25, 2),
(625, 54, 26, 2),
-- Hex ###########################
-- Warlock
(626, 55, 36, 1),
(627, 55, 37, 1),
(628, 55, 38, 1),
-- Hunter's Mark ###########################
-- Ranger Lvl2
(629, 56, 27, 2),
(630, 56, 28, 2),
(631, 56, 29, 2),
-- Paladin Lvl3
(632, 56, 25, 3),
-- Ice Knife ###########################
-- Druid
(633, 57, 14, 1),
(634, 57, 15, 1),
(635, 57, 16, 1),
-- Sorcerer
(636, 57, 33, 1),
(637, 57, 34, 1),
(638, 57, 35, 1),
-- Wizard
(639, 57, 39, 1),
(640, 57, 40, 1),
(641, 57, 41, 1),
(642, 57, 42, 1),
(643, 57, 43, 1),
(644, 57, 44, 1),
(645, 57, 45, 1),
(646, 57, 46, 1),
-- Eldritch Knight Fighter / Arcane Trickster Rogue Lvl3
(647, 57, 30, 3),
(648, 57, 19, 3),
-- Inflict Wounds ###########################
-- Cleric
(649, 58, 7, 1),
(650, 58, 8, 1),
(651, 58, 9, 1),
(652, 58, 10, 1),
(653, 58, 11, 1),
(654, 58, 12, 1),
(655, 58, 13, 1),
-- Paladin OathBreaker Lvl3
(656, 58, 26, 3),
-- Longstrider ###########################
-- Bard
(657, 59, 4, 1),
(658, 59, 5, 1),
(659, 59, 6, 1),
-- Druid
(660, 59, 14, 1),
(661, 59, 15, 1),
(662, 59, 16, 1),
-- Wizard
(663, 59, 39, 1),
(664, 59, 40, 1),
(665, 59, 41, 1),
(666, 59, 42, 1),
(667, 59, 43, 1),
(668, 59, 44, 1),
(669, 59, 45, 1),
(670, 59, 46, 1),
-- Ranger Lvl2
(671, 59, 27, 2),
(672, 59, 28, 2),
(673, 59, 29, 2),
-- Eldritch Knight Fighter / Arcane Trickster Rogue Lvl3
(674, 59, 30, 3),
(675, 59, 19, 3),
-- Mage Armour ###########################
-- Sorcerer
(676, 60, 33, 1),
(677, 60, 34, 1),
(678, 60, 35, 1),
-- Wizard
(679, 60, 39, 1),
(680, 60, 40, 1),
(681, 60, 41, 1),
(682, 60, 42, 1),
(683, 60, 43, 1),
(684, 60, 44, 1),
(685, 60, 45, 1),
(686, 60, 46, 1),
-- Eldritch Knight Fighter / Arcane Trickster Rogue Lvl3
(687, 60, 30, 3),
(688, 60, 19, 3),
-- Magic Missile ###########################
-- Sorcerer
(689, 61, 33, 1),
(690, 61, 34, 1),
(691, 61, 35, 1),
-- Wizard
(692, 61, 39, 1),
(693, 61, 40, 1),
(694, 61, 41, 1),
(695, 61, 42, 1),
(696, 61, 43, 1),
(697, 61, 44, 1),
(698, 61, 45, 1),
(699, 61, 46, 1),
-- Eldritch Knight Fighter / Arcane Trickster Rogue Lvl3
(700, 61, 30, 3),
(701, 61, 19, 3),
-- Protection from Good and Evil ###########################
-- Cleric
(702, 62, 7, 1),
(703, 62, 8, 1),
(704, 62, 9, 1),
(705, 62, 10, 1),
(706, 62, 11, 1),
(707, 62, 12, 1),
(708, 62, 13, 1),
-- Warlock
(709, 62, 36, 1),
(710, 62, 37, 1),
(711, 62, 38, 1),
-- Wizard
(712, 62, 39, 1),
(713, 62, 40, 1),
(714, 62, 41, 1),
(715, 62, 42, 1),
(716, 62, 43, 1),
(717, 62, 44, 1),
(718, 62, 45, 1),
(719, 62, 46, 1),
-- Paladin Lvl2
(720, 62, 23, 2),
(721, 62, 24, 2),
(722, 62, 25, 2),
(723, 62, 26, 2),
-- Eldritch Knight Fighter / Arcane Trickster Rogue Lvl3
(724, 62, 30, 3),
(725, 62, 19, 3),
-- Ray of Sickness ###########################
-- Sorcerer
(726, 63, 33, 1),
(727, 63, 34, 1),
(728, 63, 35, 1),
-- Wizard
(729, 63, 39, 1),
(730, 63, 40, 1),
(731, 63, 41, 1),
(732, 63, 42, 1),
(733, 63, 43, 1),
(734, 63, 44, 1),
(735, 63, 45, 1),
(736, 63, 46, 1),
-- Eldritch Knight Fighter / Arcane Trickster Rogue Lvl3
(737, 63, 30, 3),
(738, 63, 19, 3),
-- Sanctuary ###########################
-- Cleric
(739, 64, 7, 1),
(740, 64, 8, 1),
(741, 64, 9, 1),
(742, 64, 10, 1),
(743, 64, 11, 1),
(744, 64, 12, 1),
(745, 64, 13, 1),
-- Paladin Devotion Lvl3
(746, 64, 24, 3),
-- Searing Smite ###########################
-- Paladin
(747, 65, 23, 2),
(748, 65, 24, 2),
(749, 65, 25, 2),
(750, 65, 26, 2),
-- Shield ###########################
-- Sorcerer
(751, 66, 33, 1),
(752, 66, 34, 1),
(753, 66, 35, 1),
-- Wizard
(754, 66, 39, 1),
(755, 66, 40, 1),
(756, 66, 41, 1),
(757, 66, 42, 1),
(758, 66, 43, 1),
(759, 66, 44, 1),
(760, 66, 45, 1),
(761, 66, 46, 1),
-- Eldritch Knight Fighter / Arcane Trickster Rogue Lvl3
(762, 66, 30, 3),
(763, 66, 19, 3),
-- Shield of Faith ###########################
-- Cleric
(764, 67, 7, 1),
(765, 67, 8, 1),
(766, 67, 9, 1),
(767, 67, 10, 1),
(768, 67, 11, 1),
(769, 67, 12, 1),
(770, 67, 13, 1),
-- Paladin
(771, 67, 23, 2),
(772, 67, 24, 2),
(773, 67, 25, 2),
(774, 67, 26, 2),
-- Sleep ###########################
-- Bard
(775, 68, 4, 1),
(776, 68, 5, 1),
(777, 68, 6, 1),
-- Cleric
(778, 68, 7, 1),
-- Sorcerer
(779, 68, 33, 1),
(780, 68, 34, 1),
(781, 68, 35, 1),
-- Warlock
(782, 68, 36, 1),
-- Wizard
(783, 68, 39, 1),
(784, 68, 40, 1),
(785, 68, 41, 1),
(786, 68, 42, 1),
(787, 68, 43, 1),
(788, 68, 44, 1),
(789, 68, 45, 1),
(790, 68, 46, 1),
-- Eldritch Knight Fighter / Arcane Trickster Rogue Lvl3
(791, 68, 30, 3),
(792, 68, 19, 3),
-- Speak with Animals ###########################
-- Bard
(793, 69, 4, 1),
(794, 69, 5, 1),
(795, 69, 6, 1),
-- Druid
(796, 69, 14, 1),
(797, 69, 15, 1),
(798, 69, 16, 1),
-- Cleric
(799, 69, 10, 1),
-- Ranger Lvl2
(800, 69, 27, 2),
(801, 69, 28, 2),
(802, 69, 29, 2),
-- Paladin Oath of the Ancient Lvl3
(803, 69, 23, 1),
-- Barbarian Wildheart Lvl3
(804, 69, 3, 1),
-- Tasha's Hideous Laughter ###########################
-- Bard
(805, 70, 4, 1),
(806, 70, 5, 1),
(807, 70, 6, 1),
-- Sorcerer
(808, 70, 33, 1),
-- Warlock
(809, 70, 38, 1),
-- Wizard
(810, 70, 39, 1),
(811, 70, 40, 1),
(812, 70, 41, 1),
(813, 70, 42, 1),
(814, 70, 43, 1),
(815, 70, 44, 1),
(816, 70, 45, 1),
(817, 70, 46, 1),
-- Eldritch Knight Fighter / Arcane Trickster Rogue Lvl3
(818, 70, 30, 3),
(819, 70, 19, 3),
-- Thunderous Smite ###########################
-- Paladin Lvl2
(820, 71, 23, 2),
(821, 71, 24, 2),
(822, 71, 25, 2),
(823, 71, 26, 2),
-- Thunderwave ###########################
-- Bard
(824, 72, 4, 1),
(825, 72, 5, 1),
(826, 72, 6, 1),
-- Cleric
(827, 72, 11, 1),
-- Druid
(828, 72, 14, 1),
(829, 72, 15, 1),
(830, 72, 16, 1),
-- Sorcerer
(831, 72, 33, 1),
(832, 72, 34, 1),
(833, 72, 35, 1),
-- Wizard
(834, 72, 39, 1),
(835, 72, 40, 1),
(836, 72, 41, 1),
(837, 72, 42, 1),
(838, 72, 43, 1),
(839, 72, 44, 1),
(840, 72, 45, 1),
(841, 72, 46, 1),
-- Eldritch Knight Fighter / Arcane Trickster Rogue Lvl3
(842, 72, 30, 3),
(843, 72, 19, 3),
-- Witch Bolt ###########################
-- Sorcerer
(844, 73, 33, 1),
(845, 73, 34, 1),
(846, 73, 35, 1),
-- Warlock
(847, 73, 36, 1),
(848, 73, 37, 1),
(849, 73, 38, 1),
-- Wizard
(850, 73, 39, 1),
(851, 73, 40, 1),
(852, 73, 41, 1),
(853, 73, 42, 1),
(854, 73, 43, 1),
(855, 73, 44, 1),
(856, 73, 45, 1),
(857, 73, 46, 1),
-- Eldritch Knight Fighter / Arcane Trickster Rogue Lvl3
(858, 73, 30, 3),
(859, 73, 19, 3),
-- Wrathful Smite ###########################
-- Paladin Lvl2
(860, 74, 23, 2),
(861, 74, 24, 2),
(862, 74, 25, 2),
(863, 74, 26, 2);



-- Insert data into RacesSpells table
INSERT INTO races_spells (`id`, id_spell_id, id_sub_race_id, id_level_id) VALUES
-- Cantrips ###########################
-- Acid Splash ###########################
(1, 1, 2, 1),
(2, 1, 6, 1),
-- Blade Ward ###########################
(3, 2, 2, 1),
(4, 2, 6, 1),
-- Bone Chill ###########################
(5, 3, 2, 1),
(6, 3, 6, 1),
-- Dancing Lights ###########################
(7, 4, 2, 1),
(8, 4, 4, 1),
(9, 4, 5, 1),
(10, 4, 6, 1),
(11, 4, 8, 1),
-- Eldritch Blast ###########################
-- None
-- Fire Bolt ###########################
(12, 6, 2, 1),
(13, 6, 6, 1),
-- Friends ###########################
(14, 7, 2, 1),
(15, 7, 6, 1),
-- Guidance ###########################
-- None
-- Light ###########################
(16, 9, 2, 1),
(17, 9, 6, 1),
-- Mage Hand ###########################
(18, 10, 2, 1),
(19, 10, 6, 1),
(20, 10, 19, 1),
(21, 10, 21, 1),
-- Mage Illusion ###########################
(22, 11, 2, 1),
(23, 11, 6, 1),
-- Poison Spray ###########################
(24, 12, 2, 1),
(25, 12, 6, 1),
-- Produce Flame ###########################
(26, 13, 18, 1),
-- Ray of Frost ###########################
(27, 14, 2, 1),
(28, 14, 6, 1),
-- Resistance ###########################
-- None
-- Sacred Flame ###########################
-- None
-- Shillelagh ###########################
-- None
-- Shocking Grasp ###########################
(29, 18, 2, 1),
(30, 18, 6, 1),
-- Thaumaturgy ###########################
(31, 19, 20, 1),
-- Thorn Whip ###########################
-- None
-- True Strike ###########################
(32, 21, 2, 1),
(33, 21, 6, 1),
-- Vicious Mockery ###########################
-- None
--  ########################### ###########################
-- Spells lvl 1 ###########################
-- Burning Hands ###########################
(34, 28, 19, 3),
-- Enhance Leap ###########################
(35, 39, 21, 3),
-- Faerie Fire ###########################
(36, 43, 4, 1),
(37, 43, 5, 1),
(38, 43, 8, 1),
-- Hellish Rebuke ###########################
(39, 53, 18, 3),
-- Searing Smite ###########################
(40, 65, 20, 3),
-- Speak with Animals ###########################
(41, 69, 15, 1);

