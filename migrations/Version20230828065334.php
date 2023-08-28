<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230828065334 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE carte_crise (id INT AUTO_INCREMENT NOT NULL, num_plaque_id INT DEFAULT NULL, noms VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, num_impot VARCHAR(255) NOT NULL, date_mise_circulation DATE NOT NULL, type_usage VARCHAR(255) NOT NULL, date_delivrance DATE NOT NULL, INDEX IDX_2FE5A905AA45FBCA (num_plaque_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE carte_crise ADD CONSTRAINT FK_2FE5A905AA45FBCA FOREIGN KEY (num_plaque_id) REFERENCES detenteur (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE carte_crise DROP FOREIGN KEY FK_2FE5A905AA45FBCA');
        $this->addSql('DROP TABLE carte_crise');
    }
}
