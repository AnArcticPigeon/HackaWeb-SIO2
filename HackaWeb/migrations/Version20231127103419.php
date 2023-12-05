<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231127103419 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equipe DROP FOREIGN KEY FK_2449BA15F214A644');
        $this->addSql('DROP INDEX IDX_2449BA15F214A644 ON equipe');
        $this->addSql('ALTER TABLE equipe CHANGE le_hackaton_id idHackaton INT DEFAULT NULL');
        $this->addSql('ALTER TABLE equipe ADD CONSTRAINT FK_2449BA15E0C15918 FOREIGN KEY (idHackaton) REFERENCES hackaton (id)');
        $this->addSql('CREATE INDEX IDX_2449BA15E0C15918 ON equipe (idHackaton)');
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681ED2E85C64');
        $this->addSql('DROP INDEX IDX_B26681ED2E85C64 ON evenement');
        $this->addSql('ALTER TABLE evenement CHANGE l_intervenant_id idIntervenant INT DEFAULT NULL');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681E338DEB24 FOREIGN KEY (idIntervenant) REFERENCES intervenant (id)');
        $this->addSql('CREATE INDEX IDX_B26681E338DEB24 ON evenement (idIntervenant)');
        $this->addSql('ALTER TABLE hackaton DROP FOREIGN KEY FK_B3627343609A8BA5');
        $this->addSql('DROP INDEX IDX_B3627343609A8BA5 ON hackaton');
        $this->addSql('ALTER TABLE hackaton CHANGE la_ville_id idVille INT DEFAULT NULL');
        $this->addSql('ALTER TABLE hackaton ADD CONSTRAINT FK_B362734354079ADE FOREIGN KEY (idVille) REFERENCES ville (id)');
        $this->addSql('CREATE INDEX IDX_B362734354079ADE ON hackaton (idVille)');
        $this->addSql('ALTER TABLE participant DROP FOREIGN KEY FK_D79F6B11DCA36947');
        $this->addSql('DROP INDEX IDX_D79F6B11DCA36947 ON participant');
        $this->addSql('ALTER TABLE participant CHANGE l_atelier_id idAtelier INT DEFAULT NULL');
        $this->addSql('ALTER TABLE participant ADD CONSTRAINT FK_D79F6B11F10273D1 FOREIGN KEY (idAtelier) REFERENCES evenement (id)');
        $this->addSql('CREATE INDEX IDX_D79F6B11F10273D1 ON participant (idAtelier)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE participant DROP FOREIGN KEY FK_D79F6B11F10273D1');
        $this->addSql('DROP INDEX IDX_D79F6B11F10273D1 ON participant');
        $this->addSql('ALTER TABLE participant CHANGE idAtelier l_atelier_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE participant ADD CONSTRAINT FK_D79F6B11DCA36947 FOREIGN KEY (l_atelier_id) REFERENCES evenement (id)');
        $this->addSql('CREATE INDEX IDX_D79F6B11DCA36947 ON participant (l_atelier_id)');
        $this->addSql('ALTER TABLE hackaton DROP FOREIGN KEY FK_B362734354079ADE');
        $this->addSql('DROP INDEX IDX_B362734354079ADE ON hackaton');
        $this->addSql('ALTER TABLE hackaton CHANGE idVille la_ville_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE hackaton ADD CONSTRAINT FK_B3627343609A8BA5 FOREIGN KEY (la_ville_id) REFERENCES ville (id)');
        $this->addSql('CREATE INDEX IDX_B3627343609A8BA5 ON hackaton (la_ville_id)');
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681E338DEB24');
        $this->addSql('DROP INDEX IDX_B26681E338DEB24 ON evenement');
        $this->addSql('ALTER TABLE evenement CHANGE idIntervenant l_intervenant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681ED2E85C64 FOREIGN KEY (l_intervenant_id) REFERENCES intervenant (id)');
        $this->addSql('CREATE INDEX IDX_B26681ED2E85C64 ON evenement (l_intervenant_id)');
        $this->addSql('ALTER TABLE equipe DROP FOREIGN KEY FK_2449BA15E0C15918');
        $this->addSql('DROP INDEX IDX_2449BA15E0C15918 ON equipe');
        $this->addSql('ALTER TABLE equipe CHANGE idHackaton le_hackaton_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE equipe ADD CONSTRAINT FK_2449BA15F214A644 FOREIGN KEY (le_hackaton_id) REFERENCES hackaton (id)');
        $this->addSql('CREATE INDEX IDX_2449BA15F214A644 ON equipe (le_hackaton_id)');
    }
}
