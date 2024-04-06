<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240329121616 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE utilisateur_hackaton_favoris (utilisateur_id INT NOT NULL, hackaton_id INT NOT NULL, INDEX IDX_2CC1FBD4FB88E14F (utilisateur_id), INDEX IDX_2CC1FBD4B333DC5B (hackaton_id), PRIMARY KEY(utilisateur_id, hackaton_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE utilisateur_hackaton_favoris ADD CONSTRAINT FK_2CC1FBD4FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateur_hackaton_favoris ADD CONSTRAINT FK_2CC1FBD4B333DC5B FOREIGN KEY (hackaton_id) REFERENCES hackaton (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE utilisateur_hackaton_favoris DROP FOREIGN KEY FK_2CC1FBD4FB88E14F');
        $this->addSql('ALTER TABLE utilisateur_hackaton_favoris DROP FOREIGN KEY FK_2CC1FBD4B333DC5B');
        $this->addSql('DROP TABLE utilisateur_hackaton_favoris');
    }
}
