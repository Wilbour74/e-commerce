<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230826154704 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE moyen_de_paiement DROP FOREIGN KEY moyen_de_paiement_ibfk_1');
        $this->addSql('DROP TABLE moyen_de_paiement');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY article_ibfk_1');
        $this->addSql('DROP INDEX id_categorie ON article');
        $this->addSql('ALTER TABLE article ADD poids DOUBLE PRECISION NOT NULL, DROP id_categorie, DROP Rabais_Pct, DROP date_add');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY client_ibfk_1');
        $this->addSql('DROP INDEX id_pays ON client');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY orders_ibfk_1');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY orders_ibfk_2');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY orders_ibfk_3');
        $this->addSql('DROP INDEX id_panier ON orders');
        $this->addSql('DROP INDEX id_pays ON orders');
        $this->addSql('DROP INDEX id_client ON orders');
        $this->addSql('ALTER TABLE orders DROP ville, DROP is_expedited, DROP commande_id, CHANGE id_pays id_pays INT NOT NULL');
        $this->addSql('ALTER TABLE panier DROP FOREIGN KEY panier_ibfk_1');
        $this->addSql('DROP INDEX id_client ON panier');
        $this->addSql('ALTER TABLE panier CHANGE id_client id_client INT NOT NULL');
        $this->addSql('ALTER TABLE panier_article DROP FOREIGN KEY panier_article_ibfk_1');
        $this->addSql('ALTER TABLE panier_article DROP FOREIGN KEY panier_article_ibfk_2');
        $this->addSql('DROP INDEX id_panier ON panier_article');
        $this->addSql('DROP INDEX id_article ON panier_article');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE moyen_de_paiement (client_id INT DEFAULT NULL, ID INT AUTO_INCREMENT NOT NULL, NOM VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, TYPE VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, NumeroCarte VARCHAR(16) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, INDEX client_id (client_id), PRIMARY KEY(ID)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE moyen_de_paiement ADD CONSTRAINT moyen_de_paiement_ibfk_1 FOREIGN KEY (client_id) REFERENCES client (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE article ADD id_categorie INT NOT NULL, ADD Rabais_Pct INT DEFAULT 0, ADD date_add DATE DEFAULT NULL, DROP poids');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT article_ibfk_1 FOREIGN KEY (id_categorie) REFERENCES categorie (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('CREATE INDEX id_categorie ON article (id_categorie)');
        $this->addSql('ALTER TABLE panier_article ADD CONSTRAINT panier_article_ibfk_1 FOREIGN KEY (id_article) REFERENCES article (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE panier_article ADD CONSTRAINT panier_article_ibfk_2 FOREIGN KEY (id_panier) REFERENCES panier (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('CREATE INDEX id_panier ON panier_article (id_panier)');
        $this->addSql('CREATE INDEX id_article ON panier_article (id_article)');
        $this->addSql('ALTER TABLE panier CHANGE id_client id_client INT DEFAULT NULL');
        $this->addSql('ALTER TABLE panier ADD CONSTRAINT panier_ibfk_1 FOREIGN KEY (id_client) REFERENCES client (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('CREATE INDEX id_client ON panier (id_client)');
        $this->addSql('ALTER TABLE orders ADD ville VARCHAR(500) NOT NULL, ADD is_expedited TINYINT(1) DEFAULT NULL, ADD commande_id VARCHAR(500) DEFAULT NULL, CHANGE id_pays id_pays INT DEFAULT NULL');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT orders_ibfk_1 FOREIGN KEY (id_client) REFERENCES client (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT orders_ibfk_2 FOREIGN KEY (id_panier) REFERENCES panier (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT orders_ibfk_3 FOREIGN KEY (id_pays) REFERENCES pays (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX id_panier ON orders (id_panier)');
        $this->addSql('CREATE INDEX id_pays ON orders (id_pays)');
        $this->addSql('CREATE INDEX id_client ON orders (id_client)');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT client_ibfk_1 FOREIGN KEY (id_pays) REFERENCES pays (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('CREATE INDEX id_pays ON client (id_pays)');
    }
}
