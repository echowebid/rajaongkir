<?php

namespace Echowebid\Rajaongkir\App;

class City extends Api 
{
    protected $method = "city";

    public function byProvince($province_id)
    {
        $this->parameter = "?province=". $province_id;
        return $this->getData();
    }
}