<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240214100647 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE characters ADD id_level_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE characters ADD CONSTRAINT FK_3A29410EF6AA732 FOREIGN KEY (id_level_id) REFERENCES levels (id)');
        $this->addSql('CREATE INDEX IDX_3A29410EF6AA732 ON characters (id_level_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE characters DROP FOREIGN KEY FK_3A29410EF6AA732');
        $this->addSql('DROP INDEX IDX_3A29410EF6AA732 ON characters');
        $this->addSql('ALTER TABLE characters DROP id_level_id');
    }
}
