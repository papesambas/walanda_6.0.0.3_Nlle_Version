<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240704193420 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE UNIQUE INDEX UNIQ_72B88B248947610D ON cycles (designation)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CF7489B28947610D ON departements (designation)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_59378F8C8947610D ON ecole_provenances (designation)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_89D792808947610D ON enseignements (designation)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_29F65EB18947610D ON etablissements (designation)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_56F771A08947610D ON niveaux (designation)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A069E65D8947610D ON noms (designation)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E71162E38947610D ON prenoms (designation)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2FDA85FA8947610D ON professions (designation)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A26779F38947610D ON regions (designation)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C1A17FE9ADC4024B ON santes (maladie)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_403505E68947610D ON statuts (designation)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_72B88B248947610D ON cycles');
        $this->addSql('DROP INDEX UNIQ_CF7489B28947610D ON departements');
        $this->addSql('DROP INDEX UNIQ_59378F8C8947610D ON ecole_provenances');
        $this->addSql('DROP INDEX UNIQ_89D792808947610D ON enseignements');
        $this->addSql('DROP INDEX UNIQ_29F65EB18947610D ON etablissements');
        $this->addSql('DROP INDEX UNIQ_56F771A08947610D ON niveaux');
        $this->addSql('DROP INDEX UNIQ_A069E65D8947610D ON noms');
        $this->addSql('DROP INDEX UNIQ_E71162E38947610D ON prenoms');
        $this->addSql('DROP INDEX UNIQ_2FDA85FA8947610D ON professions');
        $this->addSql('DROP INDEX UNIQ_A26779F38947610D ON regions');
        $this->addSql('DROP INDEX UNIQ_C1A17FE9ADC4024B ON santes');
        $this->addSql('DROP INDEX UNIQ_403505E68947610D ON statuts');
    }
}
