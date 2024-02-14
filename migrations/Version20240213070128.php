<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240213070128 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE test');
        $this->addSql('ALTER TABLE characters RENAME INDEX idx_e0147e9a993450e TO IDX_3A29410E993450E');
        $this->addSql('ALTER TABLE characters RENAME INDEX idx_e0147e9a8f8f75ef TO IDX_3A29410E8F8F75EF');
        $this->addSql('ALTER TABLE characters RENAME INDEX idx_e0147e9a376858a8 TO IDX_3A29410E376858A8');
        $this->addSql('ALTER TABLE levels ADD characters_id INT DEFAULT NULL, ADD classes_spells_id INT NOT NULL');
        $this->addSql('ALTER TABLE levels ADD CONSTRAINT FK_9F2A6419C70F0E28 FOREIGN KEY (characters_id) REFERENCES characters (id)');
        $this->addSql('ALTER TABLE levels ADD CONSTRAINT FK_9F2A6419FDA60277 FOREIGN KEY (classes_spells_id) REFERENCES classes_spells (id)');
        $this->addSql('CREATE INDEX IDX_9F2A6419C70F0E28 ON levels (characters_id)');
        $this->addSql('CREATE INDEX IDX_9F2A6419FDA60277 ON levels (classes_spells_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE test (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_unicode_ci`, email VARCHAR(255) CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb3 COLLATE `utf8mb3_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE levels DROP FOREIGN KEY FK_9F2A6419C70F0E28');
        $this->addSql('ALTER TABLE levels DROP FOREIGN KEY FK_9F2A6419FDA60277');
        $this->addSql('DROP INDEX IDX_9F2A6419C70F0E28 ON levels');
        $this->addSql('DROP INDEX IDX_9F2A6419FDA60277 ON levels');
        $this->addSql('ALTER TABLE levels DROP characters_id, DROP classes_spells_id');
        $this->addSql('ALTER TABLE characters RENAME INDEX idx_3a29410e376858a8 TO IDX_E0147E9A376858A8');
        $this->addSql('ALTER TABLE characters RENAME INDEX idx_3a29410e8f8f75ef TO IDX_E0147E9A8F8F75EF');
        $this->addSql('ALTER TABLE characters RENAME INDEX idx_3a29410e993450e TO IDX_E0147E9A993450E');
    }
}
