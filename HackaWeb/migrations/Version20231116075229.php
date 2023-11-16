<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231116075229 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE atelier ADD dateDeb DATE NOT NULL, ADD dateFin DATE NOT NULL, ADD dateLimit DATE NOT NULL, DROP date_deb, DROP date_fin, DROP date_limit, CHANGE nb_place nbPlace INT NOT NULL');
        $this->addSql('ALTER TABLE conference ADD dateDeb DATE NOT NULL, ADD dateFin DATE NOT NULL, ADD dateLimit DATE NOT NULL, DROP date_deb, DROP date_fin, DROP date_limit');
        $this->addSql('ALTER TABLE evenement ADD dateDeb DATE NOT NULL, ADD dateFin DATE NOT NULL, ADD dateLimit DATE NOT NULL, DROP date_deb, DROP date_fin, DROP date_limit');
        $this->addSql('ALTER TABLE hackaton ADD dateDeb DATE NOT NULL, ADD dateFin DATE NOT NULL, ADD dateLimit DATE NOT NULL, DROP date_deb, DROP date_fin, DROP date_limit, CHANGE nb_place nbPlace INT NOT NULL');
        $this->addSql('ALTER TABLE utilisateur CHANGE date_naiss dateNaiss DATE DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE conference ADD date_deb DATE NOT NULL, ADD date_fin DATE NOT NULL, ADD date_limit DATE NOT NULL, DROP dateDeb, DROP dateFin, DROP dateLimit');
        $this->addSql('ALTER TABLE hackaton ADD date_deb DATE NOT NULL, ADD date_fin DATE NOT NULL, ADD date_limit DATE NOT NULL, DROP dateDeb, DROP dateFin, DROP dateLimit, CHANGE nbPlace nb_place INT NOT NULL');
        $this->addSql('ALTER TABLE atelier ADD date_deb DATE NOT NULL, ADD date_fin DATE NOT NULL, ADD date_limit DATE NOT NULL, DROP dateDeb, DROP dateFin, DROP dateLimit, CHANGE nbPlace nb_place INT NOT NULL');
        $this->addSql('ALTER TABLE evenement ADD date_deb DATE NOT NULL, ADD date_fin DATE NOT NULL, ADD date_limit DATE NOT NULL, DROP dateDeb, DROP dateFin, DROP dateLimit');
        $this->addSql('ALTER TABLE utilisateur CHANGE dateNaiss date_naiss DATE DEFAULT NULL');
    }
}
