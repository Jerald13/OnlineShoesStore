<?php

namespace App\Http\Controllers\StrategyPattern;

use Illuminate\Http\Request;

class LoginContext
{
    private $strategy;

    public function __construct($strategy)
    {
        $this->strategy = $strategy;
    }

    public function login(Request $request){
        return $this->strategy->login($request);
    }
}
