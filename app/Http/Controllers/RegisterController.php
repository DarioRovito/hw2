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
        if($this->countErrors($request) === 0) {
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

    private function countErrors($data) {
        $error = array();
        
        # USERNAME
        // Controlla che l'username rispetti il pattern specificato o se è già stato utilizzato
        if(!preg_match('/^[a-zA-Z0-9_]{1,15}$/', $data['username'])) {
            $error[] = "Username non valido";
        } else {
            $username = User::where('username', $data['username'])->first();
            if ($username !== null) {
                $error[] = "Username già utilizzato";
            }
        }
        //PASSWORD
        if (strlen($data["password"]) < 8) {
            $error[] = "Caratteri password insufficienti";
        } 
        // CONFERMA PASSWORD
        if (strcmp($data["password"], $data["password_confirmation"]) != 0) {
            $error[] = "Le password non coincidono";
        }
        //CONTROLLA EMAIL
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $error[] = "Email non valida";
        } else {
            $email = User::where('email', $data['email'])->first();
            if ($email !== null) {
                $error[] = "Email già utilizzata";
            }
        }

        return count($error);
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