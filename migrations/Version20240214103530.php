<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240214103530 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE spells_level DROP FOREIGN KEY FK_A06E847217452598');
        $this->addSql('ALTER TABLE spells_level DROP FOREIGN KEY FK_A06E8472F6AA732');
        $this->addSql('DROP TABLE spells_level');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE spells_level (id INT AUTO_INCREMENT NOT NULL, id_level_id INT NOT NULL, id_spell_id INT NOT NULL, UNIQUE INDEX UNIQ_A06E847217452598 (id_spell_id), UNIQUE INDEX UNIQ_A06E8472F6AA732 (id_level_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb3 COLLATE `utf8mb3_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE spells_level ADD CONSTRAINT FK_A06E847217452598 FOREIGN KEY (id_spell_id) REFERENCES spells (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE spells_level ADD CONSTRAINT FK_A06E8472F6AA732 FOREIGN KEY (id_level_id) REFERENCES levels (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
