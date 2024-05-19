<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240519162350 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE historial_clinico DROP INDEX UNIQ_C0B51A81FE35D8C4, ADD INDEX IDX_C0B51A81FE35D8C4 (creado_por_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE historial_clinico DROP INDEX IDX_C0B51A81FE35D8C4, ADD UNIQUE INDEX UNIQ_C0B51A81FE35D8C4 (creado_por_id)');
    }
}
