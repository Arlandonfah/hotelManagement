<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240604181553 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE paiement (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, paiement_id INT NOT NULL, date_debut DATETIME NOT NULL, date_fin DATETIME NOT NULL, paye VARCHAR(255) NOT NULL, INDEX IDX_42C849552A4C4478 (paiement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849552A4C4478 FOREIGN KEY (paiement_id) REFERENCES paiement (id)');
        $this->addSql('ALTER TABLE chambre ADD reservation_id INT NOT NULL');
        $this->addSql('ALTER TABLE chambre ADD CONSTRAINT FK_C509E4FFB83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id)');
        $this->addSql('CREATE INDEX IDX_C509E4FFB83297E7 ON chambre (reservation_id)');
        $this->addSql('ALTER TABLE client ADD reservation_id INT NOT NULL');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id)');
        $this->addSql('CREATE INDEX IDX_C7440455B83297E7 ON client (reservation_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chambre DROP FOREIGN KEY FK_C509E4FFB83297E7');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455B83297E7');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849552A4C4478');
        $this->addSql('DROP TABLE paiement');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP INDEX IDX_C509E4FFB83297E7 ON chambre');
        $this->addSql('ALTER TABLE chambre DROP reservation_id');
        $this->addSql('DROP INDEX IDX_C7440455B83297E7 ON client');
        $this->addSql('ALTER TABLE client DROP reservation_id');
    }
}
