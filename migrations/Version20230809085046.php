<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230809085046 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE vignette (id INT AUTO_INCREMENT NOT NULL, num_plaque_id INT DEFAULT NULL, code VARCHAR(255) NOT NULL, marque VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, montant_impot INT NOT NULL, taxe INT NOT NULL, reference VARCHAR(255) NOT NULL, INDEX IDX_B4B561EAA45FBCA (num_plaque_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE vignette ADD CONSTRAINT FK_B4B561EAA45FBCA FOREIGN KEY (num_plaque_id) REFERENCES detenteur (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vignette DROP FOREIGN KEY FK_B4B561EAA45FBCA');
        $this->addSql('DROP TABLE vignette');
    }
}
