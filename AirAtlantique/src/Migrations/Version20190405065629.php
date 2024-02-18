<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190405065629 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE vols_employe DROP FOREIGN KEY FK_981576C6573E0EFC');
        $this->addSql('CREATE TABLE vol_employe (vol_id INT NOT NULL, employe_id INT NOT NULL, INDEX IDX_EC5E9BC9F2BFB7A (vol_id), INDEX IDX_EC5E9BC1B65292 (employe_id), PRIMARY KEY(vol_id, employe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE vol_employe ADD CONSTRAINT FK_EC5E9BC9F2BFB7A FOREIGN KEY (vol_id) REFERENCES vol (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vol_employe ADD CONSTRAINT FK_EC5E9BC1B65292 FOREIGN KEY (employe_id) REFERENCES employe (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE vols');
        $this->addSql('DROP TABLE vols_employe');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE vols (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE vols_employe (vols_id INT NOT NULL, employe_id INT NOT NULL, INDEX IDX_981576C61B65292 (employe_id), INDEX IDX_981576C6573E0EFC (vols_id), PRIMARY KEY(vols_id, employe_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE vols_employe ADD CONSTRAINT FK_981576C61B65292 FOREIGN KEY (employe_id) REFERENCES employe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vols_employe ADD CONSTRAINT FK_981576C6573E0EFC FOREIGN KEY (vols_id) REFERENCES vols (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE vol_employe');
    }
}
