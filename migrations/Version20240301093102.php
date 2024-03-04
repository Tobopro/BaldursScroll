<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240301093102 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
      
        $this->addSql('ALTER TABLE commentaries DROP FOREIGN KEY FK_4ED55CCBFBF32840');
        $this->addSql('ALTER TABLE commentaries ADD CONSTRAINT FK_4ED55CCBFBF32840 FOREIGN KEY (response_id) REFERENCES commentaries (id)');
     
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaries DROP FOREIGN KEY FK_4ED55CCBFBF32840');
        $this->addSql('ALTER TABLE commentaries ADD CONSTRAINT FK_4ED55CCBFBF32840 FOREIGN KEY (response_id) REFERENCES commentaries (id) ON UPDATE NO ACTION ON DELETE CASCADE');
  
    }
}
