<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240221073646 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_A4A4FFA017452598 ON classes_spells');
        $this->addSql('DROP INDEX UNIQ_A4A4FFA08F8F75EF ON classes_spells');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A4A4FFA017452598 ON classes_spells (id_spell_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A4A4FFA08F8F75EF ON classes_spells (id_sub_classes_id)');
        $this->addSql('DROP INDEX UNIQ_C08D4AB1993450E ON races_spells');
        $this->addSql('DROP INDEX UNIQ_C08D4AB1F6AA732 ON races_spells');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C08D4AB1993450E ON races_spells (id_sub_race_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C08D4AB1F6AA732 ON races_spells (id_level_id)');
        $this->addSql('ALTER TABLE user CHANGE sign_in_date sign_in_date DATE DEFAULT CURRENT_DATE NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_C08D4AB1F6AA732 ON races_spells');
        $this->addSql('DROP INDEX UNIQ_C08D4AB1993450E ON races_spells');
        $this->addSql('CREATE INDEX UNIQ_C08D4AB1F6AA732 ON races_spells (id_level_id)');
        $this->addSql('CREATE INDEX UNIQ_C08D4AB1993450E ON races_spells (id_sub_race_id)');
        $this->addSql('DROP INDEX UNIQ_A4A4FFA08F8F75EF ON classes_spells');
        $this->addSql('DROP INDEX UNIQ_A4A4FFA017452598 ON classes_spells');
        $this->addSql('CREATE INDEX UNIQ_A4A4FFA08F8F75EF ON classes_spells (id_sub_classes_id)');
        $this->addSql('CREATE INDEX UNIQ_A4A4FFA017452598 ON classes_spells (id_spell_id)');
        $this->addSql('ALTER TABLE `user` CHANGE sign_in_date sign_in_date DATE DEFAULT NULL');
    }
}
