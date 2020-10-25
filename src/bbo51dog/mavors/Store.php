<?php

namespace bbo51dog\mavors;

use bbo51dog\mavors\action\Action;
use bbo51dog\mavors\state\State;

class Store{

    /** @var State */
    private $state;

    /** @var callable */
    private $reducer;

    /**
     * Store constructor.
     * @param State $state
     * @param callable $reducer
     */
    public function __construct(State $state, callable $reducer){
        $this->state = $state;
        $this->reducer = $reducer;
    }

    public function dispatch(Action $action): void{
        $this->state = ($this->reducer)($this->state, $action);
    }
}