<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\follow;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class SearchPeopleController extends Controller
{

    public function index()
    {
        if(!Session::get('user_id')){
            return view('login');
          }
            
        return view('search_people');
     
    }


    public function search_utente(Request $request)
    {
        if(!Session::get('user_id')){
            return view('login');
          }
          
        $array[]=null;
        $i=0;
        $request->validate([
            "utente_cercato"=> "required|string"

        ]);

      
        $user = Session::get('username');

       $users = User::where('username','=',$request->utente_cercato)
       ->select('users.id','users.name','users.surname', 'users.username', 'users.propic')
       ->first();
       if($users){
        $users->propic='data:image/jpg;charset=utf8;base64,'.base64_encode($users ->propic);

        $segui=$users->toArray();
        $array[$i]=$segui;
       $query2=follow::where('utente','=',$user)->where('follower','=',$request->utente_cercato)->first();
       if($query2!=''){

       $array[$i]=array_merge($array[$i],array("following"=>'1'));
       }
       else{
       $array[$i]=array_merge($array[$i],array("following"=>'0'));
       $i++;
       }
       return response()->json($array);
    }
       else{
           return 0;

       }
    }

    public function search_utenti(){

        if(!Session::get('user_id')){
            return view('login');
          }
          
        $array[]=null;
        $i=0;


        $user = Session::get('username');

        $users = User::where('username','<>', $user)
        ->select('users.id','users.name','users.surname', 'users.username', 'users.propic')
        ->get();
        if($users){
        foreach($users as $segui){
            $segui->propic='data:image/jpg;charset=utf8;base64,'.base64_encode($segui->propic);

            $segui=$segui->toArray();
            $array[$i]=$segui;
            $query2=follow::where('utente','=',$user)->where('follower','=',$segui['username'])->first();
            if($query2!='')
            $array[$i]=array_merge($array[$i],array("following"=>'1'));
            else
            $array[$i]=array_merge($array[$i],array("following"=>'0'));
            $i++;
            }
        return response()->json($array);
    
        }
       else
       {
           return 0;
       }
    }


    
public function follow(Request $request){

    $user = Session::get('username');
    $user_id = Session::get('user_id');

    if (!isset($user_id))
    return view('login');

    $request->validate([
        "utenteseguito"=> "required|string"

    ]);

    
    $user2=User::where('username', $request->utenteseguito)->first();
    $segui=new follow;
    $segui->utente= $user;
    $segui->idutente=$user_id;
    $segui->follower=$user2->username;
    $segui->idfollower=$user2->id;

    $segui->save();
    
    if($segui){
        return 1;
    }
    else{
        return 0;

    }

  
}

  public function unfollow(Request $request){

    if(!Session::get('user_id')){
        return view('login');
      }

    $request->validate([
        "utentenonseguito"=> "required|string"

    ]);


    $user = Session::get('username');
    $nonsegui=follow::where('utente',$user)->where('follower', $request->utentenonseguito)->first();

    $nonsegui->delete();
    if($nonsegui){
        return 1;

    }
    else{
        return 0;

    }

  }
}

?>
