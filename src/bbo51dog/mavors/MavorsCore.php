<?php

namespace bbo51dog\mavors;

use bbo51dog\mavors\service\ServiceProvider;
use pocketmine\plugin\Plugin;

interface MavorsCore{

    public const SQLITE_FILE_NAME = 'Mavors.db';

    public function getStore(): Store;

    public function getPlugin(): Plugin;

    public function getServiceProvider(): ServiceProvider;
}