<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230821062937 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE controle_tech (id INT AUTO_INCREMENT NOT NULL, num_plaque_id INT DEFAULT NULL, marque VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, modele VARCHAR(255) NOT NULL, mise_circulation VARCHAR(255) NOT NULL, num_chassis VARCHAR(255) NOT NULL, date_delivrance DATE NOT NULL, date_expiration DATE NOT NULL, INDEX IDX_C581CD9FAA45FBCA (num_plaque_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE controle_tech ADD CONSTRAINT FK_C581CD9FAA45FBCA FOREIGN KEY (num_plaque_id) REFERENCES detenteur (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE controle_tech DROP FOREIGN KEY FK_C581CD9FAA45FBCA');
        $this->addSql('DROP TABLE controle_tech');
    }
}
