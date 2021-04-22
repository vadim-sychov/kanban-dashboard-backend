<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210416183034 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('SELECT setval(\'tag_id_seq\', (SELECT MAX(id) FROM tag))');
        $this->addSql('ALTER TABLE tag ALTER id SET DEFAULT nextval(\'tag_id_seq\')');

        $this->addSql('SELECT setval(\'task_id_seq\', (SELECT MAX(id) FROM task))');
        $this->addSql('ALTER TABLE task ALTER id SET DEFAULT nextval(\'task_id_seq\')');

        $this->addSql('SELECT setval(\'task_column_id_seq\', (SELECT MAX(id) FROM task_column))');
        $this->addSql('ALTER TABLE task_column ALTER id SET DEFAULT nextval(\'task_column_id_seq\')');

        $this->addSql('SELECT setval(\'task_comment_id_seq\', (SELECT MAX(id) FROM task_comment))');
        $this->addSql('ALTER TABLE task_comment ALTER id SET DEFAULT nextval(\'task_comment_id_seq\')');

        $this->addSql('SELECT setval(\'task_priority_id_seq\', (SELECT MAX(id) FROM task_priority))');
        $this->addSql('ALTER TABLE task_priority ALTER id SET DEFAULT nextval(\'task_priority_id_seq\')');

        $this->addSql('SELECT setval(\'task_swimlane_id_seq\', (SELECT MAX(id) FROM task_swimlane))');
        $this->addSql('ALTER TABLE task_swimlane ALTER id SET DEFAULT nextval(\'task_swimlane_id_seq\')');

        $this->addSql('SELECT setval(\'user_id_seq\', (SELECT MAX(id) FROM "user"))');
        $this->addSql('ALTER TABLE "user" ALTER id SET DEFAULT nextval(\'user_id_seq\')');

        $this->addSql('INSERT INTO "user" (id, email, password, roles, api_token) VALUES (DEFAULT, \'taskmanager-admin@gmail.com\', \'$2y$13$etCzn3TiqR8cNWzmti/YLuKuwizPFQqpIDdrHwUUX4IS1kimjYWGS\', \'["ROLE_ADMIN", "ROLE_USER"]\', null)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE task_priority ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE task_column ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE task_swimlane ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE "user" ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE tag ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE task ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE task_comment ALTER id DROP DEFAULT');
    }
}
