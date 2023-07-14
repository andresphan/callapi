<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware("ensure.token.isvalid");
    }
    function show() {
        $token = session()->get("token");
        $response = Http::withToken($token)->get('http://api.laravel.qlsv.com/api/user');
        if ($response->ok()) {
            var_dump($response->json());
        }
        else {
            echo "lỗi rồi";
        }
    }
    
}
