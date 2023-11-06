<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221214181239 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE voiture_loc (id INT AUTO_INCREMENT NOT NULL, marque_id INT NOT NULL, type_voiture_id INT NOT NULL, modele VARCHAR(255) NOT NULL, prix DOUBLE PRECISION NOT NULL, photo VARCHAR(255) NOT NULL, date_debut_dispo DATE NOT NULL, date_fin_dispo DATE NOT NULL, description VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, INDEX IDX_C8331F754827B9B2 (marque_id), INDEX IDX_C8331F751C827E9F (type_voiture_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE voiture_loc ADD CONSTRAINT FK_C8331F754827B9B2 FOREIGN KEY (marque_id) REFERENCES marque (id)');
        $this->addSql('ALTER TABLE voiture_loc ADD CONSTRAINT FK_C8331F751C827E9F FOREIGN KEY (type_voiture_id) REFERENCES type_voiture (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE voiture_loc DROP FOREIGN KEY FK_C8331F754827B9B2');
        $this->addSql('ALTER TABLE voiture_loc DROP FOREIGN KEY FK_C8331F751C827E9F');
        $this->addSql('DROP TABLE voiture_loc');
    }
}
