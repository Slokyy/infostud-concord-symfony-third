<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220428162134 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE driver_vehicle (id INT AUTO_INCREMENT NOT NULL, driver_id INT NOT NULL, vehicle_id INT NOT NULL, date_reserved DATE NOT NULL, INDEX IDX_DE7F80E6C3423909 (driver_id), INDEX IDX_DE7F80E6545317D1 (vehicle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE drivers (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, birthdate DATE NOT NULL, city VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicles (id INT AUTO_INCREMENT NOT NULL, brand VARCHAR(255) NOT NULL, model VARCHAR(255) NOT NULL, purchase_date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE driver_vehicle ADD CONSTRAINT FK_DE7F80E6C3423909 FOREIGN KEY (driver_id) REFERENCES drivers (id)');
        $this->addSql('ALTER TABLE driver_vehicle ADD CONSTRAINT FK_DE7F80E6545317D1 FOREIGN KEY (vehicle_id) REFERENCES vehicles (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE driver_vehicle DROP FOREIGN KEY FK_DE7F80E6C3423909');
        $this->addSql('ALTER TABLE driver_vehicle DROP FOREIGN KEY FK_DE7F80E6545317D1');
        $this->addSql('DROP TABLE driver_vehicle');
        $this->addSql('DROP TABLE drivers');
        $this->addSql('DROP TABLE vehicles');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
