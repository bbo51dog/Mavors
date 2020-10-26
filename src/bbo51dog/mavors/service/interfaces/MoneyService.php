<?php

namespace bbo51dog\mavors\service\interfaces;

use bbo51dog\mavors\service\Service;

interface MoneyService extends Service{

    /**
     * @param string $name
     * @return int
     */
    public function getMoney(string $name): int;

    /**
     * @param string $name
     * @param int $money
     */
    public function setMoney(string $name, int $money): void;

    /**
     * @param string $name
     * @param int $money
     */
    public function addMoney(string $name, int $money): void;

    /**
     * @param string $name
     * @param int $money
     */
    public function reduceMoney(string $name, int $money): void;

    /**
     * @return string
     */
    public function getUnit(): string;
}