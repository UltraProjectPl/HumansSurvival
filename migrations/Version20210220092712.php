<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210220092712 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE generation (id INT AUTO_INCREMENT NOT NULL, generation INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE human ADD generation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE human ADD CONSTRAINT FK_A562D5F5553A6EC4 FOREIGN KEY (generation_id) REFERENCES generation (id)');
        $this->addSql('CREATE INDEX IDX_A562D5F5553A6EC4 ON human (generation_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE human DROP FOREIGN KEY FK_A562D5F5553A6EC4');
        $this->addSql('DROP TABLE generation');
        $this->addSql('DROP INDEX IDX_A562D5F5553A6EC4 ON human');
        $this->addSql('ALTER TABLE human DROP generation_id');
    }
}
