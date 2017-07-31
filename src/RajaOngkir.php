<?php

namespace echowebid\rajaongkir;

use echowebid\rajaongkir\app\Province;
use echowebid\rajaongkir\app\City;
use echowebid\rajaongkir\app\Cost;

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