<?php
namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\like;
use App\Models\mongodb;
use App\Models\User;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class PreferitiController extends Controller{

public function newprefer(){

    if(!Session::get('user_id')){
      return view('login');
    }
      
        $request = request();

        $newprefer = new mongodb(['preferito' =>   $request->username,
                                    'user' => Session::get('user_id')]);
        $newprefer->save();
   
}

public function deleteprefer()
  {

    $user_id =Session::get('user_id');

    if (!isset($user_id))
    return view('login');

      $request = request();
      $user_id = Session::get('user_id');

       $deleteprefer=mongodb::where('user', $user_id)->where('preferito', $request->username);
       $deleteprefer->delete();
    }



public function viewprefers(){

  $user_id =Session::get('user_id');

  if (!isset($user_id))
  return view('login');

  $prefs = mongodb::where('user', $user_id)->get();
return $prefs;
}



}

?>