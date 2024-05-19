<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240519152422 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE paciente CHANGE ciudad ciudad VARCHAR(50) DEFAULT NULL, CHANGE comunidad_autonoma comunidad_autonoma VARCHAR(50) DEFAULT NULL, CHANGE pais pais VARCHAR(50) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE paciente CHANGE ciudad ciudad VARCHAR(50) NOT NULL, CHANGE comunidad_autonoma comunidad_autonoma VARCHAR(50) NOT NULL, CHANGE pais pais VARCHAR(50) NOT NULL');
    }
}
