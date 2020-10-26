<?php

namespace bbo51dog\mavors\repository\sqlite;

use bbo51dog\mavors\MavorsCore;
use bbo51dog\mavors\repository\UserRepository;
use SQLite3;

class SQLiteUserRepository implements UserRepository{

    /** @var SQLite3 */
    private $db;

    public function __construct(MavorsCore $core){
        $this->db = new SQLite3($core->getPlugin()->getDataFolder() . MavorsCore::SQLITE_FILE_NAME);
    }

    public function close(): void{
        $this->db->close();
    }
}