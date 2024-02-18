<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190404122117 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE maintenance_employe (maintenance_id INT NOT NULL, employe_id INT NOT NULL, INDEX IDX_81F2962BF6C202BC (maintenance_id), INDEX IDX_81F2962B1B65292 (employe_id), PRIMARY KEY(maintenance_id, employe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vols (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vols_employe (vols_id INT NOT NULL, employe_id INT NOT NULL, INDEX IDX_981576C6573E0EFC (vols_id), INDEX IDX_981576C61B65292 (employe_id), PRIMARY KEY(vols_id, employe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE maintenance_employe ADD CONSTRAINT FK_81F2962BF6C202BC FOREIGN KEY (maintenance_id) REFERENCES maintenance (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE maintenance_employe ADD CONSTRAINT FK_81F2962B1B65292 FOREIGN KEY (employe_id) REFERENCES employe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vols_employe ADD CONSTRAINT FK_981576C6573E0EFC FOREIGN KEY (vols_id) REFERENCES vols (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vols_employe ADD CONSTRAINT FK_981576C61B65292 FOREIGN KEY (employe_id) REFERENCES employe (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE vols_employe DROP FOREIGN KEY FK_981576C6573E0EFC');
        $this->addSql('DROP TABLE maintenance_employe');
        $this->addSql('DROP TABLE vols');
        $this->addSql('DROP TABLE vols_employe');
    }
}
