<?php

namespace bbo51dog\mavors\entity;

class User{

    /** @var string */
    private $name;

    /** @var int */
    private $money;

    /**
     * @return string
     */
    public function getName(): string{
        return $this->name;
    }

    /**
     * @return int
     */
    public function getMoney(): int{
        return $this->money;
    }

    /**
     * @param int $money
     */
    public function setMoney(int $money): void{
        $this->money = $money;
    }
}