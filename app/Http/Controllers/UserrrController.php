<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\Keyword;
use App\Models\User;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $persons = User::paginate(2);
        // return view('index',compact('datos'));
        return response()->json(['status' => 'Exito','data' => UserResource::collection($persons)]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $client = new Client();
            $response = $client->request('GET', "https://pub.orcid.org/v3.0/{$orcid}", [
                'headers' => [
                    'Accept' => "application/json"
                ]
            ]);
            $jsn = json_decode($response->getBody(), true);
        } catch (Exception $e) {
            return  response()->json(['status' => 'Error', 'message' => 'ORCID  no encontrado']);
        }


        // return $jsn;
        //$keyword = $jsn['person']['keywords']['keyword']['content'];
        $person = new User();
        $person->orcid = $jsn['orcid-identifier']['path'];
        $person->name = $jsn['person']['name']['given-names']['value'];
        $person->lastName = $jsn['person']['name']['family-name']['value'];
        $person->email = isset($jsn['person']['emails']['email'][0]['email']) ? $jsn['person']['emails']['email'][0]['email'] : null;
        $person->save();

        foreach ($jsn['person']['keywords']['keyword'] as $keyword) {
            $contents[] = $keyword['content'];
            $key = new Keyword();
            $orcid = $person->orcid;
            $key->orcid = $orcid;
            $key->user_id = $person->id;
            $key->cont = $keyword['content'];
            $key->save();
        }
        return response()->json(['status' => 'Exito', 'message' => '']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
