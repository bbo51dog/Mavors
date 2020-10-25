<?php

namespace bbo51dog\mavors;

use bbo51dog\mavors\action\Action;
use bbo51dog\mavors\reducer\Reducer;
use bbo51dog\mavors\repository\sqlite\SQLiteUserRepository;
use bbo51dog\mavors\repository\UserRepository;
use bbo51dog\mavors\state\RootState;
use pocketmine\plugin\PluginBase;

class MavorsPlugin extends PluginBase{

    public const SQLITE_FILE_NAME = 'Mavors.db';

    /** @var Store */
    private $store;

    /** @var UserRepository */
    private $userRepo;

    public function onLoad(){
        $this->userRepo = new SQLiteUserRepository($this);
        $this->store = new Store(
            new RootState(),
            function(RootState $state, Action $action): RootState{
                return Reducer::rootReducer($state, $action);
            }
        );
    }

    public function onDisable(){
        $this->userRepo->close();
    }
}