<?php

namespace App\Http\Controllers;

use App\Http\Services\ApiOrcid;
use App\Http\Resources\UserResource;        // return view('index',compact('datos'));
use App\Models\Keyword;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
   
    public function index()
    {
        $persons = User::simplePaginate(2);
        $persons->appends(request()->query());
        $pagination = $persons->links()->toHtml();
        return response()->json([
            'status' => 'Exito',
            'data' => UserResource::collection($persons),
            'pagination' => $pagination
        ]);
    }

    public function create($orcid)
    {
        
    
    }

    public function store($orc_id)
    {
        
        try{
            $apiOrcid = new ApiOrcid();
            $jsn = $apiOrcid->get($orc_id);
        }catch(Exception $e){
            return  response()->json(['status' => 'Error', 'message' => $e->getMessage()]);
        }

        $person = new User();
        $person->orcid = $jsn['orcid-identifier']['path'];
        $person->name = $jsn['person']['name']['given-names']['value'];
        $person->lastName = $jsn['person']['name']['family-name']['value'];
        $person->email = isset($jsn['person']['emails']['email'][0]['email']) ? $jsn['person']['emails']['email'][0]['email'] : null ;
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
    
    public function show($orc_id)
    {
        $person = User::search($orc_id)->first();
        return response()->json(['status' => 'Exito','data' => new UserResource($person)]);
    }

    public function edit(User $user)
    {
        
    }

    public function update(Request $request, User $user)
    {
        
    }

    public function destroy($orc_id)
    {
        $person = User::search($orc_id);
        $person->delete();
        return response()->json(['status'=>'Exito','message'=>'elimin']);
    }
}
