<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210108123027 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bien (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(100) NOT NULL, prix INT NOT NULL, description LONGTEXT DEFAULT NULL, surface INT NOT NULL, nbre_piece INT NOT NULL, nbre_chambre INT DEFAULT NULL, ville VARCHAR(100) DEFAULT NULL, addresse VARCHAR(255) NOT NULL, type VARCHAR(100) NOT NULL, objectif VARCHAR(100) NOT NULL, disponibilite TINYINT(1) NOT NULL, date_disponibilite DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE bien');
    }
}
