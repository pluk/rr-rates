<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240519154943 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE rates_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE currency (id VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX c_code_index ON currency (code)');
        $this->addSql('CREATE TABLE rates (id INT NOT NULL, currency_id VARCHAR(255) DEFAULT NULL, value VARCHAR(255) NOT NULL, date DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_44D4AB3C38248176 ON rates (currency_id)');
        $this->addSql('CREATE INDEX r_index_date ON rates (date)');
        $this->addSql('CREATE UNIQUE INDEX daily_rate ON rates (currency_id, date)');
        $this->addSql('ALTER TABLE rates ADD CONSTRAINT FK_44D4AB3C38248176 FOREIGN KEY (currency_id) REFERENCES currency (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('INSERT INTO currency (id, code, name) values (\'R0001\', \'RUR\', \'Российский рубль\')');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE rates_id_seq CASCADE');
        $this->addSql('ALTER TABLE rates DROP CONSTRAINT FK_44D4AB3C38248176');
        $this->addSql('DROP TABLE currency');
        $this->addSql('DROP TABLE rates');
    }
}
