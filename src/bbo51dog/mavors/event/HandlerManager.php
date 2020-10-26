<?php

namespace bbo51dog\mavors\event;

use bbo51dog\mavors\MavorsCore;
use pocketmine\Server;

class HandlerManager{

    /** @var MavorsCore */
    private $core;

    /**
     * HandlerManager constructor.
     * @param MavorsCore $core
     */
    public function __construct(MavorsCore $core){
        $this->core = $core;
    }

    public function registerHandler(EventHandler $handler): self{
        Server::getInstance()->getPluginManager()->registerEvents($handler, $this->core->getPlugin());
        $handler->setHandlerManager($this);
        return $this;
    }

    /**
     * @return MavorsCore
     */
    public function getCore(): MavorsCore{
        return $this->core;
    }
}