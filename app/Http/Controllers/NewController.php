<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Session;


class NewController extends Controller
{
    public function index() {
        if(!Session::get('user_id')){
            return redirect('login');
          }
        $user = User::find(session('user_id'))->first();
        return view('New')->with('user', $user);
    }

   
    // RICERCA

    public function search($type, $query = null)
    {
        if(!Session::get('user_id')){
            return redirect('login');
          }
        switch($type) {
            case 'giphy': return $this->searchGiphy($query);
            case 'spotify': return $this->searchSpotify($query);
            case 'sports': return $this->searchSport($query);
            default: break;
        }
    } 

    
    function searchGiphy($query) {
        $json = Http::get('http://api.giphy.com/v1/gifs/search', [
            'q' => $query,
            'api_key' => env('GIPHY_APIKEY'),
            'limit' => 30,
        ]);
        if ($json->failed()) abort(500);
    
        $newJson = array();
        for ($i = 0; $i < count($json['data']); $i++) {
            $newJson[] = array(
                'id' => $json['data'][$i]['id'], 
                'thumbnail' => $json['data'][$i]['images']['preview_gif']['url'], 
                'height' => $json['data'][$i]['images']['preview_gif']['height'],
                'width' => $json['data'][$i]['images']['preview_gif']['width']
            );
        }
    
        return response()->json($newJson);
    }

    function searchSpotify($query) {   
        $token = Http::asForm()->withHeaders([
            'Authorization' => 'Basic '.base64_encode(env('SPOTIFY_CLIENT_ID').':'.env('SPOTIFY_CLIENT_SECRET')),
        ])->post('https://accounts.spotify.com/api/token', [
            'grant_type' => 'client_credentials',
        ]);
        if ($token->failed()) abort(500);

        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.$token['access_token']
        ])->get('https://api.spotify.com/v1/search', [
            'type' => 'track',
            'q' => $query
        ]);
        if($response->failed()) abort(500);

        return $response->body();
    }

    function searchSport($query) {
        
        $json = Http::get('https://sports.api.decathlon.com/sports/search/'.$query.'?source=popular&coordinates=2.3333,48.8667');
        if ($json->failed()) abort(500);
    
        return $json;
    }

    
    // CREAZIONE

    public function new(Request $request)
    {

        if(!Session::get('user_id')){
            return redirect('login');
          }
          
        $request->validate([
            'type' => ['required', 'string', Rule::in(['giphy', 'spotify','sports'])],
        ]);

        switch($request->type) {
            case 'giphy': $content = $this->createGiphy($request); break;
            case 'spotify': $content = $this->createSpotify($request); break;
            case 'sports': $content = $this->createSports($request); break;

            default: abort(500);
        }


if ($content == null) 
return response()->json(['ok'=> false]); 

$user = User::find(session('user_id'));
$user->posts()->create([
    'user'=>session('user_id'),
    'content' => $content,
]);

return response()->json(['ok'=> true]);

    }


function createGiphy(Request $request) {
    $json = Http::get('http://api.giphy.com/v1/gifs/'.$request->id, [
        'api_key' => env('GIPHY_APIKEY'),
    ]);
    if (!$json->successful()) return null;

    return [
        'type' => $request->type,
        'text' => $request->text,
        'id' => $request->id,
        'url' => $json['data']['images']['original']['url'],
    ];
}



function createSpotify(Request $request) {
    $token = Http::asForm()->withHeaders([
        'Authorization' => 'Basic '.base64_encode(env('SPOTIFY_CLIENT_ID').':'.env('SPOTIFY_CLIENT_SECRET')),
    ])->post('https://accounts.spotify.com/api/token', [
        'grant_type' => 'client_credentials',
    ]);
    if ($token->failed()) return null;

    $response = Http::withHeaders([
        'Authorization' => 'Bearer '.$token['access_token']
    ])->get('https://api.spotify.com/v1/tracks/'.$request->id);
    if(!$response->successful()) return null;

    return [
        'type' => $request->type,
        'text' => $request->text,
        'id' => $request->id,
        'url' => $response['album']['images']['0']['url'],

    ];
}



function createSports(Request $request) {
    $json = Http::get('https://sports.api.decathlon.com/sports/'.$request->id);
    if (!$json->successful()) return null;

    return [
        'type' => $request->type,
        'text' => $request->text,
        'id' => $request->id,
        'url' =>  $json['data']['relationships']['images']['data']['0']['url'],
    ];
}



}

?>