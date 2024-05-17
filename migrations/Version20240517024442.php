<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240517024442 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE rate_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE currency (id VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE rate (id INT NOT NULL, currency_id VARCHAR(255) DEFAULT NULL, base_currency_id VARCHAR(255) DEFAULT NULL, value VARCHAR(255) NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_DFEC3F3938248176 ON rate (currency_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_DFEC3F393101778E ON rate (base_currency_id)');
        $this->addSql('COMMENT ON COLUMN rate.date IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE rate ADD CONSTRAINT FK_DFEC3F3938248176 FOREIGN KEY (currency_id) REFERENCES currency (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE rate ADD CONSTRAINT FK_DFEC3F393101778E FOREIGN KEY (base_currency_id) REFERENCES currency (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE rate_id_seq CASCADE');
        $this->addSql('ALTER TABLE rate DROP CONSTRAINT FK_DFEC3F3938248176');
        $this->addSql('ALTER TABLE rate DROP CONSTRAINT FK_DFEC3F393101778E');
        $this->addSql('DROP TABLE currency');
        $this->addSql('DROP TABLE rate');
    }
}
