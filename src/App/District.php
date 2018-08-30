<?php

namespace Echowebid\Rajaongkir\App;

class District extends Api 
{
    protected $method = 'subdistrict';

    public function byCity($city)
    {
        $this->parameter = "?city=". $city;
        return $this->getData();
    }
}