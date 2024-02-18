<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190404115134 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE aeroport (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, ville VARCHAR(50) NOT NULL, pays VARCHAR(50) NOT NULL, aita VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE avion (id INT AUTO_INCREMENT NOT NULL, matricule VARCHAR(50) NOT NULL, moteur VARCHAR(50) NOT NULL, kilometre DOUBLE PRECISION DEFAULT NULL, modele VARCHAR(50) NOT NULL, type VARCHAR(50) NOT NULL, passager INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE trajet (id INT AUTO_INCREMENT NOT NULL, depart_id INT NOT NULL, arrivee_id INT NOT NULL, duree TIME NOT NULL, distance DOUBLE PRECISION NOT NULL, INDEX IDX_2B5BA98CAE02FE4B (depart_id), INDEX IDX_2B5BA98CEAF07E42 (arrivee_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE trajet ADD CONSTRAINT FK_2B5BA98CAE02FE4B FOREIGN KEY (depart_id) REFERENCES aeroport (id)');
        $this->addSql('ALTER TABLE trajet ADD CONSTRAINT FK_2B5BA98CEAF07E42 FOREIGN KEY (arrivee_id) REFERENCES aeroport (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE trajet DROP FOREIGN KEY FK_2B5BA98CAE02FE4B');
        $this->addSql('ALTER TABLE trajet DROP FOREIGN KEY FK_2B5BA98CEAF07E42');
        $this->addSql('DROP TABLE aeroport');
        $this->addSql('DROP TABLE avion');
        $this->addSql('DROP TABLE trajet');
    }
}
