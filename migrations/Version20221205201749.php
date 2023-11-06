<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221205201749 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE demande_location CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE demande_location ADD CONSTRAINT FK_18C7C009BF396750 FOREIGN KEY (id) REFERENCES demandes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE demande_vente CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE demande_vente ADD CONSTRAINT FK_7E54A965BF396750 FOREIGN KEY (id) REFERENCES demandes (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE demande_location DROP FOREIGN KEY FK_18C7C009BF396750');
        $this->addSql('ALTER TABLE demande_location CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE demande_vente DROP FOREIGN KEY FK_7E54A965BF396750');
        $this->addSql('ALTER TABLE demande_vente CHANGE id id INT AUTO_INCREMENT NOT NULL');
    }
}
