<?php

  declare(strict_types=1);

  namespace DoctrineMigrations;

  use Doctrine\DBAL\Schema\Schema;
  use Doctrine\Migrations\AbstractMigration;

  /**
   * Auto-generated Migration: Please modify to your needs!
   */
  final class Version20220429294345 extends AbstractMigration
  {
    public function getDescription(): string
    {
      return '';
    }

    public function up(Schema $schema): void
    {
      // this up() migration is auto-generated, please modify it to your needs
      $this->addSql("INSERT INTO vehicles (brand, model, purchase_date, description) VALUES ('Fiat', 'Stilo', '2005-04-04', 'Fiat Stilo za dostave')");
      $this->addSql("INSERT INTO vehicles (brand, model, purchase_date, description) VALUES('Zastava','Stojadin', '1985-04-03', 'Zastava Stojko je zakon')");
    }

    public function down(Schema $schema): void
    {
      // this down() migration is auto-generated, please modify it to your needs
//      $this->addSql('ALTER TABLE vehicles DROP description');
    }
  }
