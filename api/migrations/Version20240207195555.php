<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240207195555 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE course_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE course_status_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_course_status_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE course (id INT NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE course_status (id INT NOT NULL, name VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, email VARCHAR(255) NOT NULL, roles JSON DEFAULT NULL, password VARCHAR(255) NOT NULL, token VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE user_course (user_id INT NOT NULL, course_id INT NOT NULL, PRIMARY KEY(user_id, course_id))');
        $this->addSql('CREATE INDEX IDX_73CC7484A76ED395 ON user_course (user_id)');
        $this->addSql('CREATE INDEX IDX_73CC7484591CC992 ON user_course (course_id)');
        $this->addSql('CREATE TABLE user_course_status (id INT NOT NULL, user_id INT NOT NULL, course_id INT NOT NULL, course_status_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_3BB60901A76ED395 ON user_course_status (user_id)');
        $this->addSql('CREATE INDEX IDX_3BB60901591CC992 ON user_course_status (course_id)');
        $this->addSql('CREATE INDEX IDX_3BB60901E9564011 ON user_course_status (course_status_id)');
        $this->addSql('ALTER TABLE user_course ADD CONSTRAINT FK_73CC7484A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_course ADD CONSTRAINT FK_73CC7484591CC992 FOREIGN KEY (course_id) REFERENCES course (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_course_status ADD CONSTRAINT FK_3BB60901A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_course_status ADD CONSTRAINT FK_3BB60901591CC992 FOREIGN KEY (course_id) REFERENCES course (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_course_status ADD CONSTRAINT FK_3BB60901E9564011 FOREIGN KEY (course_status_id) REFERENCES course_status (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE course_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE course_status_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE user_course_status_id_seq CASCADE');
        $this->addSql('ALTER TABLE user_course DROP CONSTRAINT FK_73CC7484A76ED395');
        $this->addSql('ALTER TABLE user_course DROP CONSTRAINT FK_73CC7484591CC992');
        $this->addSql('ALTER TABLE user_course_status DROP CONSTRAINT FK_3BB60901A76ED395');
        $this->addSql('ALTER TABLE user_course_status DROP CONSTRAINT FK_3BB60901591CC992');
        $this->addSql('ALTER TABLE user_course_status DROP CONSTRAINT FK_3BB60901E9564011');
        $this->addSql('DROP TABLE course');
        $this->addSql('DROP TABLE course_status');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE user_course');
        $this->addSql('DROP TABLE user_course_status');
    }
}
