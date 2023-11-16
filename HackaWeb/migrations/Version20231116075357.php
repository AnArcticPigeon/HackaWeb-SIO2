<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231116075357 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equipe ADD nomEquipe VARCHAR(255) NOT NULL, ADD numInsc VARCHAR(255) NOT NULL, DROP nom_equipe, DROP num_insc, CHANGE date_insc dateInsc DATE NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equipe ADD nom_equipe VARCHAR(255) NOT NULL, ADD num_insc VARCHAR(255) NOT NULL, DROP nomEquipe, DROP numInsc, CHANGE dateInsc date_insc DATE NOT NULL');
    }
}
