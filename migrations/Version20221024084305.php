<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221024084305 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE agence CHANGE titre titre VARCHAR(200) NOT NULL, CHANGE adresse adresse VARCHAR(255) NOT NULL, CHANGE description description LONGTEXT NOT NULL, CHANGE photo photo VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE vehicule CHANGE id_agence_id id_agence_id INT DEFAULT NULL, CHANGE marque marque VARCHAR(50) NOT NULL, CHANGE modele modele VARCHAR(50) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE agence CHANGE titre titre VARCHAR(255) NOT NULL, CHANGE adresse adresse VARCHAR(50) NOT NULL, CHANGE description description VARCHAR(250) NOT NULL, CHANGE photo photo VARCHAR(200) NOT NULL');
        $this->addSql('ALTER TABLE vehicule CHANGE id_agence_id id_agence_id INT NOT NULL, CHANGE marque marque VARCHAR(255) NOT NULL, CHANGE modele modele VARCHAR(255) NOT NULL');
    }
}
