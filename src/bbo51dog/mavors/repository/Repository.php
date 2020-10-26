<?php

namespace bbo51dog\mavors\repository;

use bbo51dog\mavors\MavorsCore;

interface Repository{

    /**
     * Repository constructor.
     * @param MavorsCore $core
     */
    public function __construct(MavorsCore $core);

    /**
     * Close database connection
     */
    public function close(): void;
}