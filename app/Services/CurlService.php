<?php

namespace App\Services;

/**
 * Class CurlService
 * @package App\Service
 */
class CurlService
{
    function callAPI($method, $url, $data, $token = null)
    {
        $curl = curl_init();
        switch ($method){
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);			 					
                break;
            case "DELETE":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE"); 
                if($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));		 					
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }

        // OPTIONS:
        $headers = [
            'Content-Type: application/json',
        ];
        if($token) {
            $headers[] = 'Authorization: Bearer ' . $token;
        }
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

        // EXECUTE:
        $result = curl_exec($curl);
        
        curl_close($curl);

        return $result;
    }
}
