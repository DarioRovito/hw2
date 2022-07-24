<?php
namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaceController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller {


    protected function register()
    {
        $request = request();
        $propic = file_get_contents($request->file('avatar'));
        if($this->Errors($request) != true) {
            $newUser =  User::create([
            'username' => $request['username'],
            'password' => password_hash($request['password'],PASSWORD_BCRYPT),
            'name' => $request['name'],
            'surname' => $request['surname'],
            'email' => $request['email'],
            'propic' => $propic ?? null,
            ]);
            if ($newUser) {
                Session::put('user_id', $newUser->id);
                Session::put('username', $newUser->username);
                return redirect('home');
            } 
            else {
               return view('register')->with(['error'=>"Ricontrolla i campi inseriti"]);
            }
        }
        else 
          
        return view('register')->with(['error'=>"Ricontrolla i campi inseriti"]);
        
    }

    private function Errors($data) {
        $error=false;
        
        // Controlla che l'username rispetti il pattern specificato o se è già stato utilizzato
        if(!preg_match('/^[a-zA-Z0-9_]{1,15}$/', $data['username'])) {
            $error=true;
        } else {
            $username = User::where('username', $data['username'])->first();
            if ($username !== null) {
                $error=true;
            }
        }
        //verifico password
        if (strlen($data["password"]) < 8) {
            $error=true;
        } 
        //verifico che le 2 password inserite coincidano
        if (strcmp($data["password"], $data["password_confirmation"]) != 0) {
            $error=true;
        }
        //controllo l'email inserita
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $error=true;
        } else {
            $email = User::where('email', $data['email'])->first();
            if ($email !== null) {
                $error=true;
            }
        }

        return $error;
    }

    public function verify_Username($query) {
        $exist = User::where('username', $query)->exists();
        return ['exists' => $exist];
    }

    public function verify_Email($query) {
        $exist = User::where('email', $query)->exists();
        return ['exists' => $exist];
    }

    public function index() {
        return view('register');
    } 

}

?>