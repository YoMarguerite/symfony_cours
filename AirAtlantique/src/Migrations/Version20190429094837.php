<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190429094837 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE client ADD user_name VARCHAR(255) NOT NULL, ADD first_name VARCHAR(255) NOT NULL, ADD password VARCHAR(255) NOT NULL, DROP nom, DROP prenom, DROP mdp, CHANGE mail mail VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE client ADD nom VARCHAR(50) NOT NULL COLLATE utf8mb4_unicode_ci, ADD prenom VARCHAR(50) NOT NULL COLLATE utf8mb4_unicode_ci, ADD mdp VARCHAR(64) NOT NULL COLLATE utf8mb4_unicode_ci, DROP user_name, DROP first_name, DROP password, CHANGE mail mail VARCHAR(50) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
