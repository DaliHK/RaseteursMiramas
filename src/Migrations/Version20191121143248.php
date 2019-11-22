<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191121143248 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE texte_footer_contact (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) DEFAULT NULL, adresse VARCHAR(255) NOT NULL, cp VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, telephone1 VARCHAR(255) NOT NULL, telephone2 VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE source_photo');
        $this->addSql('DROP TABLE texte_footer');
        $this->addSql('ALTER TABLE adherent CHANGE date_inscription date_inscription DATE DEFAULT NULL, CHANGE numero_urgence numero_urgence VARCHAR(255) DEFAULT NULL, CHANGE statut statut TINYINT(1) DEFAULT NULL, CHANGE cotisation_asso cotisation_asso TINYINT(1) DEFAULT NULL, CHANGE cotisation_licence cotisation_licence TINYINT(1) DEFAULT NULL, CHANGE num_licence num_licence VARCHAR(255) DEFAULT NULL, CHANGE niveau niveau TINYINT(1) DEFAULT NULL, CHANGE nom_urgence nom_urgence VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE evenement CHANGE nombre_participant_max nombre_participant_max INT DEFAULT NULL, CHANGE niveau_requis niveau_requis VARCHAR(255) DEFAULT NULL, CHANGE categorie categorie VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE dossier_inscription CHANGE adherent_id adherent_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE modele_document CHANGE droit_image droit_image VARCHAR(255) DEFAULT NULL, CHANGE droit_transport droit_transport VARCHAR(255) DEFAULT NULL, CHANGE droit_pratique droit_pratique VARCHAR(255) DEFAULT NULL, CHANGE droit_entrainement droit_entrainement VARCHAR(255) DEFAULT NULL, CHANGE renseignements_medicaux renseignements_medicaux VARCHAR(255) DEFAULT NULL, CHANGE renseignements_generaux renseignements_generaux VARCHAR(255) DEFAULT NULL, CHANGE reglement reglement VARCHAR(255) DEFAULT NULL, CHANGE statuts statuts VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE participation_evenement CHANGE adherent_id adherent_id INT DEFAULT NULL, CHANGE evenement_id evenement_id INT DEFAULT NULL, CHANGE date_inscription date_inscription DATE DEFAULT NULL, CHANGE observations observations VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE rememberme_token CHANGE series series CHAR(88) NOT NULL');
        $this->addSql('ALTER TABLE texte_accueil CHANGE section1 section1 VARCHAR(255) DEFAULT NULL, CHANGE section2 section2 VARCHAR(255) DEFAULT NULL, CHANGE section3 section3 VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE texte_presentation_ecole CHANGE section1 section1 VARCHAR(255) DEFAULT NULL, CHANGE section3 section3 VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE source_photo (id INT AUTO_INCREMENT NOT NULL, vie_ecole VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, course_camarguaise VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, illustration_agenda VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE texte_footer (id INT AUTO_INCREMENT NOT NULL, section1 VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, section2 VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, section3 VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, section4 VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE texte_footer_contact');
        $this->addSql('ALTER TABLE adherent CHANGE date_inscription date_inscription DATE DEFAULT \'NULL\', CHANGE numero_urgence numero_urgence VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE statut statut TINYINT(1) DEFAULT \'NULL\', CHANGE cotisation_asso cotisation_asso TINYINT(1) DEFAULT \'NULL\', CHANGE cotisation_licence cotisation_licence TINYINT(1) DEFAULT \'NULL\', CHANGE num_licence num_licence VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE niveau niveau TINYINT(1) DEFAULT \'NULL\', CHANGE nom_urgence nom_urgence VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE dossier_inscription CHANGE adherent_id adherent_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE evenement CHANGE nombre_participant_max nombre_participant_max INT DEFAULT NULL, CHANGE niveau_requis niveau_requis VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE categorie categorie VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE modele_document CHANGE droit_image droit_image VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE droit_transport droit_transport VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE droit_pratique droit_pratique VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE droit_entrainement droit_entrainement VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE renseignements_medicaux renseignements_medicaux VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE renseignements_generaux renseignements_generaux VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE reglement reglement VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE statuts statuts VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE participation_evenement CHANGE adherent_id adherent_id INT DEFAULT NULL, CHANGE evenement_id evenement_id INT DEFAULT NULL, CHANGE date_inscription date_inscription DATE DEFAULT \'NULL\', CHANGE observations observations VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE rememberme_token CHANGE series series CHAR(88) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE texte_accueil CHANGE section1 section1 VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE section2 section2 VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE section3 section3 VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE texte_presentation_ecole CHANGE section1 section1 VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE section3 section3 VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
