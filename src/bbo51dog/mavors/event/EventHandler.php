<?php

namespace bbo51dog\mavors\event;

use pocketmine\event\Listener;

abstract class EventHandler implements Listener{

    /** @var HandlerManager */
    private $handlerManager;

    /**
     * @return HandlerManager
     */
    public function getHandlerManager(): HandlerManager{
        return $this->handlerManager;
    }

    /**
     * @param HandlerManager $handlerManager
     */
    public function setHandlerManager(HandlerManager $handlerManager): void{
        $this->handlerManager = $handlerManager;
    }
}