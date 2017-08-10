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
    protected $apikey;

    public function __construct()
    {
        $this->endpointapi = config('rajaongkir.endpointapi', 'http://rajaongkir.com/api/starter');
        $this->apikey = config('rajaongkir.apikey', '1q2w3e4r5t6y7u8i9o0p');
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
  
    public function count()
    {
        if ( empty($this->data) )
            $this->data = $this->getData()->data;

        return count($this->data);
    }
  
    public function get()
    {
        return $this->data;
    }


    public function search($args1, $args2 = FALSE)
    {
        if ( $args2 )
            return $this->searchSpecific($args1, $args2);


        $data = ( empty($this->data) ) ? $this->getData()->data : $this->data;
        $temp = [];
        $search = preg_quote($args1, '~');
        foreach($data as $parent)
        {
            if ( is_array( $parent ) )
            {    
                foreach ( $parent as $key => $val )
                {
                    if ( preg_match('~' . $search . '~i', $val) )
                    {
                        array_push($temp, $parent);
                        break;
                    }
                }
            }
        }

        $this->data = $temp;
        return $this;
    }

    protected function searchSpecific($column, $search)
    {
        $data = ( empty($this->data) ) ? $this->getData()->data : $this->data;
        $rowColumn = array_column($data, $column);
        $search = preg_quote($search, '~');
        $result = preg_grep('~' . $search . '~i', $rowColumn);
        $resultKey = array_keys($result);
        $temp = [];
        foreach($data as $key => $val)
        {
            if (in_array($key, $resultKey))
            {
                array_push($temp, $val);
            }
        }
        $this->data = $temp;
        return $this;
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
                "key: ". $this->apikey
            ],
        ];
        
        if ( $this->options && is_array($this->options) )
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
