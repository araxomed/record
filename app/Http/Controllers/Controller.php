<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Requests\LoginRequest;
use Http;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function login(Request $request)
    {
        return view('login');
    }

    public function authLogin(LoginRequest $request)
    {
        $email = $request->email;
        $password = $request->password;
        $res = Http::accept('application/json')->post('https://coding-test.rootstack.net/api/auth/login', ['email' => $email, 'password' => $password]);
        if($res->status() == 200){
            $datos = $res->json();
            $token = $datos['access_token'];
            $rauth = Http::withToken($token)->get('https://coding-test.rootstack.net/api/auth/me');
            $user = $rauth->json();
            session(['api_token' => $token]);
            session(['user_data' => $user]);
            return redirect()->route('dashboard');
        }else{
            return redirect()->route('login')->with('login_failed', 'Las credenciales ingresadas no son válidas!');
        }
    }

    public function logout(Request $request)
    {
        $request->session()->forget('api_token');
        return redirect()->route('login');
    }

    public function inicio(Request $request)
    {
        return view('welcome', ['datos' => $datos]);
    }

    public function dashboard(Request $request)
    {
        $token = $request->session()->get('api_token');
        $user = $request->session()->get('user_data');

        $res = Http::withToken($token)->get('https://coding-test.rootstack.net/api/jobs');
        $jobs = $res->json();
        return view('dashboard', compact('user'));
    }

    public function jobs(Request $request)
    {
        $pagina = !empty($request->pagina)? "?page=" . $request->pagina: "";
        $ruta = 'https://coding-test.rootstack.net/api/jobs' . $pagina;
        $token = $request->session()->get('api_token');
        $res = Http::withToken($token)->get($ruta);
        $jobs = $res->json();
        return $jobs;
    }

}
