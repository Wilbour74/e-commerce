<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230802093613 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article ADD photo_url VARCHAR(255) DEFAULT NULL, ADD categorie VARCHAR(255) NOT NULL, DROP id_categorie, CHANGE caracteristiques caracteristiques VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE categorie CHANGE categorie categorie VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article ADD id_categorie INT NOT NULL, DROP photo_url, DROP categorie, CHANGE caracteristiques caracteristiques VARCHAR(15555) DEFAULT NULL');
        $this->addSql('ALTER TABLE categorie CHANGE categorie categorie VARCHAR(255) DEFAULT NULL');
    }
}
