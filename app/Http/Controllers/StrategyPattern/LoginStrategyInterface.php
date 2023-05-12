<?php

namespace App\Http\Controllers\StrategyPattern;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

interface LoginStrategyInterface
{
    public function login(Request $request);
}
