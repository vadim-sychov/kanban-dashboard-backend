<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210416175655 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE task DROP CONSTRAINT fk_527edb2580838c8a');
        $this->addSql('ALTER TABLE task DROP CONSTRAINT fk_527edb25420329b7');
        $this->addSql('ALTER TABLE task DROP CONSTRAINT fk_527edb25761b6b99');
        $this->addSql('ALTER TABLE task DROP CONSTRAINT fk_527edb258fddab70');
        $this->addSql('ALTER TABLE task DROP CONSTRAINT fk_527edb25cb58a033');
        $this->addSql('DROP INDEX idx_527edb25761b6b99');
        $this->addSql('DROP INDEX idx_527edb25420329b7');
        $this->addSql('DROP INDEX idx_527edb258fddab70');
        $this->addSql('DROP INDEX idx_527edb2580838c8a');
        $this->addSql('DROP INDEX idx_527edb25cb58a033');
        $this->addSql('ALTER TABLE task ADD priority_id VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE task ADD column_id VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE task ADD swimlane_id VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE task ADD owner_id VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE task ADD executor_id VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE task DROP priority_id_id');
        $this->addSql('ALTER TABLE task DROP column_id_id');
        $this->addSql('ALTER TABLE task DROP swimlane_id_id');
        $this->addSql('ALTER TABLE task DROP owner_id_id');
        $this->addSql('ALTER TABLE task DROP executor_id_id');
        $this->addSql('ALTER TABLE task_comment DROP CONSTRAINT fk_8b957886b8e08577');
        $this->addSql('DROP INDEX idx_8b957886b8e08577');
        $this->addSql('ALTER TABLE task_comment ADD task_id VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE task_comment DROP task_id_id');
        $this->addSql('ALTER TABLE "user" ALTER api_token DROP NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6497BA2F5EB ON "user" (api_token)');
        $this->addSql('ALTER TABLE task_comment DROP CONSTRAINT fk_8b9578869d86650f');
        $this->addSql('DROP INDEX idx_8b9578869d86650f');
        $this->addSql('ALTER TABLE task_comment ADD user_id VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE task_comment DROP user_id_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE task ADD priority_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE task ADD column_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE task ADD swimlane_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE task ADD owner_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE task ADD executor_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE task DROP priority_id');
        $this->addSql('ALTER TABLE task DROP column_id');
        $this->addSql('ALTER TABLE task DROP swimlane_id');
        $this->addSql('ALTER TABLE task DROP owner_id');
        $this->addSql('ALTER TABLE task DROP executor_id');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT fk_527edb2580838c8a FOREIGN KEY (priority_id_id) REFERENCES task_priority (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT fk_527edb25420329b7 FOREIGN KEY (column_id_id) REFERENCES task_column (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT fk_527edb25761b6b99 FOREIGN KEY (swimlane_id_id) REFERENCES task_swimlane (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT fk_527edb258fddab70 FOREIGN KEY (owner_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT fk_527edb25cb58a033 FOREIGN KEY (executor_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_527edb25761b6b99 ON task (swimlane_id_id)');
        $this->addSql('CREATE INDEX idx_527edb25420329b7 ON task (column_id_id)');
        $this->addSql('CREATE INDEX idx_527edb258fddab70 ON task (owner_id_id)');
        $this->addSql('CREATE INDEX idx_527edb2580838c8a ON task (priority_id_id)');
        $this->addSql('CREATE INDEX idx_527edb25cb58a033 ON task (executor_id_id)');
        $this->addSql('DROP INDEX UNIQ_8D93D6497BA2F5EB');
        $this->addSql('ALTER TABLE "user" ALTER api_token SET NOT NULL');
        $this->addSql('ALTER TABLE task_comment ADD task_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE task_comment DROP task_id');
        $this->addSql('ALTER TABLE task_comment ADD CONSTRAINT fk_8b957886b8e08577 FOREIGN KEY (task_id_id) REFERENCES task (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_8b957886b8e08577 ON task_comment (task_id_id)');
        $this->addSql('ALTER TABLE task_comment ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE task_comment DROP user_id_id');
        $this->addSql('ALTER TABLE task_comment ADD CONSTRAINT fk_8b9578869d86650f FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_8b9578869d86650f ON task_comment (user_id)');
    }
}
