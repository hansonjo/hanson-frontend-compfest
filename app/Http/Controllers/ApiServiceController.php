<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Guzzle\Http\Exception\ClientErrorResponseException;

class ApiServiceController extends Controller
{
    public static function postApi($table, $api_url, $method, $params = null, $token = null){
        $client = new Client();
        $url = api_domain(). '/' . $table.'/'.$api_url;
        if($params == null) $params = [];
        try{
            $response = $client->request($method, $url, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'auth-token' => $token,
                ],
                'json' => $params,
            ]);
        }catch(\Exception $e){
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            return ['error' => $responseBodyAsString];
        }
        $res = json_decode($response->getBody()->getContents());
        return $res;
    }
}
