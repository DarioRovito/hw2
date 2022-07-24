<?php
namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Post;
use App\Models\like;
use App\Models\follow;
use App\Models\User;
use App\Models\mongodb;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\UploadedFile;


class PostController extends Controller {
   

  public function post() {

    if(!Session::get('user_id')){
      return view('login');
    }
      
    $array[]=null;
    $i=0;
    $posts=Post::where('user',Session::get('user_id'))
    ->join('users','users.id','=','posts.user')
    ->select('posts.id','posts.content', 'posts.time', 'posts.nlikes', 'posts.ncomments', 'users.surname','users.name', 'users.username', 'users.propic')
    ->orderBy('time', 'desc')
    ->get();

    if($posts){
      foreach($posts as $post){
        $post->propic= 'data:image/jpg;charset=utf8;base64,' . base64_encode($post->propic);
      $post=$post->toArray();
      $array[$i]=$post;
      $like=like::where("user","=", Session::get('user_id'))->where('post','=',$post['id'])->first();
      if($like!='')
      $array[$i]=array_merge($array[$i],array("liked"=>'1'));
      else
      $array[$i]=array_merge($array[$i],array("liked"=>'0'));
      $i++;
  }
  return response()->json($array);
}
else
{
  return 0;
}
}


//post follower
public function postfollow(){

   $user_id =Session::get('user_id');
   $user = Session::get('username');

    if (!isset($user_id))
    return view('login');

  $array[]=null;
  $i=0;
  $arr[]=null;
  
    $posts =Post::wherein('user',function($query) {
    $query->select("idfollower")
     ->from("follow")
     ->where("utente", Session::get('username'))
     ->get();
      })->join('users','users.id','=','posts.user')
    ->select('posts.id','posts.content', 'posts.time', 'posts.nlikes', 'posts.ncomments', 'users.name', 'users.surname', 'users.username', 'users.propic')
    ->orderBy('time', 'desc')
    ->get();
    if($posts){
      foreach($posts as $post){
      $post->propic= 'data:image/jpg;charset=utf8;base64,' . base64_encode($post->propic);
      $post=$post->toArray();
      $array[$i]=$post;
      $like=like::where("user","=", Session::get('user_id'))->where('post','=',$post['id'])->first();
      if($like!='')
      $array[$i]=array_merge($array[$i],array("liked"=>'1'));
      else
      $array[$i]=array_merge($array[$i],array("liked"=>'0'));
      $i++;
  }
if($array){
 $i=0;
  foreach($array as $ar){
    $arr[$i]=$ar;
    $prefer=mongodb::where("user","=", Session::get('user_id'))->where('preferito','=',$ar['username'])->first();
    if($prefer!='')
    $arr[$i]=array_merge($arr[$i],array("prefered"=>'1'));
    else
    $arr[$i]=array_merge($arr[$i],array("prefered"=>'0'));
    $i++;
}

}
return response()->json($arr);

    }
  }
}

?>