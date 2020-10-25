<?php

namespace bbo51dog\mavors\repository;

use bbo51dog\mavors\MavorsPlugin;

interface Repository{

    /**
     * Repository constructor.
     * @param MavorsPlugin $plugin
     */
    public function __construct(MavorsPlugin $plugin);

    /**
     * Close database connection
     */
    public function close(): void;
}