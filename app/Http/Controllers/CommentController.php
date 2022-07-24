<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        if(!Session::get('user_id')){
            return view('login');
          }

        $request->validate([
            'id' => ['required', 'integer', 'exists:posts'],
            'comment' => ['required', 'string', 'max:256']
        ]);

        $comment = Comment::create([
        
            'user' => Session::get('user_id'),
            'post' => $request->id,
            'text' =>$request->comment,
           
        ]);

        $comment->save();

        $comments=Comment::where('post',$request->id)
        ->join('users','users.id','=','comments.user')
        ->select('users.username','users.propic', 'comments.time', 'comments.text')
        ->get();
        foreach($comments as $comment){
            $comment->propic= 'data:image/jpg;charset=utf8;base64,' . base64_encode($comment->propic);
        }

        return $comments;
        
    }

    public function show($id)
    {
        
        if(!Session::get('user_id')){
                return view('login');
        }
      
        $comments=Comment::where('post',$id)
        ->join('users','users.id','=','comments.user')
        ->select('users.username','users.propic', 'comments.time', 'comments.text')
        ->get();
        foreach($comments as $comment){
            $comment->propic= 'data:image/jpg;charset=utf8;base64,' . base64_encode($comment->propic);
        }
        
        return $comments;
         
    }

   
}
