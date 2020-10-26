<?php

namespace bbo51dog\mavors\service\interfaces;

use bbo51dog\mavors\entity\User;
use bbo51dog\mavors\service\Service;

interface UserService extends Service{

    public function new(string $name);

    public function getUser(string $name): User;

    public function existsUser(string $name): bool;
}