<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231127101225 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE conferance DROP FOREIGN KEY FK_1E77A49FD2E85C64');
        $this->addSql('DROP TABLE conferance');
        $this->addSql('ALTER TABLE evenement ADD l_intervenant_id INT DEFAULT NULL, DROP lintervenant_id');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681ED2E85C64 FOREIGN KEY (l_intervenant_id) REFERENCES intervenant (id)');
        $this->addSql('CREATE INDEX IDX_B26681ED2E85C64 ON evenement (l_intervenant_id)');
        $this->addSql('ALTER TABLE hackaton ADD la_ville_id INT DEFAULT NULL, ADD dateDeb DATE NOT NULL, ADD dateFin DATE NOT NULL, ADD dateLimit DATE NOT NULL, DROP date_deb, DROP date_fin, DROP date_limit, CHANGE nb_place nbPlace INT NOT NULL');
        $this->addSql('ALTER TABLE hackaton ADD CONSTRAINT FK_B3627343609A8BA5 FOREIGN KEY (la_ville_id) REFERENCES ville (id)');
        $this->addSql('CREATE INDEX IDX_B3627343609A8BA5 ON hackaton (la_ville_id)');
        $this->addSql('ALTER TABLE utilisateur CHANGE date_naiss dateNaiss DATE DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE conferance (id INT AUTO_INCREMENT NOT NULL, l_intervenant_id INT DEFAULT NULL, INDEX IDX_1E77A49FD2E85C64 (l_intervenant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE conferance ADD CONSTRAINT FK_1E77A49FD2E85C64 FOREIGN KEY (l_intervenant_id) REFERENCES intervenant (id)');
        $this->addSql('ALTER TABLE hackaton DROP FOREIGN KEY FK_B3627343609A8BA5');
        $this->addSql('DROP INDEX IDX_B3627343609A8BA5 ON hackaton');
        $this->addSql('ALTER TABLE hackaton ADD date_deb DATE NOT NULL, ADD date_fin DATE NOT NULL, ADD date_limit DATE NOT NULL, DROP la_ville_id, DROP dateDeb, DROP dateFin, DROP dateLimit, CHANGE nbPlace nb_place INT NOT NULL');
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681ED2E85C64');
        $this->addSql('DROP INDEX IDX_B26681ED2E85C64 ON evenement');
        $this->addSql('ALTER TABLE evenement ADD lintervenant_id INT NOT NULL, DROP l_intervenant_id');
        $this->addSql('ALTER TABLE utilisateur CHANGE dateNaiss date_naiss DATE DEFAULT NULL');
    }
}
