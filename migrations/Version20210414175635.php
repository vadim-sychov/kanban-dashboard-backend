<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210414175635 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE tag_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE task_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE task_column_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE task_comment_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE task_priority_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE task_swimlane_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE tag (id INT NOT NULL, name VARCHAR(255) NOT NULL, color VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE task (id INT NOT NULL, priority_id_id INT DEFAULT NULL, column_id_id INT DEFAULT NULL, swimlane_id_id INT NOT NULL, owner_id_id INT NOT NULL, executor_id_id INT DEFAULT NULL, title VARCHAR(100) NOT NULL, text TEXT DEFAULT NULL, date_created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_527EDB2580838C8A ON task (priority_id_id)');
        $this->addSql('CREATE INDEX IDX_527EDB25420329B7 ON task (column_id_id)');
        $this->addSql('CREATE INDEX IDX_527EDB25761B6B99 ON task (swimlane_id_id)');
        $this->addSql('CREATE INDEX IDX_527EDB258FDDAB70 ON task (owner_id_id)');
        $this->addSql('CREATE INDEX IDX_527EDB25CB58A033 ON task (executor_id_id)');
        $this->addSql('COMMENT ON COLUMN task.date_created IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE task_tag (task_id INT NOT NULL, tag_id INT NOT NULL, PRIMARY KEY(task_id, tag_id))');
        $this->addSql('CREATE INDEX IDX_6C0B4F048DB60186 ON task_tag (task_id)');
        $this->addSql('CREATE INDEX IDX_6C0B4F04BAD26311 ON task_tag (tag_id)');
        $this->addSql('CREATE TABLE task_column (id INT NOT NULL, name VARCHAR(255) NOT NULL, position INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE task_comment (id INT NOT NULL, user_id_id INT NOT NULL, task_id_id INT NOT NULL, text TEXT DEFAULT NULL, date_created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8B9578869D86650F ON task_comment (user_id_id)');
        $this->addSql('CREATE INDEX IDX_8B957886B8E08577 ON task_comment (task_id_id)');
        $this->addSql('COMMENT ON COLUMN task_comment.date_created IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE task_priority (id INT NOT NULL, name VARCHAR(255) NOT NULL, color VARCHAR(100) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE task_swimlane (id INT NOT NULL, name VARCHAR(255) NOT NULL, position INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, roles JSON NOT NULL, api_token VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB2580838C8A FOREIGN KEY (priority_id_id) REFERENCES task_priority (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB25420329B7 FOREIGN KEY (column_id_id) REFERENCES task_column (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB25761B6B99 FOREIGN KEY (swimlane_id_id) REFERENCES task_swimlane (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB258FDDAB70 FOREIGN KEY (owner_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB25CB58A033 FOREIGN KEY (executor_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE task_tag ADD CONSTRAINT FK_6C0B4F048DB60186 FOREIGN KEY (task_id) REFERENCES task (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE task_tag ADD CONSTRAINT FK_6C0B4F04BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE task_comment ADD CONSTRAINT FK_8B9578869D86650F FOREIGN KEY (user_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE task_comment ADD CONSTRAINT FK_8B957886B8E08577 FOREIGN KEY (task_id_id) REFERENCES task (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE task_tag DROP CONSTRAINT FK_6C0B4F04BAD26311');
        $this->addSql('ALTER TABLE task_tag DROP CONSTRAINT FK_6C0B4F048DB60186');
        $this->addSql('ALTER TABLE task_comment DROP CONSTRAINT FK_8B957886B8E08577');
        $this->addSql('ALTER TABLE task DROP CONSTRAINT FK_527EDB25420329B7');
        $this->addSql('ALTER TABLE task DROP CONSTRAINT FK_527EDB2580838C8A');
        $this->addSql('ALTER TABLE task DROP CONSTRAINT FK_527EDB25761B6B99');
        $this->addSql('ALTER TABLE task DROP CONSTRAINT FK_527EDB258FDDAB70');
        $this->addSql('ALTER TABLE task DROP CONSTRAINT FK_527EDB25CB58A033');
        $this->addSql('ALTER TABLE task_comment DROP CONSTRAINT FK_8B9578869D86650F');
        $this->addSql('DROP SEQUENCE tag_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE task_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE task_column_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE task_comment_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE task_priority_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE task_swimlane_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP TABLE task');
        $this->addSql('DROP TABLE task_tag');
        $this->addSql('DROP TABLE task_column');
        $this->addSql('DROP TABLE task_comment');
        $this->addSql('DROP TABLE task_priority');
        $this->addSql('DROP TABLE task_swimlane');
        $this->addSql('DROP TABLE "user"');
    }
}
