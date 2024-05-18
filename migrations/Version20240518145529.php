<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240518145529 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD nombre VARCHAR(50) NOT NULL, ADD apellidos VARCHAR(100) NOT NULL, ADD eliminado TINYINT(1) NOT NULL, ADD is_active TINYINT(1) NOT NULL, ADD creado_en DATETIME DEFAULT NULL, ADD actualizado_en DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `user` DROP nombre, DROP apellidos, DROP eliminado, DROP is_active, DROP creado_en, DROP actualizado_en');
    }
}