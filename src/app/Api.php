<?php

namespace Echowebid\Rajaongkir\App;

use Exception;

abstract class Api 
{
    protected $method;
    protected $parameter;
    protected $data;
    protected $endpointapi;
    protected $options = [];
    protected $apiKey;

    public function __construct()
    {
        $this->endpointapi = config('rajaongkir.endpointapi', 'http://rajaongkir.com/api/starter');
        $this->apiKey = config('rajaongkir.apikey', '1q2w3e4r5t6y7u8i9o0p');
    }

    public function all()
    {
        return $this->getData()->data;
    }

    public function find($id)
    {
        $this->parameter = "?id=" . $id;
        return $this->getData()->data;
    }
  
    public function get()
    {
        return $this->data;
    }
  
    public function count()
    {
        if ( empty($this->data) )
            $this->data = $this->getData()->data;

        return count($this->data);
    }
   
    protected function getData()
    {
        $curl = curl_init();

        $curl_options = [
            CURLOPT_URL                => $this->endpointapi . "/" . $this->method . $this->parameter,
            CURLOPT_RETURNTRANSFER     => true,
            CURLOPT_ENCODING           => "",
            CURLOPT_MAXREDIRS          => 10,
            CURLOPT_TIMEOUT            => 30,
            CURLOPT_HTTP_VERSION       => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST      => "GET",
            CURLOPT_HTTPHEADER         => [
                "key: ". $this->apiKey
            ],
        ];
        
        if ( $this->options && in_array($this->options) )
        {
            foreach( $this->options as $key => $val)
            {
                $curl_options[$key] = $val;
            }
        }
        
        curl_setopt_array($curl, $curl_options);
        $response = curl_exec($curl);
        $curl_error = curl_error($curl);
        curl_close($curl);

        if ($curl_error) 
        {
            throw new Exception($curl_error, 1);    
        } else 
        {
            $data = json_decode($response, true);
            $code = $data['rajaongkir']['status']['code'];
            if ($code == 400)
            {
                throw new Exception($data['rajaongkir']['status']['description'], 1);        
            } else
            {
                $this->data = $data['rajaongkir']['results'];
                return $this;
            }
        }
    }
}