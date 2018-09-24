<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180924142329 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE actualite ADD date_actualite VARCHAR(255) DEFAULT NULL, CHANGE contenu contenu VARCHAR(255) NOT NULL, CHANGE actu_mis_en_avant actu_mis_en_avant VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE avant CHANGE contenu contenu VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE actualite DROP date_actualite, CHANGE contenu contenu TEXT NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE actu_mis_en_avant actu_mis_en_avant TEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE avant CHANGE contenu contenu TEXT NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
