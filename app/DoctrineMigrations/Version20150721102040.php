<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150721102040 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE answers (id INT AUTO_INCREMENT NOT NULL, question_id INT DEFAULT NULL, person_id INT DEFAULT NULL, content LONGTEXT NOT NULL, INDEX IDX_50D0C6061E27F6BF (question_id), INDEX IDX_50D0C606217BBB47 (person_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE persons (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE questions (id INT AUTO_INCREMENT NOT NULL, name LONGTEXT NOT NULL, helpblock VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cities (id INT AUTO_INCREMENT NOT NULL, deletedAt DATETIME DEFAULT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE helpers (id INT AUTO_INCREMENT NOT NULL, deletedAt DATETIME DEFAULT NULL, name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, url VARCHAR(255) DEFAULT NULL, phone_number VARCHAR(35) DEFAULT NULL COMMENT \'(DC2Type:phone_number)\', email VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, createdAt DATETIME NOT NULL, updatedAt DATETIME NOT NULL, createdBy VARCHAR(255) DEFAULT NULL, updatedBy VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE helpers_cities (helper_id INT NOT NULL, city_id INT NOT NULL, INDEX IDX_D8DFC96DD7693E95 (helper_id), INDEX IDX_D8DFC96D8BAC62AF (city_id), PRIMARY KEY(helper_id, city_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meetings (id INT AUTO_INCREMENT NOT NULL, city_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, deletedAt DATETIME DEFAULT NULL, description LONGTEXT DEFAULT NULL, tickets_url VARCHAR(255) DEFAULT NULL, facebook_url VARCHAR(255) DEFAULT NULL, INDEX IDX_44FE52E28BAC62AF (city_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meetings_topics (meeting_id INT NOT NULL, topic_id INT NOT NULL, INDEX IDX_5ECE9E2E67433D9C (meeting_id), INDEX IDX_5ECE9E2E1F55203D (topic_id), PRIMARY KEY(meeting_id, topic_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meetings_partners (meeting_id INT NOT NULL, partner_id INT NOT NULL, INDEX IDX_6260402C67433D9C (meeting_id), INDEX IDX_6260402C9393F8FE (partner_id), PRIMARY KEY(meeting_id, partner_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meetings_sponsors (meeting_id INT NOT NULL, sponsor_id INT NOT NULL, INDEX IDX_17BA444767433D9C (meeting_id), INDEX IDX_17BA444712F7FB51 (sponsor_id), PRIMARY KEY(meeting_id, sponsor_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partners (id INT AUTO_INCREMENT NOT NULL, deletedAt DATETIME DEFAULT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) DEFAULT NULL, phone_number VARCHAR(35) DEFAULT NULL COMMENT \'(DC2Type:phone_number)\', url VARCHAR(255) NOT NULL, facebook_url VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, resources LONGTEXT DEFAULT NULL, createdAt DATETIME NOT NULL, updatedAt DATETIME NOT NULL, createdBy VARCHAR(255) DEFAULT NULL, updatedBy VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partners_cities (partner_id INT NOT NULL, city_id INT NOT NULL, INDEX IDX_495D42EC9393F8FE (partner_id), INDEX IDX_495D42EC8BAC62AF (city_id), PRIMARY KEY(partner_id, city_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE places (id INT AUTO_INCREMENT NOT NULL, city_id INT DEFAULT NULL, deletedAt DATETIME DEFAULT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) DEFAULT NULL, phone_number VARCHAR(35) DEFAULT NULL COMMENT \'(DC2Type:phone_number)\', url VARCHAR(255) DEFAULT NULL, facebook_url VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, resources LONGTEXT DEFAULT NULL, createdAt DATETIME NOT NULL, updatedAt DATETIME NOT NULL, createdBy VARCHAR(255) DEFAULT NULL, updatedBy VARCHAR(255) DEFAULT NULL, INDEX IDX_FEAF6C558BAC62AF (city_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE speakers (id INT AUTO_INCREMENT NOT NULL, deletedAt DATETIME DEFAULT NULL, name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, url VARCHAR(255) DEFAULT NULL, facebook_url VARCHAR(255) DEFAULT NULL, bio LONGTEXT DEFAULT NULL, photo VARCHAR(255) DEFAULT NULL, phone_number VARCHAR(35) DEFAULT NULL COMMENT \'(DC2Type:phone_number)\', email VARCHAR(255) DEFAULT NULL, createdAt DATETIME NOT NULL, updatedAt DATETIME NOT NULL, createdBy VARCHAR(255) DEFAULT NULL, updatedBy VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sponsors (id INT AUTO_INCREMENT NOT NULL, deletedAt DATETIME DEFAULT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) DEFAULT NULL, url VARCHAR(255) DEFAULT NULL, facebook_url VARCHAR(255) DEFAULT NULL, phone_number VARCHAR(35) DEFAULT NULL COMMENT \'(DC2Type:phone_number)\', description VARCHAR(255) DEFAULT NULL, resources LONGTEXT DEFAULT NULL, createdAt DATETIME NOT NULL, updatedAt DATETIME NOT NULL, createdBy VARCHAR(255) DEFAULT NULL, updatedBy VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sponsors_cities (sponsor_id INT NOT NULL, city_id INT NOT NULL, INDEX IDX_C4D92FB312F7FB51 (sponsor_id), INDEX IDX_C4D92FB38BAC62AF (city_id), PRIMARY KEY(sponsor_id, city_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE topics (id INT AUTO_INCREMENT NOT NULL, speaker_id INT DEFAULT NULL, deletedAt DATETIME DEFAULT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, createdAt DATETIME NOT NULL, updatedAt DATETIME NOT NULL, createdBy VARCHAR(255) DEFAULT NULL, updatedBy VARCHAR(255) DEFAULT NULL, INDEX IDX_91F64639D04A0F27 (speaker_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, city_id INT DEFAULT NULL, username VARCHAR(255) NOT NULL, username_canonical VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, email_canonical VARCHAR(255) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, locked TINYINT(1) NOT NULL, expired TINYINT(1) NOT NULL, expires_at DATETIME DEFAULT NULL, confirmation_token VARCHAR(255) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', credentials_expired TINYINT(1) NOT NULL, credentials_expire_at DATETIME DEFAULT NULL, deletedAt DATETIME DEFAULT NULL, name VARCHAR(100) DEFAULT NULL, last_name VARCHAR(100) DEFAULT NULL, url VARCHAR(255) DEFAULT NULL, phone_number VARCHAR(35) DEFAULT NULL COMMENT \'(DC2Type:phone_number)\', createdAt DATETIME NOT NULL, updatedAt DATETIME NOT NULL, createdBy VARCHAR(255) DEFAULT NULL, updatedBy VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_1483A5E992FC23A8 (username_canonical), UNIQUE INDEX UNIQ_1483A5E9A0D96FBF (email_canonical), INDEX IDX_1483A5E98BAC62AF (city_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ext_log_entries (id INT AUTO_INCREMENT NOT NULL, action VARCHAR(8) NOT NULL, logged_at DATETIME NOT NULL, object_id VARCHAR(64) DEFAULT NULL, object_class VARCHAR(255) NOT NULL, version INT NOT NULL, data LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', username VARCHAR(255) DEFAULT NULL, INDEX log_class_lookup_idx (object_class), INDEX log_date_lookup_idx (logged_at), INDEX log_user_lookup_idx (username), INDEX log_version_lookup_idx (object_id, object_class, version), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE answers ADD CONSTRAINT FK_50D0C6061E27F6BF FOREIGN KEY (question_id) REFERENCES questions (id)');
        $this->addSql('ALTER TABLE answers ADD CONSTRAINT FK_50D0C606217BBB47 FOREIGN KEY (person_id) REFERENCES persons (id)');
        $this->addSql('ALTER TABLE helpers_cities ADD CONSTRAINT FK_D8DFC96DD7693E95 FOREIGN KEY (helper_id) REFERENCES helpers (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE helpers_cities ADD CONSTRAINT FK_D8DFC96D8BAC62AF FOREIGN KEY (city_id) REFERENCES cities (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE meetings ADD CONSTRAINT FK_44FE52E28BAC62AF FOREIGN KEY (city_id) REFERENCES cities (id)');
        $this->addSql('ALTER TABLE meetings_topics ADD CONSTRAINT FK_5ECE9E2E67433D9C FOREIGN KEY (meeting_id) REFERENCES meetings (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE meetings_topics ADD CONSTRAINT FK_5ECE9E2E1F55203D FOREIGN KEY (topic_id) REFERENCES topics (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE meetings_partners ADD CONSTRAINT FK_6260402C67433D9C FOREIGN KEY (meeting_id) REFERENCES meetings (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE meetings_partners ADD CONSTRAINT FK_6260402C9393F8FE FOREIGN KEY (partner_id) REFERENCES partners (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE meetings_sponsors ADD CONSTRAINT FK_17BA444767433D9C FOREIGN KEY (meeting_id) REFERENCES meetings (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE meetings_sponsors ADD CONSTRAINT FK_17BA444712F7FB51 FOREIGN KEY (sponsor_id) REFERENCES sponsors (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE partners_cities ADD CONSTRAINT FK_495D42EC9393F8FE FOREIGN KEY (partner_id) REFERENCES partners (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE partners_cities ADD CONSTRAINT FK_495D42EC8BAC62AF FOREIGN KEY (city_id) REFERENCES cities (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE places ADD CONSTRAINT FK_FEAF6C558BAC62AF FOREIGN KEY (city_id) REFERENCES cities (id)');
        $this->addSql('ALTER TABLE sponsors_cities ADD CONSTRAINT FK_C4D92FB312F7FB51 FOREIGN KEY (sponsor_id) REFERENCES sponsors (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sponsors_cities ADD CONSTRAINT FK_C4D92FB38BAC62AF FOREIGN KEY (city_id) REFERENCES cities (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE topics ADD CONSTRAINT FK_91F64639D04A0F27 FOREIGN KEY (speaker_id) REFERENCES speakers (id)');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E98BAC62AF FOREIGN KEY (city_id) REFERENCES cities (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE answers DROP FOREIGN KEY FK_50D0C606217BBB47');
        $this->addSql('ALTER TABLE answers DROP FOREIGN KEY FK_50D0C6061E27F6BF');
        $this->addSql('ALTER TABLE helpers_cities DROP FOREIGN KEY FK_D8DFC96D8BAC62AF');
        $this->addSql('ALTER TABLE meetings DROP FOREIGN KEY FK_44FE52E28BAC62AF');
        $this->addSql('ALTER TABLE partners_cities DROP FOREIGN KEY FK_495D42EC8BAC62AF');
        $this->addSql('ALTER TABLE places DROP FOREIGN KEY FK_FEAF6C558BAC62AF');
        $this->addSql('ALTER TABLE sponsors_cities DROP FOREIGN KEY FK_C4D92FB38BAC62AF');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E98BAC62AF');
        $this->addSql('ALTER TABLE helpers_cities DROP FOREIGN KEY FK_D8DFC96DD7693E95');
        $this->addSql('ALTER TABLE meetings_topics DROP FOREIGN KEY FK_5ECE9E2E67433D9C');
        $this->addSql('ALTER TABLE meetings_partners DROP FOREIGN KEY FK_6260402C67433D9C');
        $this->addSql('ALTER TABLE meetings_sponsors DROP FOREIGN KEY FK_17BA444767433D9C');
        $this->addSql('ALTER TABLE meetings_partners DROP FOREIGN KEY FK_6260402C9393F8FE');
        $this->addSql('ALTER TABLE partners_cities DROP FOREIGN KEY FK_495D42EC9393F8FE');
        $this->addSql('ALTER TABLE topics DROP FOREIGN KEY FK_91F64639D04A0F27');
        $this->addSql('ALTER TABLE meetings_sponsors DROP FOREIGN KEY FK_17BA444712F7FB51');
        $this->addSql('ALTER TABLE sponsors_cities DROP FOREIGN KEY FK_C4D92FB312F7FB51');
        $this->addSql('ALTER TABLE meetings_topics DROP FOREIGN KEY FK_5ECE9E2E1F55203D');
        $this->addSql('DROP TABLE answers');
        $this->addSql('DROP TABLE persons');
        $this->addSql('DROP TABLE questions');
        $this->addSql('DROP TABLE cities');
        $this->addSql('DROP TABLE helpers');
        $this->addSql('DROP TABLE helpers_cities');
        $this->addSql('DROP TABLE meetings');
        $this->addSql('DROP TABLE meetings_topics');
        $this->addSql('DROP TABLE meetings_partners');
        $this->addSql('DROP TABLE meetings_sponsors');
        $this->addSql('DROP TABLE partners');
        $this->addSql('DROP TABLE partners_cities');
        $this->addSql('DROP TABLE places');
        $this->addSql('DROP TABLE speakers');
        $this->addSql('DROP TABLE sponsors');
        $this->addSql('DROP TABLE sponsors_cities');
        $this->addSql('DROP TABLE topics');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE ext_log_entries');
    }
}
