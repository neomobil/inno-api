<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240206225656 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_user_course_status DROP CONSTRAINT fk_97f2effaa76ed395');
        $this->addSql('ALTER TABLE user_user_course_status DROP CONSTRAINT fk_97f2effa944302cc');
        $this->addSql('DROP TABLE user_user_course_status');
        $this->addSql('DROP INDEX uniq_3bb60901a76ed395');
        $this->addSql('DROP INDEX uniq_3bb60901591cc992');
        $this->addSql('DROP INDEX uniq_3bb60901e9564011');
        $this->addSql('CREATE INDEX IDX_3BB60901A76ED395 ON user_course_status (user_id)');
        $this->addSql('CREATE INDEX IDX_3BB60901591CC992 ON user_course_status (course_id)');
        $this->addSql('CREATE INDEX IDX_3BB60901E9564011 ON user_course_status (course_status_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE TABLE user_user_course_status (user_id INT NOT NULL, user_course_status_id INT NOT NULL, PRIMARY KEY(user_id, user_course_status_id))');
        $this->addSql('CREATE INDEX idx_97f2effa944302cc ON user_user_course_status (user_course_status_id)');
        $this->addSql('CREATE INDEX idx_97f2effaa76ed395 ON user_user_course_status (user_id)');
        $this->addSql('ALTER TABLE user_user_course_status ADD CONSTRAINT fk_97f2effaa76ed395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_user_course_status ADD CONSTRAINT fk_97f2effa944302cc FOREIGN KEY (user_course_status_id) REFERENCES user_course_status (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP INDEX IDX_3BB60901A76ED395');
        $this->addSql('DROP INDEX IDX_3BB60901591CC992');
        $this->addSql('DROP INDEX IDX_3BB60901E9564011');
        $this->addSql('CREATE UNIQUE INDEX uniq_3bb60901a76ed395 ON user_course_status (user_id)');
        $this->addSql('CREATE UNIQUE INDEX uniq_3bb60901591cc992 ON user_course_status (course_id)');
        $this->addSql('CREATE UNIQUE INDEX uniq_3bb60901e9564011 ON user_course_status (course_status_id)');
    }
}
