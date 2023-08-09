<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230809104043 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE assurance (id INT AUTO_INCREMENT NOT NULL, num_plaque_id INT DEFAULT NULL, num_agreement INT NOT NULL, num_police VARCHAR(255) NOT NULL, marque VARCHAR(255) NOT NULL, ttr INT NOT NULL, type VARCHAR(255) NOT NULL, anee_fab VARCHAR(255) NOT NULL, echeance DATE NOT NULL, chassis VARCHAR(255) NOT NULL, INDEX IDX_386829AEAA45FBCA (num_plaque_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE assurance ADD CONSTRAINT FK_386829AEAA45FBCA FOREIGN KEY (num_plaque_id) REFERENCES detenteur (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE assurance DROP FOREIGN KEY FK_386829AEAA45FBCA');
        $this->addSql('DROP TABLE assurance');
    }
}
