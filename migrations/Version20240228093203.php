<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240228093203 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
       $this->addSql('ALTER TABLE commentaries DROP FOREIGN KEY FK_4ED55CCBFBF32840');
        $this->addSql('ALTER TABLE commentaries ADD CONSTRAINT FK_4ED55CCBFBF32840 FOREIGN KEY (response_id) REFERENCES commentaries (id) ON DELETE CASCADE');
    $this->addSql('ALTER TABLE user CHANGE sign_in_date sign_in_date DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE classes_spells DROP FOREIGN KEY FK_A4A4FFA08F8F75EF');
        $this->addSql('ALTER TABLE classes_spells DROP FOREIGN KEY FK_A4A4FFA017452598');
        $this->addSql('ALTER TABLE classes_spells DROP FOREIGN KEY FK_A4A4FFA0F6AA732');
        $this->addSql('DROP INDEX UNIQ_A4A4FFA08F8F75EF ON classes_spells');
        $this->addSql('DROP INDEX UNIQ_A4A4FFA017452598 ON classes_spells');
        $this->addSql('DROP INDEX UNIQ_C08D4AB1F6AA732 ON races_spells');
        $this->addSql('DROP INDEX UNIQ_C08D4AB1993450E ON races_spells');
        $this->addSql('CREATE INDEX UNIQ_C08D4AB1F6AA732 ON races_spells (id_level_id)');
        $this->addSql('CREATE INDEX UNIQ_C08D4AB1993450E ON races_spells (id_sub_race_id)');
        $this->addSql('ALTER TABLE commentaries DROP FOREIGN KEY FK_4ED55CCBFBF32840');
        $this->addSql('ALTER TABLE commentaries ADD CONSTRAINT FK_4ED55CCBFBF32840 FOREIGN KEY (response_id) REFERENCES commentaries (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE `user` CHANGE sign_in_date sign_in_date DATE NOT NULL');
    }
}
