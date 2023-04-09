<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Types;
use Doctrine\Migrations\AbstractMigration;

final class Version20230409132902 extends AbstractMigration
{
    const TABLE_CONFERENCE = 'conferences';
    const TABLE_COMMENT = 'comments';

    public function getDescription(): string
    {
        return 'Creating the tables conferences and comments';
    }

    public function up(Schema $schema): void
    {
        $tableConference = $schema->createTable(self::TABLE_CONFERENCE);
        $tableConference->addColumn('id', 'integer', [
            'autoincrement' => true,
            'notnull' => true,
        ]);
        $tableConference->addColumn('name', 'string', [
            'notnull' => true,
            'length' => 255,
        ]);
        $tableConference->addColumn('city', 'string', [
            'notnull' => false,
            'length' => 255,
        ]);
        $tableConference->addColumn('year', 'string', [
            'notnull' => false,
            'length' => 4,
        ]);
        $tableConference->addColumn('is_international', 'boolean', [
            'notnull' => true,
            'default' => false,
        ]);
        $tableConference->setPrimaryKey(['id']);

        $tableComment = $schema->createTable(self::TABLE_COMMENT);
        $tableComment->addColumn('id', 'integer', [
            'autoincrement' => true,
            'notnull' => true,
        ]);
        $tableComment->addColumn('conference_id', 'integer');
        $tableComment->addColumn('author', 'string', [
            'notnull' => false,
            'length' => 255,
        ]);
        $tableComment->addColumn('text', 'text', [
            'notnull' => false,
            'length' => 4,
        ]);
        $tableComment->addColumn('email', 'string', [
            'notnull' => true,
            'length' => 255,
        ]);
        $tableComment->addColumn('created_at', Types::DATE_IMMUTABLE, [
            'notnull' => true,
        ]);
        $tableComment->setPrimaryKey(['id']);
        $tableComment->addForeignKeyConstraint(self::TABLE_CONFERENCE, ['conference_id'], ['id'], ['name' => 'fk_comments_conferences']);
    }

    public function down(Schema $schema): void
    {
        $schema->dropTable(self::TABLE_CONFERENCE);
        $schema->dropTable(self::TABLE_COMMENT);
    }
}
