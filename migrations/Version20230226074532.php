<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
<<<<<<<< HEAD:migrations/Version20230228065319.php
final class Version20230228065319 extends AbstractMigration
========
final class Version20230226074532 extends AbstractMigration
>>>>>>>> 5ef35d9 (add Timer ApiResource):migrations/Version20230226074532.php
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE status (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE task (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, status_id INTEGER DEFAULT NULL, timer_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
<<<<<<<< HEAD:migrations/Version20230228065319.php
        , updated_at DATETIME DEFAULT NULL, CONSTRAINT FK_527EDB256BF700BD FOREIGN KEY (status_id) REFERENCES status (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_527EDB25EE98D9B9 FOREIGN KEY (timer_id) REFERENCES timer (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_527EDB256BF700BD ON task (status_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_527EDB25EE98D9B9 ON task (timer_id)');
        $this->addSql('CREATE TABLE timer (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, started_at DATETIME NOT NULL, ended_at DATETIME DEFAULT NULL)');
========
        , updated_at DATETIME NOT NULL, CONSTRAINT FK_527EDB256BF700BD FOREIGN KEY (status_id) REFERENCES status (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_527EDB25EE98D9B9 FOREIGN KEY (timer_id) REFERENCES status (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_527EDB256BF700BD ON task (status_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_527EDB25EE98D9B9 ON task (timer_id)');
        $this->addSql('CREATE TABLE timer (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, started_at DATETIME NOT NULL, ended_at DATETIME NOT NULL)');
>>>>>>>> 5ef35d9 (add Timer ApiResource):migrations/Version20230226074532.php
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE status');
        $this->addSql('DROP TABLE task');
        $this->addSql('DROP TABLE timer');
    }
}
