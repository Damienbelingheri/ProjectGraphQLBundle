<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210115145943 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE rocket (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team (id INT AUTO_INCREMENT NOT NULL, rocket_id INT DEFAULT NULL, captain_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, photo VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_C4E0A61FC57537DF (rocket_id), UNIQUE INDEX UNIQ_C4E0A61F3346729B (captain_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61FC57537DF FOREIGN KEY (rocket_id) REFERENCES rocket (id)');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61F3346729B FOREIGN KEY (captain_id) REFERENCES astronaut (id)');
        $this->addSql('ALTER TABLE astronaut ADD team_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE astronaut ADD CONSTRAINT FK_5DADB6E5296CD8AE FOREIGN KEY (team_id) REFERENCES team (id)');
        $this->addSql('CREATE INDEX IDX_5DADB6E5296CD8AE ON astronaut (team_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE team DROP FOREIGN KEY FK_C4E0A61FC57537DF');
        $this->addSql('ALTER TABLE astronaut DROP FOREIGN KEY FK_5DADB6E5296CD8AE');
        $this->addSql('DROP TABLE rocket');
        $this->addSql('DROP TABLE team');
        $this->addSql('DROP INDEX IDX_5DADB6E5296CD8AE ON astronaut');
        $this->addSql('ALTER TABLE astronaut DROP team_id');
    }
}
