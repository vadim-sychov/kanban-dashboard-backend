<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210422163333 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE task_tag DROP CONSTRAINT fk_6c0b4f04bad26311');
        $this->addSql('DROP SEQUENCE tag_id_seq CASCADE');
        $this->addSql('DROP TABLE task_tag');
        $this->addSql('DROP TABLE tag');
        $this->addSql('ALTER TABLE task_comment DROP CONSTRAINT fk_8b9578869d86650f');
        $this->addSql('DROP INDEX idx_8b9578869d86650f');
        $this->addSql('ALTER TABLE task_comment ALTER user_id TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE task_comment ALTER user_id DROP DEFAULT');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE tag_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE task_tag (task_id INT NOT NULL, tag_id INT NOT NULL, PRIMARY KEY(task_id, tag_id))');
        $this->addSql('CREATE INDEX idx_6c0b4f04bad26311 ON task_tag (tag_id)');
        $this->addSql('CREATE INDEX idx_6c0b4f048db60186 ON task_tag (task_id)');
        $this->addSql('CREATE TABLE tag (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, color VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE task_tag ADD CONSTRAINT fk_6c0b4f048db60186 FOREIGN KEY (task_id) REFERENCES task (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE task_tag ADD CONSTRAINT fk_6c0b4f04bad26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE task_comment ALTER user_id TYPE INT');
        $this->addSql('ALTER TABLE task_comment ALTER user_id DROP DEFAULT');
        $this->addSql('ALTER TABLE task_comment ADD CONSTRAINT fk_8b9578869d86650f FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_8b9578869d86650f ON task_comment (user_id)');
    }
}
