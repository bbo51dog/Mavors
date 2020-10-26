<?php

namespace bbo51dog\mavors\service;

use bbo51dog\mavors\entity\User;
use bbo51dog\mavors\repository\UserRepository;
use bbo51dog\mavors\service\interfaces\MoneyService;
use pocketmine\utils\TextFormat;

class MoneyServiceImpl implements MoneyService{

    public const MONEY_UNIT = TextFormat::YELLOW . 'G' . TextFormat::RESET;

    /** @var UserRepository */
    private $userRepo;

    /**
     * MoneyServiceImpl constructor.
     * @param UserRepository $userRepo
     */
    public function __construct(UserRepository $userRepo){
        $this->userRepo = $userRepo;
    }

    public function getMoney(string $name): int{
        $user = $this->userRepo->findByName($name);
        if(!$user instanceof User){
            throw new ServiceException("User {$name} not found");
        }
        return $user->getMoney();
    }

    public function setMoney(string $name, int $money): void{
        if($money < 0){
            throw new ServiceException("Money must not be less than 0");
        }
        $user = $this->userRepo->findByName($name);
        if(!$user instanceof User){
            throw new ServiceException("User {$name} not found");
        }
        $user->setMoney($money);
    }

    public function addMoney(string $name, int $money): void{
        $this->setMoney($name, $this->getMoney($name) + $money);
    }

    public function reduceMoney(string $name, int $money): void{
        $this->setMoney($name, $this->getMoney($name) - $money);
    }

    public function getUnit(): string{
        return self::MONEY_UNIT;
    }
}