<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230816165309 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE pays (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, categorie VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, id_pays INT NOT NULL, roles JSON NOT NULL, PRIMARY KEY(id), FOREIGN KEY(id_pays) REFERENCES pays(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(255) NOT NULL, photo VARCHAR(255) DEFAULT NULL, photo_url VARCHAR(255) DEFAULT NULL, caracteristiques VARCHAR(255) DEFAULT NULL, prix DOUBLE PRECISION NOT NULL, stock INT NOT NULL, id_categorie INT NOT NULL, consultation INT NOT NULL, PRIMARY KEY(id), FOREIGN KEY(id_categorie) REFERENCES categorie(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        $this->addSql('CREATE TABLE panier (id INT AUTO_INCREMENT NOT NULL, id_client INT NOT NULL, prix DOUBLE PRECISION NOT NULL, PRIMARY KEY(id), FOREIGN KEY(id_client) REFERENCES client(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        $this->addSql('CREATE TABLE panier_article (id INT AUTO_INCREMENT NOT NULL, id_article INT DEFAULT NULL, id_panier INT DEFAULT NULL, PRIMARY KEY(id), FOREIGN KEY(id_article) REFERENCES article(id), FOREIGN KEY(id_panier) REFERENCES panier(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        $this->addSql('CREATE TABLE orders (id INT AUTO_INCREMENT NOT NULL, id_client INT NOT NULL, id_panier INT NOT NULL, date DATETIME NOT NULL, PRIMARY KEY(id), FOREIGN KEY(id_client) REFERENCES client(id), FOREIGN KEY(id_panier) REFERENCES panier(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('DROP TABLE orders');
        $this->addSql('DROP TABLE panier_article');
        $this->addSql('DROP TABLE panier');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE pays');
    }
}
