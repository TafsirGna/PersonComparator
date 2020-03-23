<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200322122136 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA metier');
        $this->addSql('CREATE SEQUENCE metier.db_one_person_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE metier.user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE metier.comparison_result_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE metier.db_two_person_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE metier.db_one_person (id INT NOT NULL, created_by_id INT DEFAULT NULL, updated_by_id INT DEFAULT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, birth_date DATE NOT NULL, birth_place VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITH TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITH TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6588D5F0B03A8386 ON metier.db_one_person (created_by_id)');
        $this->addSql('CREATE INDEX IDX_6588D5F0896DBBDE ON metier.db_one_person (updated_by_id)');
        $this->addSql('CREATE TABLE metier."user" (id INT NOT NULL, created_by_id INT DEFAULT NULL, updated_by_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITH TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITH TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E8A0DB16E7927C74 ON metier."user" (email)');
        $this->addSql('CREATE INDEX IDX_E8A0DB16B03A8386 ON metier."user" (created_by_id)');
        $this->addSql('CREATE INDEX IDX_E8A0DB16896DBBDE ON metier."user" (updated_by_id)');
        $this->addSql('CREATE TABLE metier.comparison_result (id INT NOT NULL, db_one_person_id INT NOT NULL, db_two_person_id INT NOT NULL, created_by_id INT DEFAULT NULL, updated_by_id INT DEFAULT NULL, result JSON NOT NULL, created_at TIMESTAMP(0) WITH TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITH TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_200A1D27DCE2F967 ON metier.comparison_result (db_one_person_id)');
        $this->addSql('CREATE INDEX IDX_200A1D27FC326FF7 ON metier.comparison_result (db_two_person_id)');
        $this->addSql('CREATE INDEX IDX_200A1D27B03A8386 ON metier.comparison_result (created_by_id)');
        $this->addSql('CREATE INDEX IDX_200A1D27896DBBDE ON metier.comparison_result (updated_by_id)');
        $this->addSql('CREATE TABLE metier.db_two_person (id INT NOT NULL, created_by_id INT DEFAULT NULL, updated_by_id INT DEFAULT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, birth_date DATE NOT NULL, birth_place VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITH TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITH TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2B65470DB03A8386 ON metier.db_two_person (created_by_id)');
        $this->addSql('CREATE INDEX IDX_2B65470D896DBBDE ON metier.db_two_person (updated_by_id)');
        $this->addSql('ALTER TABLE metier.db_one_person ADD CONSTRAINT FK_6588D5F0B03A8386 FOREIGN KEY (created_by_id) REFERENCES metier."user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE metier.db_one_person ADD CONSTRAINT FK_6588D5F0896DBBDE FOREIGN KEY (updated_by_id) REFERENCES metier."user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE metier."user" ADD CONSTRAINT FK_E8A0DB16B03A8386 FOREIGN KEY (created_by_id) REFERENCES metier."user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE metier."user" ADD CONSTRAINT FK_E8A0DB16896DBBDE FOREIGN KEY (updated_by_id) REFERENCES metier."user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE metier.comparison_result ADD CONSTRAINT FK_200A1D27DCE2F967 FOREIGN KEY (db_one_person_id) REFERENCES metier.db_one_person (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE metier.comparison_result ADD CONSTRAINT FK_200A1D27FC326FF7 FOREIGN KEY (db_two_person_id) REFERENCES metier.db_two_person (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE metier.comparison_result ADD CONSTRAINT FK_200A1D27B03A8386 FOREIGN KEY (created_by_id) REFERENCES metier."user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE metier.comparison_result ADD CONSTRAINT FK_200A1D27896DBBDE FOREIGN KEY (updated_by_id) REFERENCES metier."user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE metier.db_two_person ADD CONSTRAINT FK_2B65470DB03A8386 FOREIGN KEY (created_by_id) REFERENCES metier."user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE metier.db_two_person ADD CONSTRAINT FK_2B65470D896DBBDE FOREIGN KEY (updated_by_id) REFERENCES metier."user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE metier.comparison_result DROP CONSTRAINT FK_200A1D27DCE2F967');
        $this->addSql('ALTER TABLE metier.db_one_person DROP CONSTRAINT FK_6588D5F0B03A8386');
        $this->addSql('ALTER TABLE metier.db_one_person DROP CONSTRAINT FK_6588D5F0896DBBDE');
        $this->addSql('ALTER TABLE metier."user" DROP CONSTRAINT FK_E8A0DB16B03A8386');
        $this->addSql('ALTER TABLE metier."user" DROP CONSTRAINT FK_E8A0DB16896DBBDE');
        $this->addSql('ALTER TABLE metier.comparison_result DROP CONSTRAINT FK_200A1D27B03A8386');
        $this->addSql('ALTER TABLE metier.comparison_result DROP CONSTRAINT FK_200A1D27896DBBDE');
        $this->addSql('ALTER TABLE metier.db_two_person DROP CONSTRAINT FK_2B65470DB03A8386');
        $this->addSql('ALTER TABLE metier.db_two_person DROP CONSTRAINT FK_2B65470D896DBBDE');
        $this->addSql('ALTER TABLE metier.comparison_result DROP CONSTRAINT FK_200A1D27FC326FF7');
        $this->addSql('DROP SEQUENCE metier.db_one_person_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE metier.user_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE metier.comparison_result_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE metier.db_two_person_id_seq CASCADE');
        $this->addSql('DROP TABLE metier.db_one_person');
        $this->addSql('DROP TABLE metier."user"');
        $this->addSql('DROP TABLE metier.comparison_result');
        $this->addSql('DROP TABLE metier.db_two_person');
    }
}
