<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200215210257 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, type_id INT NOT NULL, titre VARCHAR(255) NOT NULL, INDEX IDX_23A0E66C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE competence (id INT AUTO_INCREMENT NOT NULL, matiere_id INT NOT NULL, libelle VARCHAR(255) NOT NULL, maitrise INT DEFAULT NULL, poid INT DEFAULT NULL, INDEX IDX_94D4687FF46CD258 (matiere_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE competence_article (competence_id INT NOT NULL, article_id INT NOT NULL, INDEX IDX_1672B14C15761DAB (competence_id), INDEX IDX_1672B14C7294869C (article_id), PRIMARY KEY(competence_id, article_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE matiere (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE competence ADD CONSTRAINT FK_94D4687FF46CD258 FOREIGN KEY (matiere_id) REFERENCES matiere (id)');
        $this->addSql('ALTER TABLE competence_article ADD CONSTRAINT FK_1672B14C15761DAB FOREIGN KEY (competence_id) REFERENCES competence (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE competence_article ADD CONSTRAINT FK_1672B14C7294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE competence_article DROP FOREIGN KEY FK_1672B14C7294869C');
        $this->addSql('ALTER TABLE competence_article DROP FOREIGN KEY FK_1672B14C15761DAB');
        $this->addSql('ALTER TABLE competence DROP FOREIGN KEY FK_94D4687FF46CD258');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66C54C8C93');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE competence');
        $this->addSql('DROP TABLE competence_article');
        $this->addSql('DROP TABLE matiere');
        $this->addSql('DROP TABLE type');
    }
}
