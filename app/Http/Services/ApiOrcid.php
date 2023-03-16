<?php
namespace App\Http\Services;

use Exception;
use GuzzleHttp\Client;

class ApiOrcid {

    public $endpoint;
    public $client;

    public function __construct(){

        $this->endpoint = env('ENDPOINT_ORCID', '');
        $this->client = new Client();
    }

    public function get($orc_id){

        try{
            $response = $this->client->request('GET', "{$this->endpoint}/{$orc_id}", [
                'headers' => [
                    'Accept' => "application/json"
                ]
            ]);
            return json_decode($response->getBody(), true);
        }catch(Exception $e){
           return throw new Exception('OrcId  no encontrado');
        }
    }
}

?>