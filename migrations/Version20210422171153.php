<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210422171153 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE task_swimlane DROP "position"');

        $this->addSql("INSERT INTO public.task_swimlane (id, name) VALUES (1, 'Головна дошка')");

        $this->addSql("INSERT INTO public.task_priority (id, name, color) VALUES (1, 'Низький', '#409600')");
        $this->addSql("INSERT INTO public.task_priority (id, name, color) VALUES (2, 'Нормальний', '#FED74A')");
        $this->addSql("INSERT INTO public.task_priority (id, name, color) VALUES (3, 'Високий', '#FF7123')");
        $this->addSql("INSERT INTO public.task_priority (id, name, color) VALUES (4, 'Критичний', '#DC0083')");

        $this->addSql("INSERT INTO public.task_column (id, name, position, swimlane_id) VALUES (1, 'Зробити', 0, 1)");
        $this->addSql("INSERT INTO public.task_column (id, name, position, swimlane_id) VALUES (2, 'В процесі', 1, 1)");
        $this->addSql("INSERT INTO public.task_column (id, name, position, swimlane_id) VALUES (3, 'Тестування', 2, 1)");
        $this->addSql("INSERT INTO public.task_column (id, name, position, swimlane_id) VALUES (4, 'Готово', 3, 1)");
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE task_swimlane ADD "position" INT NOT NULL');
    }
}
