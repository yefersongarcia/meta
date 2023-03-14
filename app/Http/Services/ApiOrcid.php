<?php
namespace App\Http\Services;

use Exception;
use GuzzleHttp\Client;

class ApiOrcid {


    public $endpoint;
    public $client;

    public function __construct(){

        $this->endpoint = env('ENDPOINT_ORCID', 'hhh');
        $this->client = new Client();
    }

    public function get($orc_id){

        try{
            $response = $this->client->request('GET', "{$this->endpoint}/{$orc_id}", [
                'headers' => [
                    'Accept' => "application/json"
                ]
            ]);
            return $jsn = json_decode($response->getBody(), true);
            return $jsn;
    
        }catch(Exception $e){
           return throw new Exception('ORCID  no encontrado');
        }
    }

}

?>