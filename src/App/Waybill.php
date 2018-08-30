<?php

namespace Echowebid\Rajaongkir\App;

class Waybill extends Api 
{
    public function __construct($args)
    {
        parent::__construct();
        
        $this->options = [
            CURLOPT_CUSTOMREQUEST  => "POST",
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => $args,
            CURLOPT_HTTPHEADER     => [
                "content-type: multipart/form-data",
                "key: ". $this->apikey
            ]
        ];
        $this->getData();
    }

    protected $method = "waybill";
}