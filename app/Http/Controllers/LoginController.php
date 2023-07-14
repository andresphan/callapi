<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    function showLoginForm() {
        return view('auth.login');
    }
    function login() {
        $email = request()->input("email");
        $password = request()->input("password");
        $data = [
            "email" => $email, 
            "password" => $password
            
        ];
        $response = Http::asForm()->post('http://api.laravel.qlsv.com/api/login',$data);
        if ($response->ok()) {//ok
            $result = $response->json();
            $token = $result["success"]["token"];
            $name = $result["success"]["name"];
            session()->put(["token" => $token, "name" => $name]);
            return redirect()->route("show");

        }
        else {
            // echo $response->body();
            echo "Lỗi rồi";
           
        }

        
    }

    function logout(Request $request) {
        session()->flush();
        return redirect()->route("login");
    }
    
}
