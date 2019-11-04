<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191104133520 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE adherent (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_naissance DATE NOT NULL, date_inscription DATE NOT NULL, email VARCHAR(255) NOT NULL, telephone INT NOT NULL, adresse VARCHAR(255) NOT NULL, cp INT NOT NULL, ville VARCHAR(255) NOT NULL, numero_urgence INT DEFAULT NULL, statut VARCHAR(255) NOT NULL, cotisation_asso TINYINT(1) NOT NULL, cotisation_licence TINYINT(1) DEFAULT NULL, num_licence VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_90D3F060F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dossier_inscription (id INT AUTO_INCREMENT NOT NULL, adherent_id INT NOT NULL, photo_identite VARCHAR(255) NOT NULL, certificat_medical VARCHAR(255) NOT NULL, droit_image VARCHAR(255) NOT NULL, droit_transport VARCHAR(255) NOT NULL, droit_pratique VARCHAR(255) NOT NULL, droit_entrainement VARCHAR(255) NOT NULL, renseignements_medicaux VARCHAR(255) NOT NULL, renseignementsgeneraux VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_15BA58D525F06C53 (adherent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evenement (id INT AUTO_INCREMENT NOT NULL, date_debut DATE NOT NULL, date_fin VARCHAR(255) NOT NULL, nombre_participant_max DATE NOT NULL, niveau_requis VARCHAR(255) NOT NULL, description_evenement VARCHAR(255) NOT NULL, categorie VARCHAR(255) DEFAULT NULL, titre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE modele_document (id INT AUTO_INCREMENT NOT NULL, certificat_medical VARCHAR(255) NOT NULL, droit_image VARCHAR(255) NOT NULL, droit_transport VARCHAR(255) NOT NULL, droit_pratique VARCHAR(255) NOT NULL, droit_entrainement VARCHAR(255) NOT NULL, renseignements_medicaux VARCHAR(255) NOT NULL, renseignements_generaux VARCHAR(255) NOT NULL, reglement VARCHAR(255) NOT NULL, statuts VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE participation (id INT AUTO_INCREMENT NOT NULL, id_adherent_id INT DEFAULT NULL, id_evenement_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_AB55E24F3DE2A1A4 (id_adherent_id), UNIQUE INDEX UNIQ_AB55E24F2C115A61 (id_evenement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE source_photo (id INT AUTO_INCREMENT NOT NULL, vie_ecole VARCHAR(255) NOT NULL, course_camarguaise VARCHAR(255) NOT NULL, illustration_agenda VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE texte_accueil (id INT AUTO_INCREMENT NOT NULL, section1 VARCHAR(255) DEFAULT NULL, section2 VARCHAR(255) DEFAULT NULL, section3 VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE texte_footer (id INT AUTO_INCREMENT NOT NULL, section1 VARCHAR(255) DEFAULT NULL, section2 VARCHAR(255) DEFAULT NULL, section3 VARCHAR(255) DEFAULT NULL, section4 VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE texte_presentation_ecole (id INT AUTO_INCREMENT NOT NULL, section1 VARCHAR(255) DEFAULT NULL, section3 VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE dossier_inscription ADD CONSTRAINT FK_15BA58D525F06C53 FOREIGN KEY (adherent_id) REFERENCES adherent (id)');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_AB55E24F3DE2A1A4 FOREIGN KEY (id_adherent_id) REFERENCES adherent (id)');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_AB55E24F2C115A61 FOREIGN KEY (id_evenement_id) REFERENCES evenement (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE dossier_inscription DROP FOREIGN KEY FK_15BA58D525F06C53');
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY FK_AB55E24F3DE2A1A4');
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY FK_AB55E24F2C115A61');
        $this->addSql('DROP TABLE adherent');
        $this->addSql('DROP TABLE dossier_inscription');
        $this->addSql('DROP TABLE evenement');
        $this->addSql('DROP TABLE modele_document');
        $this->addSql('DROP TABLE participation');
        $this->addSql('DROP TABLE source_photo');
        $this->addSql('DROP TABLE texte_accueil');
        $this->addSql('DROP TABLE texte_footer');
        $this->addSql('DROP TABLE texte_presentation_ecole');
    }
}
