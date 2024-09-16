<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240916112351 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE blogs (id INT AUTO_INCREMENT NOT NULL, blog_user_id INT NOT NULL, blog_title VARCHAR(255) NOT NULL, blog_content LONGTEXT NOT NULL, blog_date DATE NOT NULL, blog_image VARCHAR(255) NOT NULL, INDEX IDX_F41BCA704B986E16 (blog_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE blogs ADD CONSTRAINT FK_F41BCA704B986E16 FOREIGN KEY (blog_user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE blogs DROP FOREIGN KEY FK_F41BCA704B986E16');
        $this->addSql('DROP TABLE blogs');
    }
}
