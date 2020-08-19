<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200817073913 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE parking (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(150) NOT NULL, localisation VARCHAR(200) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parking_space (id INT AUTO_INCREMENT NOT NULL, height DOUBLE PRECISION NOT NULL, width DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE car ADD parking_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69DF17B2DD FOREIGN KEY (parking_id) REFERENCES parking (id)');
        $this->addSql('CREATE INDEX IDX_773DE69DF17B2DD ON car (parking_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE car DROP FOREIGN KEY FK_773DE69DF17B2DD');
        $this->addSql('DROP TABLE parking');
        $this->addSql('DROP TABLE parking_space');
        $this->addSql('DROP INDEX IDX_773DE69DF17B2DD ON car');
        $this->addSql('ALTER TABLE car DROP parking_id');
    }
}
