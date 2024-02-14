<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240214100011 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE levels DROP FOREIGN KEY FK_9F2A6419C70F0E28');
        $this->addSql('DROP INDEX IDX_9F2A6419C70F0E28 ON levels');
        $this->addSql('ALTER TABLE levels DROP characters_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE levels ADD characters_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE levels ADD CONSTRAINT FK_9F2A6419C70F0E28 FOREIGN KEY (characters_id) REFERENCES characters (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_9F2A6419C70F0E28 ON levels (characters_id)');
    }
}
