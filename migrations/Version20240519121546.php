<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240519121546 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE alergia (id INT AUTO_INCREMENT NOT NULL, creado_por_id INT NOT NULL, historial_clinico_id INT NOT NULL, nombre VARCHAR(50) NOT NULL, causa LONGTEXT NOT NULL, primera_vez DATE NOT NULL, frecuencia LONGTEXT NOT NULL, tratamiento_realizado LONGTEXT NOT NULL, creado_en DATETIME NOT NULL, INDEX IDX_9C6D9BA1FE35D8C4 (creado_por_id), INDEX IDX_9C6D9BA18D90099F (historial_clinico_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE costumbres (id INT AUTO_INCREMENT NOT NULL, creado_por_id INT NOT NULL, actualizado_por_id INT DEFAULT NULL, historial_clinico_id INT NOT NULL, fumante TINYINT(1) NOT NULL, frecuencia_fuma INT DEFAULT NULL, edad_empezo_fumar INT DEFAULT NULL, consumo_alcohol TINYINT(1) NOT NULL, frecuencia_consumo_alcohol INT DEFAULT NULL, edad_empezo_beber INT DEFAULT NULL, otras_drogas TINYINT(1) NOT NULL, tipo_drogas LONGTEXT DEFAULT NULL, frecuencia LONGTEXT DEFAULT NULL, edad_empezo_usar INT DEFAULT NULL, actividad_fisica TINYINT(1) NOT NULL, tipo_actividad_fisica LONGTEXT DEFAULT NULL, duracion_actividad_fisica LONGTEXT DEFAULT NULL, frecuencia_actividad_fisica LONGTEXT DEFAULT NULL, actividad_sexual TINYINT(1) NOT NULL, edad_primera_relacion_sexual INT DEFAULT NULL, frecuencia_actividad_sexual LONGTEXT DEFAULT NULL, uso_preservativo TINYINT(1) NOT NULL, parejas_sexuales_actual INT DEFAULT NULL, higiene_intima TINYINT(1) NOT NULL, metodo_higiene_intima LONGTEXT DEFAULT NULL, creado_en DATETIME NOT NULL, actualizado_en DATETIME DEFAULT NULL, INDEX IDX_4DE9E867FE35D8C4 (creado_por_id), INDEX IDX_4DE9E867F6167A1C (actualizado_por_id), UNIQUE INDEX UNIQ_4DE9E8678D90099F (historial_clinico_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medicamento (id INT AUTO_INCREMENT NOT NULL, creado_por_id INT NOT NULL, historial_clinico_id INT NOT NULL, nombre VARCHAR(50) NOT NULL, posologia VARCHAR(50) NOT NULL, duracion_tratamiento VARCHAR(50) NOT NULL, frecuencia LONGTEXT NOT NULL, aplicacion LONGTEXT NOT NULL, prescripcion_medica TINYINT(1) NOT NULL, creado_en DATETIME NOT NULL, INDEX IDX_C999D684FE35D8C4 (creado_por_id), INDEX IDX_C999D6848D90099F (historial_clinico_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE signos_vitales (id INT AUTO_INCREMENT NOT NULL, creado_por_id INT NOT NULL, historial_clinico_id INT NOT NULL, altura DOUBLE PRECISION NOT NULL, peso DOUBLE PRECISION NOT NULL, masa_corporal DOUBLE PRECISION NOT NULL, temperatura DOUBLE PRECISION NOT NULL, frecuencia_respiratoria INT NOT NULL, sistole DOUBLE PRECISION NOT NULL, diastole DOUBLE PRECISION NOT NULL, frecuencia_cardiaca INT NOT NULL, porcentaje_grasa_corporal DOUBLE PRECISION DEFAULT NULL, masa_corporal_magra DOUBLE PRECISION DEFAULT NULL, saturacion_oxigeno INT NOT NULL, creado_en DATETIME NOT NULL, INDEX IDX_4ABFA61BFE35D8C4 (creado_por_id), INDEX IDX_4ABFA61B8D90099F (historial_clinico_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE alergia ADD CONSTRAINT FK_9C6D9BA1FE35D8C4 FOREIGN KEY (creado_por_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE alergia ADD CONSTRAINT FK_9C6D9BA18D90099F FOREIGN KEY (historial_clinico_id) REFERENCES historial_clinico (id)');
        $this->addSql('ALTER TABLE costumbres ADD CONSTRAINT FK_4DE9E867FE35D8C4 FOREIGN KEY (creado_por_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE costumbres ADD CONSTRAINT FK_4DE9E867F6167A1C FOREIGN KEY (actualizado_por_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE costumbres ADD CONSTRAINT FK_4DE9E8678D90099F FOREIGN KEY (historial_clinico_id) REFERENCES historial_clinico (id)');
        $this->addSql('ALTER TABLE medicamento ADD CONSTRAINT FK_C999D684FE35D8C4 FOREIGN KEY (creado_por_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE medicamento ADD CONSTRAINT FK_C999D6848D90099F FOREIGN KEY (historial_clinico_id) REFERENCES historial_clinico (id)');
        $this->addSql('ALTER TABLE signos_vitales ADD CONSTRAINT FK_4ABFA61BFE35D8C4 FOREIGN KEY (creado_por_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE signos_vitales ADD CONSTRAINT FK_4ABFA61B8D90099F FOREIGN KEY (historial_clinico_id) REFERENCES historial_clinico (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE alergia DROP FOREIGN KEY FK_9C6D9BA1FE35D8C4');
        $this->addSql('ALTER TABLE alergia DROP FOREIGN KEY FK_9C6D9BA18D90099F');
        $this->addSql('ALTER TABLE costumbres DROP FOREIGN KEY FK_4DE9E867FE35D8C4');
        $this->addSql('ALTER TABLE costumbres DROP FOREIGN KEY FK_4DE9E867F6167A1C');
        $this->addSql('ALTER TABLE costumbres DROP FOREIGN KEY FK_4DE9E8678D90099F');
        $this->addSql('ALTER TABLE medicamento DROP FOREIGN KEY FK_C999D684FE35D8C4');
        $this->addSql('ALTER TABLE medicamento DROP FOREIGN KEY FK_C999D6848D90099F');
        $this->addSql('ALTER TABLE signos_vitales DROP FOREIGN KEY FK_4ABFA61BFE35D8C4');
        $this->addSql('ALTER TABLE signos_vitales DROP FOREIGN KEY FK_4ABFA61B8D90099F');
        $this->addSql('DROP TABLE alergia');
        $this->addSql('DROP TABLE costumbres');
        $this->addSql('DROP TABLE medicamento');
        $this->addSql('DROP TABLE signos_vitales');
    }
}
