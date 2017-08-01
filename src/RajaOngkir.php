<?php

namespace Echowebid\Rajaongkir;

use Echowebid\Rajaongkir\app\Province;
use Echowebid\Rajaongkir\app\City;
use Echowebid\Rajaongkir\app\Cost;

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