<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240604180941 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE avis (id INT AUTO_INCREMENT NOT NULL, avis LONGTEXT NOT NULL, date_avis DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE client ADD avis_id INT NOT NULL');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455197E709F FOREIGN KEY (avis_id) REFERENCES avis (id)');
        $this->addSql('CREATE INDEX IDX_C7440455197E709F ON client (avis_id)');
        $this->addSql('ALTER TABLE hotel ADD avis_id INT NOT NULL');
        $this->addSql('ALTER TABLE hotel ADD CONSTRAINT FK_3535ED9197E709F FOREIGN KEY (avis_id) REFERENCES avis (id)');
        $this->addSql('CREATE INDEX IDX_3535ED9197E709F ON hotel (avis_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455197E709F');
        $this->addSql('ALTER TABLE hotel DROP FOREIGN KEY FK_3535ED9197E709F');
        $this->addSql('DROP TABLE avis');
        $this->addSql('DROP INDEX IDX_C7440455197E709F ON client');
        $this->addSql('ALTER TABLE client DROP avis_id');
        $this->addSql('DROP INDEX IDX_3535ED9197E709F ON hotel');
        $this->addSql('ALTER TABLE hotel DROP avis_id');
    }
}
