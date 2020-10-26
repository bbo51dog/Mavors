<?php

namespace bbo51dog\mavors\service;

use bbo51dog\mavors\repository\UserRepository;
use bbo51dog\mavors\service\interfaces\UserService;

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
}