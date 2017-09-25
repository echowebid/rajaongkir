<?php

namespace Echowebid\Rajaongkir;

use Echowebid\Rajaongkir\App\Province;
use Echowebid\Rajaongkir\App\City;
use Echowebid\Rajaongkir\App\Cost;

class RajaOngkir 
{
    public function Province()
    {
        return new Province;
    }
    
    public function City()
    {
        return new City;
    }
    
    public function Cost($attr)
    {
        return new Cost($attr);
    }
}