<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

use App\Repository\cart\CartModelRepository;

class cartFacade extends Facade
{
    public static function getFacadeAccessor()
    {
        return CartModelRepository::class;
    }
}
