<?php

namespace bbo51dog\mavors\money;

use bbo51dog\mavors\repository\UserRepository;

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