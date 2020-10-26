<?php

namespace bbo51dog\mavors\service;

use bbo51dog\mavors\entity\User;
use bbo51dog\mavors\MavorsCore;
use bbo51dog\mavors\repository\UserRepository;
use bbo51dog\mavors\service\interfaces\UserService;
use function strtolower;

class UserServiceImpl implements UserService{

    /** @var UserRepository */
    private $userRepo;

    /**
     * UserServiceImpl constructor.
     * @param UserRepository $userRepo
     */
    public function __construct(UserRepository $userRepo){
        $this->userRepo = $userRepo;
    }

    public function new(string $name){
        $user = new User(strtolower($name));
        $user->setMoney(MavorsCore::DEFAULT_MONEY);
        $this->userRepo->register($user);
    }

    public function getUser(string $name): User{
        return $this->userRepo->findByName($name);
    }

    public function existsUser(string $name): bool{
        return $this->userRepo->exists($name);
    }
}