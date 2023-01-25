<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230125143733 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE opportunity_product (opportunity_id INTEGER NOT NULL, product_id INTEGER NOT NULL, PRIMARY KEY(opportunity_id, product_id), CONSTRAINT FK_99D690919A34590F FOREIGN KEY (opportunity_id) REFERENCES opportunity (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_99D690914584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_99D690919A34590F ON opportunity_product (opportunity_id)');
        $this->addSql('CREATE INDEX IDX_99D690914584665A ON opportunity_product (product_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__opportunity AS SELECT id, topic, date, status FROM opportunity');
        $this->addSql('DROP TABLE opportunity');
        $this->addSql('CREATE TABLE opportunity (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, contact_id INTEGER NOT NULL, topic VARCHAR(255) NOT NULL, date DATETIME NOT NULL, status TEXT NOT NULL, CONSTRAINT FK_8389C3D7E7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO opportunity (id, topic, date, status) SELECT id, topic, date, status FROM __temp__opportunity');
        $this->addSql('DROP TABLE __temp__opportunity');
        $this->addSql('CREATE INDEX IDX_8389C3D7E7A1254A ON opportunity (contact_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE opportunity_product');
        $this->addSql('CREATE TEMPORARY TABLE __temp__opportunity AS SELECT id, topic, date, status FROM opportunity');
        $this->addSql('DROP TABLE opportunity');
        $this->addSql('CREATE TABLE opportunity (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, topic VARCHAR(255) NOT NULL, date DATETIME NOT NULL, status CLOB NOT NULL)');
        $this->addSql('INSERT INTO opportunity (id, topic, date, status) SELECT id, topic, date, status FROM __temp__opportunity');
        $this->addSql('DROP TABLE __temp__opportunity');
    }
}
