<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191110203203 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE participation_evenement (id INT AUTO_INCREMENT NOT NULL, adherent_id INT DEFAULT NULL, evenement_id INT DEFAULT NULL, date_inscription DATE DEFAULT NULL, observations VARCHAR(255) DEFAULT NULL, INDEX IDX_65A1467525F06C53 (adherent_id), INDEX IDX_65A14675FD02F13 (evenement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE participation_evenement ADD CONSTRAINT FK_65A1467525F06C53 FOREIGN KEY (adherent_id) REFERENCES adherent (id)');
        $this->addSql('ALTER TABLE participation_evenement ADD CONSTRAINT FK_65A14675FD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id)');
        $this->addSql('ALTER TABLE dossier_inscription CHANGE photo_identite photo_identite VARCHAR(255) NOT NULL, CHANGE certificat_medical certificat_medical VARCHAR(255) NOT NULL, CHANGE droit_image droit_image VARCHAR(255) NOT NULL, CHANGE droit_transport droit_transport VARCHAR(255) NOT NULL, CHANGE droit_pratique droit_pratique VARCHAR(255) NOT NULL, CHANGE droit_entrainement droit_entrainement VARCHAR(255) NOT NULL, CHANGE renseignements_medicaux renseignements_medicaux VARCHAR(255) NOT NULL, CHANGE renseignementsgeneraux renseignementsgeneraux VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE rememberme_token CHANGE series series CHAR(88) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE participation_evenement');
        $this->addSql('ALTER TABLE dossier_inscription CHANGE photo_identite photo_identite VARCHAR(256) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE certificat_medical certificat_medical VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE droit_image droit_image VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE droit_transport droit_transport VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE droit_pratique droit_pratique VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE droit_entrainement droit_entrainement VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE renseignements_medicaux renseignements_medicaux VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE renseignementsgeneraux renseignementsgeneraux VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE rememberme_token CHANGE series series CHAR(88) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
