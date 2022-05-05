<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220504081808 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE astrologers (id INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT \'ID\', name VARCHAR(255) NOT NULL COMMENT \'Astrologer name\', bio LONGTEXT DEFAULT NULL COMMENT \'Astrologer biography\', personal LONGTEXT DEFAULT NULL COMMENT \'Astrologer personal information\', email VARCHAR(255) DEFAULT NULL COMMENT \'Astrologer email\', image VARCHAR(255) DEFAULT NULL COMMENT \'Astrologer personal photograohy\', status TINYINT(1) NOT NULL COMMENT \'Astrologer status\', created DATETIME DEFAULT NULL COMMENT \'Дата создания\', updated DATETIME DEFAULT NULL COMMENT \'Дата редактирования\', UNIQUE INDEX UNIQ_81DB2C89E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE astrologers_services (id INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT \'ID\', astrologer_id INT UNSIGNED DEFAULT NULL COMMENT \'ID\', service_id INT UNSIGNED DEFAULT NULL COMMENT \'ID\', price DOUBLE PRECISION DEFAULT NULL COMMENT \'Astrologer service price\', created DATETIME DEFAULT NULL COMMENT \'Дата создания\', updated DATETIME DEFAULT NULL COMMENT \'Дата редактирования\', INDEX IDX_45F5F5C656F716EE (astrologer_id), INDEX IDX_45F5F5C6ED5CA9E6 (service_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orders (id INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT \'ID\', astrologer_setvice_id INT UNSIGNED DEFAULT NULL COMMENT \'ID\', name VARCHAR(255) NOT NULL COMMENT \'Customer name\', email VARCHAR(255) NOT NULL COMMENT \'Customer email\', address LONGTEXT NOT NULL COMMENT \'Customer address\', status TINYINT(1) NOT NULL COMMENT \'Order status\', created DATETIME DEFAULT NULL COMMENT \'Дата создания\', updated DATETIME DEFAULT NULL COMMENT \'Дата редактирования\', UNIQUE INDEX UNIQ_E52FFDEEAC766501 (astrologer_setvice_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE services (id INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT \'ID\', name VARCHAR(255) NOT NULL COMMENT \'Service name\', status TINYINT(1) NOT NULL COMMENT \'Service status\', created DATETIME DEFAULT NULL COMMENT \'Дата создания\', updated DATETIME DEFAULT NULL COMMENT \'Дата редактирования\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE astrologers_services ADD CONSTRAINT FK_45F5F5C656F716EE FOREIGN KEY (astrologer_id) REFERENCES astrologers (id)');
        $this->addSql('ALTER TABLE astrologers_services ADD CONSTRAINT FK_45F5F5C6ED5CA9E6 FOREIGN KEY (service_id) REFERENCES services (id)');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEEAC766501 FOREIGN KEY (astrologer_setvice_id) REFERENCES astrologers_services (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE astrologers_services DROP FOREIGN KEY FK_45F5F5C656F716EE');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEEAC766501');
        $this->addSql('ALTER TABLE astrologers_services DROP FOREIGN KEY FK_45F5F5C6ED5CA9E6');
        $this->addSql('DROP TABLE astrologers');
        $this->addSql('DROP TABLE astrologers_services');
        $this->addSql('DROP TABLE orders');
        $this->addSql('DROP TABLE services');
    }
}
