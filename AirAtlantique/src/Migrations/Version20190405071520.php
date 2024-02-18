<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190405071520 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE maintenance ADD aeroport_id INT NOT NULL, ADD details LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE maintenance ADD CONSTRAINT FK_2F84F8E9F1089B86 FOREIGN KEY (aeroport_id) REFERENCES aeroport (id)');
        $this->addSql('CREATE INDEX IDX_2F84F8E9F1089B86 ON maintenance (aeroport_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE maintenance DROP FOREIGN KEY FK_2F84F8E9F1089B86');
        $this->addSql('DROP INDEX IDX_2F84F8E9F1089B86 ON maintenance');
        $this->addSql('ALTER TABLE maintenance DROP aeroport_id, DROP details');
    }
}
