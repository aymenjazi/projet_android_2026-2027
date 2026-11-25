<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261125171729 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Utilisateur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, prenom VARCHAR(100) NOT NULL, email VARCHAR(180) NOT NULL, login VARCHAR(100) NOT NULL, mot_de_passe_hash VARCHAR(255) NOT NULL, telephone VARCHAR(20) DEFAULT NULL, photo VARCHAR(255) DEFAULT NULL, role VARCHAR(50) DEFAULT NULL, UNIQUE INDEX UNIQ_9B80EC64E7927C74 (email), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE annonce (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, type_transaction VARCHAR(50) DEFAULT NULL, prix NUMERIC(10, 2) DEFAULT NULL, etat_objet VARCHAR(100) DEFAULT NULL, disponibilte VARCHAR(100) DEFAULT NULL, ville VARCHAR(100) DEFAULT NULL, quartier VARCHAR(100) DEFAULT NULL, date_publication DATE NOT NULL, utilisateur_id INT NOT NULL, categorie_id INT NOT NULL, localisation_id INT NOT NULL, UNIQUE INDEX UNIQ_F65593E5BCF5E72D (categorie_id), INDEX IDX_F65593E5FB88E14F (utilisateur_id), INDEX IDX_F65593E5C68BE09C (localisation_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(100) NOT NULL, description VARCHAR(255) NOT NULL, type_transaction VARCHAR(255) DEFAULT NULL, prix DOUBLE PRECISION NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE demande (id INT AUTO_INCREMENT NOT NULL, date_debut DATE DEFAULT NULL, date_fin DATE DEFAULT NULL, message LONGTEXT DEFAULT NULL, status VARCHAR(50) DEFAULT NULL, date_demande DATE DEFAULT NULL, annonce_id INT NOT NULL, utilisateur_id INT NOT NULL, UNIQUE INDEX UNIQ_2694D7A5FB88E14F (utilisateur_id), INDEX IDX_2694D7A58805AB2F (annonce_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE localisation (id INT AUTO_INCREMENT NOT NULL, ville VARCHAR(100) NOT NULL, quartier VARCHAR(100) DEFAULT NULL, latitude NUMERIC(10, 7) NOT NULL, longitude NUMERIC(10, 7) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE photo_annonce (id INT AUTO_INCREMENT NOT NULL, url_photo VARCHAR(255) NOT NULL, annonce_id INT NOT NULL, INDEX IDX_C3B584688805AB2F (annonce_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E5FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES Utilisateur (id)');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E5BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E5C68BE09C FOREIGN KEY (localisation_id) REFERENCES localisation (id)');
        $this->addSql('ALTER TABLE demande ADD CONSTRAINT FK_2694D7A58805AB2F FOREIGN KEY (annonce_id) REFERENCES annonce (id)');
        $this->addSql('ALTER TABLE demande ADD CONSTRAINT FK_2694D7A5FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES Utilisateur (id)');
        $this->addSql('ALTER TABLE photo_annonce ADD CONSTRAINT FK_C3B584688805AB2F FOREIGN KEY (annonce_id) REFERENCES annonce (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E5FB88E14F');
        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E5BCF5E72D');
        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E5C68BE09C');
        $this->addSql('ALTER TABLE demande DROP FOREIGN KEY FK_2694D7A58805AB2F');
        $this->addSql('ALTER TABLE demande DROP FOREIGN KEY FK_2694D7A5FB88E14F');
        $this->addSql('ALTER TABLE photo_annonce DROP FOREIGN KEY FK_C3B584688805AB2F');
        $this->addSql('DROP TABLE Utilisateur');
        $this->addSql('DROP TABLE annonce');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE demande');
        $this->addSql('DROP TABLE localisation');
        $this->addSql('DROP TABLE photo_annonce');
    }
}
