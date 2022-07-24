<?php
namespace App\Http\Controllers;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\follow;
use App\Models\User;
use App\Models\like;
use Illuminate\Support\Facades\Session;


class LikeController extends Controller
{


    public function post_like(){
        
        $user=Session::get('user_id');

        if (!isset($user))
        return view('login');

        $request=request();

        $like=like::where('post','=',$request->postid)->where('user','=',$user)->first();
        $like=new like;
        $like->post=$request->postid;
        $like->user=$user;
  
        $like->save();

        $liked=Post::where('id','=',$request->postid)->first();
        return $liked;
   
   
       }


    public function post_dont_like(){

        $user=Session::get('user_id');

        if (!isset($user))
        return view('login');


     $request=request();

     $nonlike=like::where('user','=',$user)->where('post','=',$request->nonlike_post);
     $nonlike->delete();

     $liked=Post::where('id','=',$request->nonlike_post)->first();
     if(!$liked){
    return 0;
    }else{
     return $liked;
      }
    }

    public function show(){
        if(!Session::get('user_id')){
            return view('login');
          }
        
        $request=request();
        $user=Session::get('user_id');
        $likes=User::select('users.name','users.username','users.propic')
        ->join('likes', 'likes.user','=','users.id')->where('post','=',$request->like_post)->get();  
        foreach($likes as $like){
            $like->propic= 'data:image/jpg;charset=utf8;base64,' . base64_encode($like->propic);
        }
     
        if($likes){
            return response()->json($likes);
        }
        else{
            return 0;
        }
    }
    
    
    }    











