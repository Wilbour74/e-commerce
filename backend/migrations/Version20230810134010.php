<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230810134010 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE panier_article DROP FOREIGN KEY panier_article_ibfk_1');
        $this->addSql('ALTER TABLE panier_article DROP FOREIGN KEY panier_article_ibfk_2');
        $this->addSql('DROP TABLE panier_article');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY article_ibfk_1');
        $this->addSql('DROP INDEX id_categorie ON article');
        $this->addSql('ALTER TABLE article CHANGE id_categorie id_categorie INT NOT NULL, CHANGE caracteristiques caracteristiques VARCHAR(255) DEFAULT NULL, CHANGE photo_url photo_url VARCHAR(255) DEFAULT NULL, CHANGE consultation consultation INT NOT NULL');
        $this->addSql('ALTER TABLE categorie CHANGE categorie categorie VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY client_ibfk_1');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_client_panier');
        $this->addSql('DROP INDEX FK_client_panier ON client');
        $this->addSql('DROP INDEX id_pays ON client');
        $this->addSql('ALTER TABLE client DROP id_panier, CHANGE id_pays id_pays INT NOT NULL, CHANGE ville ville VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY orders_ibfk_1');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY orders_ibfk_2');
        $this->addSql('DROP INDEX id_panier ON orders');
        $this->addSql('DROP INDEX id_client ON orders');
        $this->addSql('ALTER TABLE panier DROP FOREIGN KEY panier_ibfk_1');
        $this->addSql('ALTER TABLE panier DROP FOREIGN KEY panier_ibfk_2');
        $this->addSql('DROP INDEX id_article ON panier');
        $this->addSql('DROP INDEX id_client ON panier');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE panier_article (id_panier INT NOT NULL, id_article INT NOT NULL, INDEX id_article (id_article), INDEX IDX_F880CAE72FBB81F (id_panier), PRIMARY KEY(id_panier, id_article)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE panier_article ADD CONSTRAINT panier_article_ibfk_1 FOREIGN KEY (id_panier) REFERENCES panier (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE panier_article ADD CONSTRAINT panier_article_ibfk_2 FOREIGN KEY (id_article) REFERENCES article (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article CHANGE photo_url photo_url VARCHAR(255) NOT NULL, CHANGE caracteristiques caracteristiques VARCHAR(14000) DEFAULT NULL, CHANGE id_categorie id_categorie INT DEFAULT 0 NOT NULL, CHANGE consultation consultation INT DEFAULT 0');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT article_ibfk_1 FOREIGN KEY (id_categorie) REFERENCES categorie (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('CREATE INDEX id_categorie ON article (id_categorie)');
        $this->addSql('ALTER TABLE panier ADD CONSTRAINT panier_ibfk_1 FOREIGN KEY (id_client) REFERENCES client (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE panier ADD CONSTRAINT panier_ibfk_2 FOREIGN KEY (id_article) REFERENCES article (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('CREATE INDEX id_article ON panier (id_article)');
        $this->addSql('CREATE INDEX id_client ON panier (id_client)');
        $this->addSql('ALTER TABLE categorie CHANGE categorie categorie VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT orders_ibfk_1 FOREIGN KEY (id_client) REFERENCES client (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT orders_ibfk_2 FOREIGN KEY (id_panier) REFERENCES panier (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('CREATE INDEX id_panier ON orders (id_panier)');
        $this->addSql('CREATE INDEX id_client ON orders (id_client)');
        $this->addSql('ALTER TABLE client ADD id_panier INT DEFAULT NULL, CHANGE ville ville VARCHAR(255) DEFAULT NULL, CHANGE id_pays id_pays INT DEFAULT NULL');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT client_ibfk_1 FOREIGN KEY (id_pays) REFERENCES pays (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_client_panier FOREIGN KEY (id_panier) REFERENCES panier (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('CREATE INDEX FK_client_panier ON client (id_panier)');
        $this->addSql('CREATE INDEX id_pays ON client (id_pays)');
    }
}
