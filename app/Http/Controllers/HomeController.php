<?php
namespace App\Http\Controllers;
use Illuminate\Routing\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Session;


class HomeController extends Controller {

    public function index() {
        $session_id = Session::get('user_id');
        $user = User::find($session_id);
        if (!isset($user))
            return view('login');
        
        return view("home")->with("user", $user);
    }
}





?>