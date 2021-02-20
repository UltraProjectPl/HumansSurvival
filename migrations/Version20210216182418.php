<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210216182418 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE human DROP FOREIGN KEY FK_A562D5F5A200277F');
        $this->addSql('DROP INDEX IDX_A562D5F5A200277F ON human');
        $this->addSql('ALTER TABLE human CHANGE mather_id mother_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE human ADD CONSTRAINT FK_A562D5F5B78A354D FOREIGN KEY (mother_id) REFERENCES human (id)');
        $this->addSql('CREATE INDEX IDX_A562D5F5B78A354D ON human (mother_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE human DROP FOREIGN KEY FK_A562D5F5B78A354D');
        $this->addSql('DROP INDEX IDX_A562D5F5B78A354D ON human');
        $this->addSql('ALTER TABLE human CHANGE mother_id mather_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE human ADD CONSTRAINT FK_A562D5F5A200277F FOREIGN KEY (mather_id) REFERENCES human (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_A562D5F5A200277F ON human (mather_id)');
    }
}
