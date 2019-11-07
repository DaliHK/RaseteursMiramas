<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191107131043 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE participation (id INT AUTO_INCREMENT NOT NULL, id_adherent_id INT DEFAULT NULL, id_evenement_id INT DEFAULT NULL, INDEX IDX_AB55E24F3DE2A1A4 (id_adherent_id), INDEX IDX_AB55E24F2C115A61 (id_evenement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_AB55E24F3DE2A1A4 FOREIGN KEY (id_adherent_id) REFERENCES adherent (id)');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_AB55E24F2C115A61 FOREIGN KEY (id_evenement_id) REFERENCES evenement (id)');
        $this->addSql('DROP TABLE evenement_adherent');
        $this->addSql('DROP TABLE rememberme_token');
        $this->addSql('ALTER TABLE evenement CHANGE description_evenement description_evenement TINYTEXT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE evenement_adherent (evenement_id INT NOT NULL, adherent_id INT NOT NULL, INDEX IDX_1FB56B88FD02F13 (evenement_id), INDEX IDX_1FB56B8825F06C53 (adherent_id), PRIMARY KEY(evenement_id, adherent_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE rememberme_token (series CHAR(88) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, value CHAR(88) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, lastUsed DATETIME NOT NULL, class VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, username VARCHAR(200) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(series)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE evenement_adherent ADD CONSTRAINT FK_1FB56B8825F06C53 FOREIGN KEY (adherent_id) REFERENCES adherent (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE evenement_adherent ADD CONSTRAINT FK_1FB56B88FD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE participation');
        $this->addSql('ALTER TABLE evenement CHANGE description_evenement description_evenement VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
