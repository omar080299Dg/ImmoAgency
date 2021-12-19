<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211219140103 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bien (id INT AUTO_INCREMENT NOT NULL, filename VARCHAR(100) NOT NULL, title VARCHAR(100) NOT NULL, prix INT NOT NULL, description LONGTEXT DEFAULT NULL, surface INT NOT NULL, nbre_piece INT NOT NULL, nbre_chambre INT DEFAULT NULL, ville VARCHAR(100) DEFAULT NULL, addresse VARCHAR(255) NOT NULL, type VARCHAR(100) NOT NULL, objectif VARCHAR(100) NOT NULL, disponibilite TINYINT(1) NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bien_option (bien_id INT NOT NULL, option_id INT NOT NULL, INDEX IDX_A381FF80BD95B80F (bien_id), INDEX IDX_A381FF80A7C41D6F (option_id), PRIMARY KEY(bien_id, option_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `option` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bien_option ADD CONSTRAINT FK_A381FF80BD95B80F FOREIGN KEY (bien_id) REFERENCES bien (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE bien_option ADD CONSTRAINT FK_A381FF80A7C41D6F FOREIGN KEY (option_id) REFERENCES `option` (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bien_option DROP FOREIGN KEY FK_A381FF80BD95B80F');
        $this->addSql('ALTER TABLE bien_option DROP FOREIGN KEY FK_A381FF80A7C41D6F');
        $this->addSql('DROP TABLE bien');
        $this->addSql('DROP TABLE bien_option');
        $this->addSql('DROP TABLE `option`');
        $this->addSql('DROP TABLE user');
    }
}
