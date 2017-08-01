<?php

namespace Echowebid\Rajaongkir\App;

class Cost extends Api 
{
    public function __construct($args)
    {
        parent::__construct();
        
        $this->options = [
            CURLOPT_CUSTOMREQUEST  => "POST",
            CURLOPT_POSTFIELDS     => http_build_query($args),
            CURLOPT_HTTPHEADER     => [
                "content-type: application/x-www-form-urlencoded",
                "key: ". $this->apikey
            ]
        ];
        $this->getData();
    }

    protected $method = "cost";
}