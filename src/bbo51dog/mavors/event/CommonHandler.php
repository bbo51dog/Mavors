<?php

namespace bbo51dog\mavors\event;

use bbo51dog\mavors\service\interfaces\UserService;
use pocketmine\event\player\PlayerLoginEvent;

class CommonHandler extends EventHandler{

    public function onLogin(PlayerLoginEvent $event){
        $player = $event->getPlayer();
        $name = $player->getName();
        /** @var UserService $userService */
        $userService = $this->getHandlerManager()->getCore()->getServiceProvider()->get(UserService::class);
        if(!$userService->existsUser($name)){
            $userService->new($name);
        }
    }
}