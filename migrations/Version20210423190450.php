<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210423190450 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE task_column ADD swimlane_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE task_column ADD CONSTRAINT FK_46FA03AD761B6B99 FOREIGN KEY (swimlane_id) REFERENCES task_swimlane (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_46FA03AD761B6B99 ON task_column (swimlane_id)');
    }

    public function down(Schema $schema) : void {}
}
