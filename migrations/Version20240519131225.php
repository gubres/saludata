<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240519131225 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE clasificacion_sanguinea (id INT AUTO_INCREMENT NOT NULL, creado_por_id INT NOT NULL, actualizado_por_id INT DEFAULT NULL, historial_clinico_id INT NOT NULL, tipo VARCHAR(1) NOT NULL, rh VARCHAR(1) NOT NULL, donante TINYINT(1) NOT NULL, descripcion LONGTEXT DEFAULT NULL, ultima_donacion DATE DEFAULT NULL, frecuencia LONGTEXT DEFAULT NULL, creado_en DATETIME NOT NULL, actualizado_en DATETIME DEFAULT NULL, INDEX IDX_F87AB790FE35D8C4 (creado_por_id), INDEX IDX_F87AB790F6167A1C (actualizado_por_id), UNIQUE INDEX UNIQ_F87AB7908D90099F (historial_clinico_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dieta (id INT AUTO_INCREMENT NOT NULL, creado_por_id INT NOT NULL, historial_clinico_id INT NOT NULL, tipo LONGTEXT NOT NULL, frecuencia LONGTEXT NOT NULL, que_consume LONGTEXT NOT NULL, creado_en DATETIME NOT NULL, INDEX IDX_D3447AEEFE35D8C4 (creado_por_id), INDEX IDX_D3447AEE8D90099F (historial_clinico_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE examen_abdomen (id INT AUTO_INCREMENT NOT NULL, creado_por_id INT NOT NULL, historial_clinico_id INT NOT NULL, inspeccion LONGTEXT NOT NULL, palpacion LONGTEXT NOT NULL, percusion LONGTEXT NOT NULL, ausculta LONGTEXT NOT NULL, creado_en DATETIME NOT NULL, INDEX IDX_AB69EC4CFE35D8C4 (creado_por_id), INDEX IDX_AB69EC4C8D90099F (historial_clinico_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE examen_cabeza (id INT AUTO_INCREMENT NOT NULL, creado_por_id INT NOT NULL, historial_clinico_id INT NOT NULL, inspeccion LONGTEXT NOT NULL, palpacion LONGTEXT NOT NULL, percusion LONGTEXT NOT NULL, ausculta LONGTEXT NOT NULL, creado_en DATETIME NOT NULL, INDEX IDX_97C12439FE35D8C4 (creado_por_id), INDEX IDX_97C124398D90099F (historial_clinico_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE examen_miembros_inferiores (id INT AUTO_INCREMENT NOT NULL, creado_por_id INT NOT NULL, historial_clinico_id INT NOT NULL, inspeccion LONGTEXT NOT NULL, palpacion LONGTEXT NOT NULL, percusion LONGTEXT NOT NULL, ausculta LONGTEXT NOT NULL, creado_en DATETIME NOT NULL, INDEX IDX_465CA785FE35D8C4 (creado_por_id), INDEX IDX_465CA7858D90099F (historial_clinico_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE examen_miembros_superiores (id INT AUTO_INCREMENT NOT NULL, creado_por_id INT NOT NULL, historial_clinico_id INT NOT NULL, inspeccion LONGTEXT NOT NULL, palpacion LONGTEXT NOT NULL, percusion LONGTEXT NOT NULL, ausculta LONGTEXT NOT NULL, creado_en DATETIME NOT NULL, INDEX IDX_E29152A4FE35D8C4 (creado_por_id), INDEX IDX_E29152A48D90099F (historial_clinico_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE examen_pelvico (id INT AUTO_INCREMENT NOT NULL, creado_por_id INT NOT NULL, historial_clinico_id INT NOT NULL, inspeccion LONGTEXT NOT NULL, palpacion LONGTEXT NOT NULL, percusion LONGTEXT NOT NULL, ausculta LONGTEXT NOT NULL, creado_en DATETIME NOT NULL, INDEX IDX_4CF02796FE35D8C4 (creado_por_id), INDEX IDX_4CF027968D90099F (historial_clinico_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE examen_torax (id INT AUTO_INCREMENT NOT NULL, creado_por_id INT NOT NULL, historial_clinico_id INT NOT NULL, inspeccion LONGTEXT NOT NULL, palpacion LONGTEXT NOT NULL, percusion LONGTEXT NOT NULL, ausculta LONGTEXT NOT NULL, creado_en DATETIME NOT NULL, INDEX IDX_B8CCFAB5FE35D8C4 (creado_por_id), INDEX IDX_B8CCFAB58D90099F (historial_clinico_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE historico_obstetrico_yginecologico (id INT AUTO_INCREMENT NOT NULL, creado_por_id INT NOT NULL, actualizado_por_id INT DEFAULT NULL, historial_clinico_id INT NOT NULL, edad_primera_regla INT NOT NULL, edad_ultima_regla INT DEFAULT NULL, duracion_regla INT NOT NULL, ciclo_regular TINYINT(1) NOT NULL, uso_medicacion TINYINT(1) NOT NULL, medicamento LONGTEXT DEFAULT NULL, posologia LONGTEXT DEFAULT NULL, dolor TINYINT(1) NOT NULL, intensidad_dolor INT DEFAULT NULL, tiene_hijos TINYINT(1) NOT NULL, cantidad_hijos INT DEFAULT NULL, tipo_parto LONGTEXT DEFAULT NULL, tiempo_entre_partos INT DEFAULT NULL, edad_primero_parto DATE DEFAULT NULL, edad_ultimo_parto DATE DEFAULT NULL, citologia_vaginal TINYINT(1) NOT NULL, primera_coleta DATE DEFAULT NULL, ultima_coleta DATE DEFAULT NULL, resultado_coleta LONGTEXT DEFAULT NULL, cancer_de_mama TINYINT(1) NOT NULL, fecha_cancer DATE DEFAULT NULL, tratamiento_cancer LONGTEXT DEFAULT NULL, vph TINYINT(1) NOT NULL, tratamiento_vph LONGTEXT DEFAULT NULL, creado_en DATETIME NOT NULL, actualizado_en DATETIME DEFAULT NULL, INDEX IDX_CC801C72FE35D8C4 (creado_por_id), INDEX IDX_CC801C72F6167A1C (actualizado_por_id), UNIQUE INDEX UNIQ_CC801C728D90099F (historial_clinico_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE queja_actual (id INT AUTO_INCREMENT NOT NULL, creado_por_id INT NOT NULL, historial_clinico_id INT NOT NULL, queja VARCHAR(50) NOT NULL, descripcion LONGTEXT NOT NULL, cuando_empezo DATE NOT NULL, duracion LONGTEXT NOT NULL, creado_en DATETIME NOT NULL, INDEX IDX_EFAF33B7FE35D8C4 (creado_por_id), INDEX IDX_EFAF33B78D90099F (historial_clinico_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE resultado_prueba (id INT AUTO_INCREMENT NOT NULL, creado_por_id INT NOT NULL, historial_clinico_id INT NOT NULL, nombre_prueba LONGTEXT NOT NULL, fecha DATE NOT NULL, resultado LONGTEXT NOT NULL, archivo LONGBLOB DEFAULT NULL, creado_en DATETIME NOT NULL, INDEX IDX_83FD54F9FE35D8C4 (creado_por_id), INDEX IDX_83FD54F98D90099F (historial_clinico_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vacuna (id INT AUTO_INCREMENT NOT NULL, creado_por_id INT NOT NULL, historial_clinico_id INT NOT NULL, nombre VARCHAR(50) NOT NULL, dosis INT NOT NULL, ultima_dosis DATE NOT NULL, creado_en DATETIME NOT NULL, INDEX IDX_7289F433FE35D8C4 (creado_por_id), INDEX IDX_7289F4338D90099F (historial_clinico_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE clasificacion_sanguinea ADD CONSTRAINT FK_F87AB790FE35D8C4 FOREIGN KEY (creado_por_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE clasificacion_sanguinea ADD CONSTRAINT FK_F87AB790F6167A1C FOREIGN KEY (actualizado_por_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE clasificacion_sanguinea ADD CONSTRAINT FK_F87AB7908D90099F FOREIGN KEY (historial_clinico_id) REFERENCES historial_clinico (id)');
        $this->addSql('ALTER TABLE dieta ADD CONSTRAINT FK_D3447AEEFE35D8C4 FOREIGN KEY (creado_por_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE dieta ADD CONSTRAINT FK_D3447AEE8D90099F FOREIGN KEY (historial_clinico_id) REFERENCES historial_clinico (id)');
        $this->addSql('ALTER TABLE examen_abdomen ADD CONSTRAINT FK_AB69EC4CFE35D8C4 FOREIGN KEY (creado_por_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE examen_abdomen ADD CONSTRAINT FK_AB69EC4C8D90099F FOREIGN KEY (historial_clinico_id) REFERENCES historial_clinico (id)');
        $this->addSql('ALTER TABLE examen_cabeza ADD CONSTRAINT FK_97C12439FE35D8C4 FOREIGN KEY (creado_por_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE examen_cabeza ADD CONSTRAINT FK_97C124398D90099F FOREIGN KEY (historial_clinico_id) REFERENCES historial_clinico (id)');
        $this->addSql('ALTER TABLE examen_miembros_inferiores ADD CONSTRAINT FK_465CA785FE35D8C4 FOREIGN KEY (creado_por_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE examen_miembros_inferiores ADD CONSTRAINT FK_465CA7858D90099F FOREIGN KEY (historial_clinico_id) REFERENCES historial_clinico (id)');
        $this->addSql('ALTER TABLE examen_miembros_superiores ADD CONSTRAINT FK_E29152A4FE35D8C4 FOREIGN KEY (creado_por_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE examen_miembros_superiores ADD CONSTRAINT FK_E29152A48D90099F FOREIGN KEY (historial_clinico_id) REFERENCES historial_clinico (id)');
        $this->addSql('ALTER TABLE examen_pelvico ADD CONSTRAINT FK_4CF02796FE35D8C4 FOREIGN KEY (creado_por_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE examen_pelvico ADD CONSTRAINT FK_4CF027968D90099F FOREIGN KEY (historial_clinico_id) REFERENCES historial_clinico (id)');
        $this->addSql('ALTER TABLE examen_torax ADD CONSTRAINT FK_B8CCFAB5FE35D8C4 FOREIGN KEY (creado_por_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE examen_torax ADD CONSTRAINT FK_B8CCFAB58D90099F FOREIGN KEY (historial_clinico_id) REFERENCES historial_clinico (id)');
        $this->addSql('ALTER TABLE historico_obstetrico_yginecologico ADD CONSTRAINT FK_CC801C72FE35D8C4 FOREIGN KEY (creado_por_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE historico_obstetrico_yginecologico ADD CONSTRAINT FK_CC801C72F6167A1C FOREIGN KEY (actualizado_por_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE historico_obstetrico_yginecologico ADD CONSTRAINT FK_CC801C728D90099F FOREIGN KEY (historial_clinico_id) REFERENCES historial_clinico (id)');
        $this->addSql('ALTER TABLE queja_actual ADD CONSTRAINT FK_EFAF33B7FE35D8C4 FOREIGN KEY (creado_por_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE queja_actual ADD CONSTRAINT FK_EFAF33B78D90099F FOREIGN KEY (historial_clinico_id) REFERENCES historial_clinico (id)');
        $this->addSql('ALTER TABLE resultado_prueba ADD CONSTRAINT FK_83FD54F9FE35D8C4 FOREIGN KEY (creado_por_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE resultado_prueba ADD CONSTRAINT FK_83FD54F98D90099F FOREIGN KEY (historial_clinico_id) REFERENCES historial_clinico (id)');
        $this->addSql('ALTER TABLE vacuna ADD CONSTRAINT FK_7289F433FE35D8C4 FOREIGN KEY (creado_por_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE vacuna ADD CONSTRAINT FK_7289F4338D90099F FOREIGN KEY (historial_clinico_id) REFERENCES historial_clinico (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE clasificacion_sanguinea DROP FOREIGN KEY FK_F87AB790FE35D8C4');
        $this->addSql('ALTER TABLE clasificacion_sanguinea DROP FOREIGN KEY FK_F87AB790F6167A1C');
        $this->addSql('ALTER TABLE clasificacion_sanguinea DROP FOREIGN KEY FK_F87AB7908D90099F');
        $this->addSql('ALTER TABLE dieta DROP FOREIGN KEY FK_D3447AEEFE35D8C4');
        $this->addSql('ALTER TABLE dieta DROP FOREIGN KEY FK_D3447AEE8D90099F');
        $this->addSql('ALTER TABLE examen_abdomen DROP FOREIGN KEY FK_AB69EC4CFE35D8C4');
        $this->addSql('ALTER TABLE examen_abdomen DROP FOREIGN KEY FK_AB69EC4C8D90099F');
        $this->addSql('ALTER TABLE examen_cabeza DROP FOREIGN KEY FK_97C12439FE35D8C4');
        $this->addSql('ALTER TABLE examen_cabeza DROP FOREIGN KEY FK_97C124398D90099F');
        $this->addSql('ALTER TABLE examen_miembros_inferiores DROP FOREIGN KEY FK_465CA785FE35D8C4');
        $this->addSql('ALTER TABLE examen_miembros_inferiores DROP FOREIGN KEY FK_465CA7858D90099F');
        $this->addSql('ALTER TABLE examen_miembros_superiores DROP FOREIGN KEY FK_E29152A4FE35D8C4');
        $this->addSql('ALTER TABLE examen_miembros_superiores DROP FOREIGN KEY FK_E29152A48D90099F');
        $this->addSql('ALTER TABLE examen_pelvico DROP FOREIGN KEY FK_4CF02796FE35D8C4');
        $this->addSql('ALTER TABLE examen_pelvico DROP FOREIGN KEY FK_4CF027968D90099F');
        $this->addSql('ALTER TABLE examen_torax DROP FOREIGN KEY FK_B8CCFAB5FE35D8C4');
        $this->addSql('ALTER TABLE examen_torax DROP FOREIGN KEY FK_B8CCFAB58D90099F');
        $this->addSql('ALTER TABLE historico_obstetrico_yginecologico DROP FOREIGN KEY FK_CC801C72FE35D8C4');
        $this->addSql('ALTER TABLE historico_obstetrico_yginecologico DROP FOREIGN KEY FK_CC801C72F6167A1C');
        $this->addSql('ALTER TABLE historico_obstetrico_yginecologico DROP FOREIGN KEY FK_CC801C728D90099F');
        $this->addSql('ALTER TABLE queja_actual DROP FOREIGN KEY FK_EFAF33B7FE35D8C4');
        $this->addSql('ALTER TABLE queja_actual DROP FOREIGN KEY FK_EFAF33B78D90099F');
        $this->addSql('ALTER TABLE resultado_prueba DROP FOREIGN KEY FK_83FD54F9FE35D8C4');
        $this->addSql('ALTER TABLE resultado_prueba DROP FOREIGN KEY FK_83FD54F98D90099F');
        $this->addSql('ALTER TABLE vacuna DROP FOREIGN KEY FK_7289F433FE35D8C4');
        $this->addSql('ALTER TABLE vacuna DROP FOREIGN KEY FK_7289F4338D90099F');
        $this->addSql('DROP TABLE clasificacion_sanguinea');
        $this->addSql('DROP TABLE dieta');
        $this->addSql('DROP TABLE examen_abdomen');
        $this->addSql('DROP TABLE examen_cabeza');
        $this->addSql('DROP TABLE examen_miembros_inferiores');
        $this->addSql('DROP TABLE examen_miembros_superiores');
        $this->addSql('DROP TABLE examen_pelvico');
        $this->addSql('DROP TABLE examen_torax');
        $this->addSql('DROP TABLE historico_obstetrico_yginecologico');
        $this->addSql('DROP TABLE queja_actual');
        $this->addSql('DROP TABLE resultado_prueba');
        $this->addSql('DROP TABLE vacuna');
    }
}
