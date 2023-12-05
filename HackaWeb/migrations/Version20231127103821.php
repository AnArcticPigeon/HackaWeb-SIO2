<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231127103821 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681EF214A644');
        $this->addSql('DROP INDEX IDX_B26681EF214A644 ON evenement');
        $this->addSql('ALTER TABLE evenement CHANGE le_hackaton_id idHackaton INT DEFAULT NULL');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681EE0C15918 FOREIGN KEY (idHackaton) REFERENCES hackaton (id)');
        $this->addSql('CREATE INDEX IDX_B26681EE0C15918 ON evenement (idHackaton)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681EE0C15918');
        $this->addSql('DROP INDEX IDX_B26681EE0C15918 ON evenement');
        $this->addSql('ALTER TABLE evenement CHANGE idHackaton le_hackaton_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681EF214A644 FOREIGN KEY (le_hackaton_id) REFERENCES hackaton (id)');
        $this->addSql('CREATE INDEX IDX_B26681EF214A644 ON evenement (le_hackaton_id)');
    }
}
