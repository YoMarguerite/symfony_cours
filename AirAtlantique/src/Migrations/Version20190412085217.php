<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190412085217 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE ville (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, pays VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE aeroport ADD ville_id INT DEFAULT NULL, DROP ville, DROP pays');
        $this->addSql('ALTER TABLE aeroport ADD CONSTRAINT FK_9FB0D288A73F0036 FOREIGN KEY (ville_id) REFERENCES ville (id)');
        $this->addSql('CREATE INDEX IDX_9FB0D288A73F0036 ON aeroport (ville_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE aeroport DROP FOREIGN KEY FK_9FB0D288A73F0036');
        $this->addSql('DROP TABLE ville');
        $this->addSql('DROP INDEX IDX_9FB0D288A73F0036 ON aeroport');
        $this->addSql('ALTER TABLE aeroport ADD ville VARCHAR(50) NOT NULL COLLATE utf8mb4_unicode_ci, ADD pays VARCHAR(50) NOT NULL COLLATE utf8mb4_unicode_ci, DROP ville_id');
    }
}
