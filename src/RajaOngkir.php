<?php

namespace Echowebid\Rajaongkir;

use Echowebid\Rajaongkir\App\City;
use Echowebid\Rajaongkir\App\Cost;
use Echowebid\Rajaongkir\App\District;
use Echowebid\Rajaongkir\App\Province;
use Echowebid\Rajaongkir\App\Waybill;

class RajaOngkir 
{
    public function City()
    {
        return new City;
    }
    
    public function Cost($args)
    {
        return new Cost($args);
    }
    
    public function District()
    {
        return new District;
    }

    public function Province()
    {
        return new Province;
    }
    
    public function Waybill($args)
    {
        return new Waybill($args);
    }
}