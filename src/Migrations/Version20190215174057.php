<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190215174057 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE projet CHANGE description description LONGTEXT DEFAULT NULL, CHANGE parcours_edu parcours_edu VARCHAR(255) DEFAULT NULL, CHANGE opportinute opportinute VARCHAR(255) DEFAULT NULL, CHANGE attentes attentes VARCHAR(255) DEFAULT NULL, CHANGE motivation motivation VARCHAR(255) DEFAULT NULL, CHANGE perspective perspective VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE projet CHANGE description description LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE parcours_edu parcours_edu VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE opportinute opportinute VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE attentes attentes VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE motivation motivation VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE perspective perspective VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
