<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20210216145044 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('CREATE TABLE human (id INT AUTO_INCREMENT NOT NULL, father_id INT DEFAULT NULL, mather_id INT DEFAULT NULL, sex VARCHAR(255) NOT NULL, INDEX IDX_A562D5F52055B9A2 (father_id), INDEX IDX_A562D5F5A200277F (mather_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE human ADD CONSTRAINT FK_A562D5F52055B9A2 FOREIGN KEY (father_id) REFERENCES human (id)');
        $this->addSql('ALTER TABLE human ADD CONSTRAINT FK_A562D5F5A200277F FOREIGN KEY (mather_id) REFERENCES human (id)');
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('ALTER TABLE human DROP FOREIGN KEY FK_A562D5F52055B9A2');
        $this->addSql('ALTER TABLE human DROP FOREIGN KEY FK_A562D5F5A200277F');
        $this->addSql('DROP TABLE human');
    }
}
