<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240305081745 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $table = $schema->getTable('classes');
        if (!$table->hasColumn('subclass_unlock_id')) {
            $this->addSql('ALTER TABLE classes ADD subclass_unlock_id INT NOT NULL');
            $this->addSql('ALTER TABLE classes ADD CONSTRAINT FK_2ED7EC5515F4ABA FOREIGN KEY (subclass_unlock_id) REFERENCES levels (id)');
            $this->addSql('CREATE INDEX IDX_2ED7EC5515F4ABA ON classes (subclass_unlock_id)');
        }

        $this->addSql('ALTER TABLE user CHANGE sign_in_date sign_in_date DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE classes DROP FOREIGN KEY FK_2ED7EC5515F4ABA');
        $this->addSql('DROP INDEX IDX_2ED7EC5515F4ABA ON classes');
        $this->addSql('ALTER TABLE classes DROP subclass_unlock_id');
        $this->addSql('ALTER TABLE user CHANGE sign_in_date sign_in_date DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
    }
}
