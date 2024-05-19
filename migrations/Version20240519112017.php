<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240519112017 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE historial_clinico (id INT AUTO_INCREMENT NOT NULL, creado_por_id INT NOT NULL, actualizado_por_id INT NOT NULL, paciente_id INT DEFAULT NULL, creado_en DATE NOT NULL, actualizado_en DATE NOT NULL, UNIQUE INDEX UNIQ_C0B51A81FE35D8C4 (creado_por_id), INDEX IDX_C0B51A81F6167A1C (actualizado_por_id), UNIQUE INDEX UNIQ_C0B51A817310DAD4 (paciente_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE historial_clinico ADD CONSTRAINT FK_C0B51A81FE35D8C4 FOREIGN KEY (creado_por_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE historial_clinico ADD CONSTRAINT FK_C0B51A81F6167A1C FOREIGN KEY (actualizado_por_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE historial_clinico ADD CONSTRAINT FK_C0B51A817310DAD4 FOREIGN KEY (paciente_id) REFERENCES paciente (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE historial_clinico DROP FOREIGN KEY FK_C0B51A81FE35D8C4');
        $this->addSql('ALTER TABLE historial_clinico DROP FOREIGN KEY FK_C0B51A81F6167A1C');
        $this->addSql('ALTER TABLE historial_clinico DROP FOREIGN KEY FK_C0B51A817310DAD4');
        $this->addSql('DROP TABLE historial_clinico');
    }
}
