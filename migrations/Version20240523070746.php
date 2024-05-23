<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240523070746 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cita (id INT AUTO_INCREMENT NOT NULL, paciente_id INT NOT NULL, creado_por_id INT NOT NULL, fecha_cita DATETIME NOT NULL, fecha_creacion DATETIME NOT NULL, fecha_edicion DATETIME DEFAULT NULL, eliminado TINYINT(1) NOT NULL, INDEX IDX_3E379A627310DAD4 (paciente_id), INDEX IDX_3E379A62FE35D8C4 (creado_por_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cita ADD CONSTRAINT FK_3E379A627310DAD4 FOREIGN KEY (paciente_id) REFERENCES paciente (id)');
        $this->addSql('ALTER TABLE cita ADD CONSTRAINT FK_3E379A62FE35D8C4 FOREIGN KEY (creado_por_id) REFERENCES `user` (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C6CBA95E7F8F253B ON paciente (dni)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cita DROP FOREIGN KEY FK_3E379A627310DAD4');
        $this->addSql('ALTER TABLE cita DROP FOREIGN KEY FK_3E379A62FE35D8C4');
        $this->addSql('DROP TABLE cita');
        $this->addSql('DROP INDEX UNIQ_C6CBA95E7F8F253B ON paciente');
    }
}
