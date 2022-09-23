<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220923192002 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE battle (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, date DATETIME NOT NULL, location VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE battle_character (battle_id INT NOT NULL, character_id INT NOT NULL, INDEX IDX_11A6355AC9732719 (battle_id), INDEX IDX_11A6355A1136BE75 (character_id), PRIMARY KEY(battle_id, character_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE battle_character ADD CONSTRAINT FK_11A6355AC9732719 FOREIGN KEY (battle_id) REFERENCES battle (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE battle_character ADD CONSTRAINT FK_11A6355A1136BE75 FOREIGN KEY (character_id) REFERENCES `character` (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE battle_character DROP FOREIGN KEY FK_11A6355AC9732719');
        $this->addSql('ALTER TABLE battle_character DROP FOREIGN KEY FK_11A6355A1136BE75');
        $this->addSql('DROP TABLE battle');
        $this->addSql('DROP TABLE battle_character');
    }
}
