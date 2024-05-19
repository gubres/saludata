<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240519113138 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE historial_familiar (id INT AUTO_INCREMENT NOT NULL, historial_clinico_id INT NOT NULL, padre_vivo TINYINT(1) NOT NULL, madre_vivo TINYINT(1) NOT NULL, hermanos INT NOT NULL, hermanos_vivos TINYINT(1) NOT NULL, hijos INT NOT NULL, hijos_vivos TINYINT(1) NOT NULL, edad_fallecimiento_hijos INT DEFAULT NULL, edad_fallecimiento_padre INT DEFAULT NULL, edad_fallecimiento_madre INT DEFAULT NULL, edad_fallecimiento_hermanos INT DEFAULT NULL, causa_muerte_padre LONGTEXT DEFAULT NULL, causa_muerte_madre LONGTEXT DEFAULT NULL, causa_muerte_hermanos LONGTEXT DEFAULT NULL, diabetes TINYINT(1) NOT NULL, enfermedad_cardiaca TINYINT(1) NOT NULL, hipertension TINYINT(1) NOT NULL, enfermedad_metabolica TINYINT(1) NOT NULL, cancer TINYINT(1) NOT NULL, tipo_cancer LONGTEXT DEFAULT NULL, enfermedad_renal_cronica TINYINT(1) NOT NULL, otra_enfermedad_cronica LONGTEXT DEFAULT NULL, creado_en DATETIME NOT NULL, actualizado_en DATETIME DEFAULT NULL, creado_por INT NOT NULL, actualizado_por INT DEFAULT NULL, UNIQUE INDEX UNIQ_523A50F98D90099F (historial_clinico_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE historial_familiar ADD CONSTRAINT FK_523A50F98D90099F FOREIGN KEY (historial_clinico_id) REFERENCES historial_clinico (id)');
        $this->addSql('ALTER TABLE historial_clinico CHANGE paciente_id paciente_id INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE historial_familiar DROP FOREIGN KEY FK_523A50F98D90099F');
        $this->addSql('DROP TABLE historial_familiar');
        $this->addSql('ALTER TABLE historial_clinico CHANGE paciente_id paciente_id INT DEFAULT NULL');
    }
}
