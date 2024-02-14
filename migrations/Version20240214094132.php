<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240214094132 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE characters CHANGE id_sub_race_id id_sub_race_id INT DEFAULT NULL, CHANGE id_sub_classes_id id_sub_classes_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE levels ADD characters_id INT DEFAULT NULL, ADD classes_spells_id INT NOT NULL');
        $this->addSql('ALTER TABLE levels ADD CONSTRAINT FK_9F2A6419C70F0E28 FOREIGN KEY (characters_id) REFERENCES characters (id)');
        $this->addSql('ALTER TABLE levels ADD CONSTRAINT FK_9F2A6419FDA60277 FOREIGN KEY (classes_spells_id) REFERENCES classes_spells (id)');
        $this->addSql('CREATE INDEX IDX_9F2A6419C70F0E28 ON levels (characters_id)');
        $this->addSql('CREATE INDEX IDX_9F2A6419FDA60277 ON levels (classes_spells_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE levels DROP FOREIGN KEY FK_9F2A6419C70F0E28');
        $this->addSql('ALTER TABLE levels DROP FOREIGN KEY FK_9F2A6419FDA60277');
        $this->addSql('DROP INDEX IDX_9F2A6419C70F0E28 ON levels');
        $this->addSql('DROP INDEX IDX_9F2A6419FDA60277 ON levels');
        $this->addSql('ALTER TABLE levels DROP characters_id, DROP classes_spells_id');
        $this->addSql('ALTER TABLE characters CHANGE id_sub_race_id id_sub_race_id INT NOT NULL, CHANGE id_sub_classes_id id_sub_classes_id INT NOT NULL');
    }
}
