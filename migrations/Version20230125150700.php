<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230125150700 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__opportunity AS SELECT id, contact_id, topic, date, status FROM opportunity');
        $this->addSql('DROP TABLE opportunity');
        $this->addSql('CREATE TABLE opportunity (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, contact_id INTEGER NOT NULL, topic VARCHAR(255) NOT NULL, date DATETIME NOT NULL, status TEXT NOT NULL, estimated_value DOUBLE PRECISION DEFAULT NULL, CONSTRAINT FK_8389C3D7E7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO opportunity (id, contact_id, topic, date, status) SELECT id, contact_id, topic, date, status FROM __temp__opportunity');
        $this->addSql('DROP TABLE __temp__opportunity');
        $this->addSql('CREATE INDEX IDX_8389C3D7E7A1254A ON opportunity (contact_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__opportunity AS SELECT id, contact_id, topic, date, status FROM opportunity');
        $this->addSql('DROP TABLE opportunity');
        $this->addSql('CREATE TABLE opportunity (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, contact_id INTEGER NOT NULL, topic VARCHAR(255) NOT NULL, date DATETIME NOT NULL, status CLOB NOT NULL, CONSTRAINT FK_8389C3D7E7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO opportunity (id, contact_id, topic, date, status) SELECT id, contact_id, topic, date, status FROM __temp__opportunity');
        $this->addSql('DROP TABLE __temp__opportunity');
        $this->addSql('CREATE INDEX IDX_8389C3D7E7A1254A ON opportunity (contact_id)');
    }
}
