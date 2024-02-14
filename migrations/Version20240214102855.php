<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240214102855 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE classes_spells ADD id_level_id INT NOT NULL');
        $this->addSql('ALTER TABLE classes_spells ADD CONSTRAINT FK_A4A4FFA0F6AA732 FOREIGN KEY (id_level_id) REFERENCES levels (id)');
        $this->addSql('CREATE INDEX IDX_A4A4FFA0F6AA732 ON classes_spells (id_level_id)');
        $this->addSql('ALTER TABLE levels DROP FOREIGN KEY FK_9F2A6419FDA60277');
        $this->addSql('DROP INDEX IDX_9F2A6419FDA60277 ON levels');
        $this->addSql('ALTER TABLE levels DROP classes_spells_id');
        $this->addSql('ALTER TABLE races_spells ADD id_spell_id INT NOT NULL');
        $this->addSql('ALTER TABLE races_spells ADD CONSTRAINT FK_C08D4AB117452598 FOREIGN KEY (id_spell_id) REFERENCES spells (id)');
        $this->addSql('CREATE INDEX IDX_C08D4AB117452598 ON races_spells (id_spell_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE races_spells DROP FOREIGN KEY FK_C08D4AB117452598');
        $this->addSql('DROP INDEX IDX_C08D4AB117452598 ON races_spells');
        $this->addSql('ALTER TABLE races_spells DROP id_spell_id');
        $this->addSql('ALTER TABLE levels ADD classes_spells_id INT NOT NULL');
        $this->addSql('ALTER TABLE levels ADD CONSTRAINT FK_9F2A6419FDA60277 FOREIGN KEY (classes_spells_id) REFERENCES classes_spells (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_9F2A6419FDA60277 ON levels (classes_spells_id)');
        $this->addSql('ALTER TABLE classes_spells DROP FOREIGN KEY FK_A4A4FFA0F6AA732');
        $this->addSql('DROP INDEX IDX_A4A4FFA0F6AA732 ON classes_spells');
        $this->addSql('ALTER TABLE classes_spells DROP id_level_id');
    }
}
