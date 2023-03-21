<?php

namespace App\Http\Controllers;

use App\Http\Services\ApiOrcid;
use App\Http\Resources\UserResource;
use App\Models\Keyword;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;

class UserController extends Controller
{

    public function indexView()
    {
        $persons = UserResource::collection(User::simplepaginate(2));
        return view('index', compact('persons'));
    }

    public function index()
    {
        $persons = UserResource::collection(User::simplepaginate(2));
        return response()->json(['status' => 'Exito', 'message' => '', 'data' => $persons]);
    }

    public function store($orc_id)
    {
        try {
            $apiOrcid = new ApiOrcid();
            $data = $apiOrcid->get($orc_id);
        } catch (Exception $e) {
            return  response()->json(['status' => 'Error', 'message' => $e->getMessage()]);
        }

        try {
            $person = new User();
            $person->orc_id = $data['orcid-identifier']['path'];
            $person->name = $data['person']['name']['given-names']['value'];
            $person->lastName = $data['person']['name']['family-name']['value'];
            $person->email = isset($data['person']['emails']['email'][0]['email']) ? $data['person']['emails']['email'][0]['email'] : null;
            $person->save();
            foreach ($data['person']['keywords']['keyword'] as $keyword) {
                $contents[] = $keyword['content'];
                $key = new Keyword();
                $orc_id = $person->orc_id;
                $key->orc_id = $orc_id;
                $key->user_id = $person->id;
                $key->cont = $keyword['content'];
                $key->save();
            }

            return response()->json(['status' => 'success', 'message' => 'successfully created']);
        } catch (\Illuminate\Database\QueryException $a) {

            if ($a->errorInfo[1] == 1062) {
                return response()->json(['status' => 'Error', 'message' => 'data is already registered']);
            }

            return response()->json(['status' => 'Error', 'message' => 'Ha ocurrido un error al intentar crear el usuario.']);
        }
    }

    public function show($orc_id)
    {
        $person = User::search($orc_id)->first();
        return response()->json(['status' => 'Exito', 'data' => new UserResource($person)]);
    }

    public function edit(User $user)
    {
    }

    public function update(Request $request, User $user)
    {
    }

    public function destroy($orc_id)
    {
        $person = User::where('orc_id', $orc_id)->first();
        $person->delete();
        return response()->json(['status' => 'Exito', 'message' => 'successfully deleted
        ']);
    }
}
