<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240604175829 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE chambre (id INT AUTO_INCREMENT NOT NULL, nbre_personne INT NOT NULL, nbre_lit INT NOT NULL, prix VARCHAR(255) NOT NULL, img_chambre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, num_tel VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE hotel ADD chambre_id INT NOT NULL');
        $this->addSql('ALTER TABLE hotel ADD CONSTRAINT FK_3535ED99B177F54 FOREIGN KEY (chambre_id) REFERENCES chambre (id)');
        $this->addSql('CREATE INDEX IDX_3535ED99B177F54 ON hotel (chambre_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE hotel DROP FOREIGN KEY FK_3535ED99B177F54');
        $this->addSql('DROP TABLE chambre');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP INDEX IDX_3535ED99B177F54 ON hotel');
        $this->addSql('ALTER TABLE hotel DROP chambre_id');
    }
}
