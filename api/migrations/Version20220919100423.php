<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220919100423 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE document DROP CONSTRAINT fk_d8698a76b333dc5b');
        $this->addSql('ALTER TABLE event DROP CONSTRAINT fk_3bae0aa7b333dc5b');
        $this->addSql('DROP SEQUENCE hackaton_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE name_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE hackathon_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE hackathon (id INT NOT NULL, name VARCHAR(255) NOT NULL, client_name VARCHAR(255) NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('DROP TABLE name');
        $this->addSql('DROP TABLE hackaton');
        $this->addSql('DROP INDEX idx_d8698a76b333dc5b');
        $this->addSql('ALTER TABLE document ADD groupe_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE document ADD file TEXT NOT NULL');
        $this->addSql('ALTER TABLE document DROP hackaton_id');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A767A45358C FOREIGN KEY (groupe_id) REFERENCES groupe (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_D8698A767A45358C ON document (groupe_id)');
        $this->addSql('DROP INDEX idx_3bae0aa7b333dc5b');
        $this->addSql('ALTER TABLE event RENAME COLUMN hackaton_id TO hackathon_id');
        $this->addSql('ALTER TABLE event RENAME COLUMN start_date TO star_date');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7996D90CF FOREIGN KEY (hackathon_id) REFERENCES hackathon (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_3BAE0AA7996D90CF ON event (hackathon_id)');
        $this->addSql('ALTER TABLE groupe ADD hackathon_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE groupe ADD CONSTRAINT FK_4B98C21996D90CF FOREIGN KEY (hackathon_id) REFERENCES hackathon (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_4B98C21996D90CF ON groupe (hackathon_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE event DROP CONSTRAINT FK_3BAE0AA7996D90CF');
        $this->addSql('ALTER TABLE groupe DROP CONSTRAINT FK_4B98C21996D90CF');
        $this->addSql('DROP SEQUENCE hackathon_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE hackaton_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE name_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE name (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE hackaton (id INT NOT NULL, groupe_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, customer VARCHAR(255) NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_b36273437a45358c ON hackaton (groupe_id)');
        $this->addSql('ALTER TABLE hackaton ADD CONSTRAINT fk_b36273437a45358c FOREIGN KEY (groupe_id) REFERENCES groupe (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE hackathon');
        $this->addSql('ALTER TABLE document DROP CONSTRAINT FK_D8698A767A45358C');
        $this->addSql('DROP INDEX IDX_D8698A767A45358C');
        $this->addSql('ALTER TABLE document ADD hackaton_id INT NOT NULL');
        $this->addSql('ALTER TABLE document DROP groupe_id');
        $this->addSql('ALTER TABLE document DROP file');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT fk_d8698a76b333dc5b FOREIGN KEY (hackaton_id) REFERENCES hackaton (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_d8698a76b333dc5b ON document (hackaton_id)');
        $this->addSql('DROP INDEX IDX_3BAE0AA7996D90CF');
        $this->addSql('ALTER TABLE event RENAME COLUMN hackathon_id TO hackaton_id');
        $this->addSql('ALTER TABLE event RENAME COLUMN star_date TO start_date');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT fk_3bae0aa7b333dc5b FOREIGN KEY (hackaton_id) REFERENCES hackaton (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_3bae0aa7b333dc5b ON event (hackaton_id)');
        $this->addSql('DROP INDEX IDX_4B98C21996D90CF');
        $this->addSql('ALTER TABLE groupe DROP hackathon_id');
    }
}
