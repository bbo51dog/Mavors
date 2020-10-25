<?php

namespace bbo51dog\mavors\reducer;

use bbo51dog\mavors\action\Action;
use bbo51dog\mavors\state\RootState;

class Reducer{

    /**
     * Reducer constructor.
     */
    private function __construct(){
    }

    public static function rootReducer(RootState $state, Action $action): RootState{
        return new RootState();
    }
}