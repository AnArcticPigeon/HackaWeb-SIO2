<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231116072152 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE atelier (id INT AUTO_INCREMENT NOT NULL, date_deb DATE NOT NULL, date_fin DATE NOT NULL, date_limit DATE NOT NULL, nb_place INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipe (id INT AUTO_INCREMENT NOT NULL, nom_equipe VARCHAR(255) NOT NULL, date_insc DATE NOT NULL, num_insc VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur_equipe (utilisateur_id INT NOT NULL, equipe_id INT NOT NULL, INDEX IDX_45E4809EFB88E14F (utilisateur_id), INDEX IDX_45E4809E6D861B89 (equipe_id), PRIMARY KEY(utilisateur_id, equipe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE utilisateur_equipe ADD CONSTRAINT FK_45E4809EFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateur_equipe ADD CONSTRAINT FK_45E4809E6D861B89 FOREIGN KEY (equipe_id) REFERENCES equipe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateur_hackaton DROP FOREIGN KEY FK_AD198ADCB333DC5B');
        $this->addSql('ALTER TABLE utilisateur_hackaton DROP FOREIGN KEY FK_AD198ADCFB88E14F');
        $this->addSql('DROP TABLE utilisateur_hackaton');
        $this->addSql('ALTER TABLE conference ADD lintervenant_id INT NOT NULL, ADD date_deb DATE NOT NULL, ADD date_fin DATE NOT NULL, ADD date_limit DATE NOT NULL');
        $this->addSql('ALTER TABLE conference ADD CONSTRAINT FK_911533C8AA398131 FOREIGN KEY (lintervenant_id) REFERENCES intervenant (id)');
        $this->addSql('CREATE INDEX IDX_911533C8AA398131 ON conference (lintervenant_id)');
        $this->addSql('ALTER TABLE evenement ADD le_hackaton_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681EF214A644 FOREIGN KEY (le_hackaton_id) REFERENCES hackaton (id)');
        $this->addSql('CREATE INDEX IDX_B26681EF214A644 ON evenement (le_hackaton_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE utilisateur_hackaton (utilisateur_id INT NOT NULL, hackaton_id INT NOT NULL, INDEX IDX_AD198ADCFB88E14F (utilisateur_id), INDEX IDX_AD198ADCB333DC5B (hackaton_id), PRIMARY KEY(utilisateur_id, hackaton_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE utilisateur_hackaton ADD CONSTRAINT FK_AD198ADCB333DC5B FOREIGN KEY (hackaton_id) REFERENCES hackaton (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateur_hackaton ADD CONSTRAINT FK_AD198ADCFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateur_equipe DROP FOREIGN KEY FK_45E4809EFB88E14F');
        $this->addSql('ALTER TABLE utilisateur_equipe DROP FOREIGN KEY FK_45E4809E6D861B89');
        $this->addSql('DROP TABLE atelier');
        $this->addSql('DROP TABLE equipe');
        $this->addSql('DROP TABLE utilisateur_equipe');
        $this->addSql('ALTER TABLE conference DROP FOREIGN KEY FK_911533C8AA398131');
        $this->addSql('DROP INDEX IDX_911533C8AA398131 ON conference');
        $this->addSql('ALTER TABLE conference DROP lintervenant_id, DROP date_deb, DROP date_fin, DROP date_limit');
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681EF214A644');
        $this->addSql('DROP INDEX IDX_B26681EF214A644 ON evenement');
        $this->addSql('ALTER TABLE evenement DROP le_hackaton_id');
    }
}
