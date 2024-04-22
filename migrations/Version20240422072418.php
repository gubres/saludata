<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240422072418 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE paciente (id INT AUTO_INCREMENT NOT NULL, sanitario_asignado_id INT NOT NULL, updated_by_id INT NOT NULL, nombre VARCHAR(50) NOT NULL, apellido VARCHAR(50) NOT NULL, dni VARCHAR(9) NOT NULL, fecha_nacimiento DATE NOT NULL, profesion VARCHAR(50) NOT NULL, direccion LONGTEXT NOT NULL, genero VARCHAR(50) NOT NULL, estado_civil VARCHAR(50) NOT NULL, telefono INT NOT NULL, email VARCHAR(255) NOT NULL, eliminado TINYINT(1) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL, INDEX IDX_C6CBA95EFB39A68A (sanitario_asignado_id), INDEX IDX_C6CBA95E896DBBDE (updated_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE paciente ADD CONSTRAINT FK_C6CBA95EFB39A68A FOREIGN KEY (sanitario_asignado_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE paciente ADD CONSTRAINT FK_C6CBA95E896DBBDE FOREIGN KEY (updated_by_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE paciente DROP FOREIGN KEY FK_C6CBA95EFB39A68A');
        $this->addSql('ALTER TABLE paciente DROP FOREIGN KEY FK_C6CBA95E896DBBDE');
        $this->addSql('DROP TABLE paciente');
    }
}
