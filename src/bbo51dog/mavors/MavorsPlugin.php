<?php

namespace bbo51dog\mavors;

use bbo51dog\mavors\action\Action;
use bbo51dog\mavors\event\CommonHandler;
use bbo51dog\mavors\event\HandlerManager;
use bbo51dog\mavors\money\MoneyService;
use bbo51dog\mavors\money\MoneyServiceImpl;
use bbo51dog\mavors\reducer\Reducer;
use bbo51dog\mavors\repository\sqlite\SQLiteUserRepository;
use bbo51dog\mavors\repository\UserRepository;
use bbo51dog\mavors\service\ServiceProvider;
use bbo51dog\mavors\state\RootState;
use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginBase;

class MavorsPlugin extends PluginBase implements MavorsCore{

    /** @var Store */
    private $store;

    /** @var UserRepository */
    private $userRepo;

    /** @var ServiceProvider */
    private $serviceProvider;

    public function onLoad(){
        $this->userRepo = new SQLiteUserRepository($this);
        $this->store = new Store(
            new RootState(),
            function(RootState $state, Action $action): RootState{
                return Reducer::rootReducer($state, $action);
            }
        );
        $this->serviceProvider = new ServiceProvider();
        $this->serviceProvider->registerAll([
            MoneyService::class => new MoneyServiceImpl($this->userRepo),
        ]);
    }

    public function onEnable(){
        $handlerManager = new HandlerManager($this);
        $handlerManager
            ->registerHandler(new CommonHandler());
    }

    public function onDisable(){
        $this->userRepo->close();
    }

    public function getStore(): Store{
        return $this->store;
    }

    public function getPlugin(): Plugin{
        return $this;
    }

    public function getServiceProvider(): ServiceProvider{
        return $this->serviceProvider;
    }
}