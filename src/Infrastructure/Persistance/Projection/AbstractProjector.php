<?php

namespace Mauretto78\DDD\Infrastructure\Persistance\Projection;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Schema\Schema;
use SimpleEventStoreManager\Infrastructure\Projector\Projector;

abstract class AbstractProjector extends Projector
{
    /**
     * @var Connection
     */
    protected $db;

    /**
     * UserReadRepository constructor.
     * @param $db
     */
    public function __construct(Connection $db)
    {
        $this->db = $db;
        $this->createSchema();
    }

    /**
     * createSchema
     */
    private function createSchema()
    {
        try {
            $this->db->executeQuery('select count(*) from `users`');
        } catch (\Exception $e) {
            $schema = new Schema();
            $usersTable = $schema->createTable('users');
            $usersTable->addColumn('id', 'string', ['length' => 64]);
            $usersTable->addColumn('name', 'string', ['length' => 64]);
            $usersTable->addColumn('last_name', 'string', ['length' => 64]);
            $usersTable->addColumn('email', 'string', ['length' => 256]);
            $usersTable->setPrimaryKey(['id']);

            $platform = $this->db->getDatabasePlatform();
            $this->db->executeQuery($schema->toSql($platform)[0]);
        }
    }
}
