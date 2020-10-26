<?php

namespace bbo51dog\mavors\service;

use bbo51dog\mavors\repository\UserRepository;
use bbo51dog\mavors\service\interfaces\MoneyService;

class MoneyServiceImpl implements MoneyService{

    /** @var UserRepository */
    private $userRepo;

    /**
     * MoneyServiceImpl constructor.
     * @param UserRepository $userRepo
     */
    public function __construct(UserRepository $userRepo){
        $this->userRepo = $userRepo;
    }
}