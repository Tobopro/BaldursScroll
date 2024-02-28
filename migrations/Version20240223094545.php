<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240223094545 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE characters (id INT AUTO_INCREMENT NOT NULL, id_sub_race_id INT DEFAULT NULL, id_sub_classes_id INT DEFAULT NULL, id_users_id INT NOT NULL, id_level_id INT DEFAULT NULL, name VARCHAR(50) NOT NULL, strength INT NOT NULL, dexterity INT NOT NULL, constitution INT NOT NULL, intelligence INT NOT NULL, wisdom INT NOT NULL, charisma INT NOT NULL, ability_score_bonus1 VARCHAR(20) NOT NULL, ability_score_bonus2 VARCHAR(20) NOT NULL, INDEX IDX_3A29410E993450E (id_sub_race_id), INDEX IDX_3A29410E8F8F75EF (id_sub_classes_id), INDEX IDX_3A29410E376858A8 (id_users_id), INDEX IDX_3A29410EF6AA732 (id_level_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classes (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(20) NOT NULL, starting_hp INT NOT NULL, on_level_up_hp INT NOT NULL, saving_throw_proficency1 VARCHAR(50) NOT NULL, saving_throw_proficency2 VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classes_spells (id INT AUTO_INCREMENT NOT NULL, id_sub_classes_id INT NOT NULL, id_spell_id INT NOT NULL, id_level_id INT NOT NULL,  INDEX UNIQ_A4A4FFA08F8F75EF (id_sub_classes_id),  INDEX UNIQ_A4A4FFA017452598 (id_spell_id), INDEX IDX_A4A4FFA0F6AA732 (id_level_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentaries (id INT AUTO_INCREMENT NOT NULL, author_id INT DEFAULT NULL, build_id INT DEFAULT NULL, response_id INT DEFAULT NULL, text VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', modified_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', is_flaged TINYINT(1) DEFAULT 0 NOT NULL, INDEX IDX_4ED55CCBF675F31B (author_id), INDEX IDX_4ED55CCB17C13F8B (build_id), INDEX IDX_4ED55CCBFBF32840 (response_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE levels (id INT AUTO_INCREMENT NOT NULL, level INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE races (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE races_spells (id INT AUTO_INCREMENT NOT NULL, id_level_id INT NOT NULL, id_sub_race_id INT NOT NULL, id_spell_id INT NOT NULL,  INDEX UNIQ_C08D4AB1F6AA732 (id_level_id),  INDEX UNIQ_C08D4AB1993450E (id_sub_race_id), INDEX IDX_C08D4AB117452598 (id_spell_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE spells (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, damage_type VARCHAR(50) DEFAULT NULL, damage_roll VARCHAR(50) DEFAULT NULL, icon VARCHAR(100) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sub_classes (id INT AUTO_INCREMENT NOT NULL, id_class_id INT NOT NULL, name VARCHAR(30) NOT NULL, icon VARCHAR(100) DEFAULT NULL, INDEX IDX_7D352231BADBE785 (id_class_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sub_races (id INT AUTO_INCREMENT NOT NULL, id_race_id INT NOT NULL, name VARCHAR(30) NOT NULL, speed NUMERIC(3, 1) NOT NULL, INDEX IDX_B1F97A70B0C47D7D (id_race_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, roles JSON NOT NULL, username VARCHAR(50) NOT NULL, email VARCHAR(100) NOT NULL, password VARCHAR(255) NOT NULL, sign_in_date DATE NOT NULL, profile_picture VARCHAR(255) DEFAULT NULL, is_banned TINYINT(1) DEFAULT 0 NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE characters ADD CONSTRAINT FK_3A29410E993450E FOREIGN KEY (id_sub_race_id) REFERENCES sub_races (id)');
        $this->addSql('ALTER TABLE characters ADD CONSTRAINT FK_3A29410E8F8F75EF FOREIGN KEY (id_sub_classes_id) REFERENCES sub_classes (id)');
        $this->addSql('ALTER TABLE characters ADD CONSTRAINT FK_3A29410E376858A8 FOREIGN KEY (id_users_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE characters ADD CONSTRAINT FK_3A29410EF6AA732 FOREIGN KEY (id_level_id) REFERENCES levels (id)');
        $this->addSql('ALTER TABLE classes_spells ADD CONSTRAINT FK_A4A4FFA08F8F75EF FOREIGN KEY (id_sub_classes_id) REFERENCES sub_classes (id)');
        $this->addSql('ALTER TABLE classes_spells ADD CONSTRAINT FK_A4A4FFA017452598 FOREIGN KEY (id_spell_id) REFERENCES spells (id)');
        $this->addSql('ALTER TABLE classes_spells ADD CONSTRAINT FK_A4A4FFA0F6AA732 FOREIGN KEY (id_level_id) REFERENCES levels (id)');
        $this->addSql('ALTER TABLE commentaries ADD CONSTRAINT FK_4ED55CCBF675F31B FOREIGN KEY (author_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE commentaries ADD CONSTRAINT FK_4ED55CCB17C13F8B FOREIGN KEY (build_id) REFERENCES characters (id)');
        $this->addSql('ALTER TABLE commentaries ADD CONSTRAINT FK_4ED55CCBFBF32840 FOREIGN KEY (response_id) REFERENCES commentaries (id)');
        $this->addSql('ALTER TABLE races_spells ADD CONSTRAINT FK_C08D4AB1F6AA732 FOREIGN KEY (id_level_id) REFERENCES levels (id)');
        $this->addSql('ALTER TABLE races_spells ADD CONSTRAINT FK_C08D4AB1993450E FOREIGN KEY (id_sub_race_id) REFERENCES sub_races (id)');
        $this->addSql('ALTER TABLE races_spells ADD CONSTRAINT FK_C08D4AB117452598 FOREIGN KEY (id_spell_id) REFERENCES spells (id)');
        $this->addSql('ALTER TABLE sub_classes ADD CONSTRAINT FK_7D352231BADBE785 FOREIGN KEY (id_class_id) REFERENCES classes (id)');
        $this->addSql('ALTER TABLE sub_races ADD CONSTRAINT FK_B1F97A70B0C47D7D FOREIGN KEY (id_race_id) REFERENCES races (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE characters DROP FOREIGN KEY FK_3A29410E993450E');
        $this->addSql('ALTER TABLE characters DROP FOREIGN KEY FK_3A29410E8F8F75EF');
        $this->addSql('ALTER TABLE characters DROP FOREIGN KEY FK_3A29410E376858A8');
        $this->addSql('ALTER TABLE characters DROP FOREIGN KEY FK_3A29410EF6AA732');
        $this->addSql('ALTER TABLE classes_spells DROP FOREIGN KEY FK_A4A4FFA08F8F75EF');
        $this->addSql('ALTER TABLE classes_spells DROP FOREIGN KEY FK_A4A4FFA017452598');
        $this->addSql('ALTER TABLE classes_spells DROP FOREIGN KEY FK_A4A4FFA0F6AA732');
        $this->addSql('ALTER TABLE commentaries DROP FOREIGN KEY FK_4ED55CCBF675F31B');
        $this->addSql('ALTER TABLE commentaries DROP FOREIGN KEY FK_4ED55CCB17C13F8B');
        $this->addSql('ALTER TABLE commentaries DROP FOREIGN KEY FK_4ED55CCBFBF32840');
        $this->addSql('ALTER TABLE races_spells DROP FOREIGN KEY FK_C08D4AB1F6AA732');
        $this->addSql('ALTER TABLE races_spells DROP FOREIGN KEY FK_C08D4AB1993450E');
        $this->addSql('ALTER TABLE races_spells DROP FOREIGN KEY FK_C08D4AB117452598');
        $this->addSql('ALTER TABLE sub_classes DROP FOREIGN KEY FK_7D352231BADBE785');
        $this->addSql('ALTER TABLE sub_races DROP FOREIGN KEY FK_B1F97A70B0C47D7D');
        $this->addSql('DROP TABLE characters');
        $this->addSql('DROP TABLE classes');
        $this->addSql('DROP TABLE classes_spells');
        $this->addSql('DROP TABLE commentaries');
        $this->addSql('DROP TABLE levels');
        $this->addSql('DROP TABLE races');
        $this->addSql('DROP TABLE races_spells');
        $this->addSql('DROP TABLE spells');
        $this->addSql('DROP TABLE sub_classes');
        $this->addSql('DROP TABLE sub_races');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
