<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function index(Request $request){
        $user = Auth::user();
        if(!$user){
            return redirect()->route('auth.login');
        }
        $path = $user->role.'.index';
        return redirect()->route($path);
    }
    public function password_hash(Request $request){
        echo password_hash($request->query('text'),PASSWORD_DEFAULT);
    }
}
