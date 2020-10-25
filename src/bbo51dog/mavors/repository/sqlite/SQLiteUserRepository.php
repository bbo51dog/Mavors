<?php

namespace bbo51dog\mavors\repository\sqlite;

use bbo51dog\mavors\MavorsPlugin;
use bbo51dog\mavors\repository\UserRepository;
use SQLite3;

class SQLiteUserRepository implements UserRepository{

    /** @var SQLite3 */
    private $db;

    public function __construct(MavorsPlugin $plugin){
        $this->db = new SQLite3($plugin->getDataFolder() . MavorsPlugin::SQLITE_FILE_NAME);
    }

    public function close(): void{
        $this->db->close();
    }
}