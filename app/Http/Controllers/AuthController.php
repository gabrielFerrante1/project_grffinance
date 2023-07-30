<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        return view('auth.login');
    }

    public function signup(Request $request)
    {
        return view('auth.register');
    }

    public function creteUserOfIntegration(Request $request)
    {
        $data = $request->only([
            'email',
            'nome',
            'senha'
        ]);

        $validator = Validator::make($data, [
            'email' => 'required|email|unique:users',
            'nome' => 'required',
            'senha' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('signup')
                ->withErrors($validator)
                ->withInput();
        }

        //Criando usuário
        $save = new User();
        $save->name = $data['nome'];
        $save->email = $data['email'];
        $save->password = Hash::make($data['senha']);
        $save->save();

        Auth::loginUsingId($save->id);

        return redirect()->intended('dashboard');
    }

    public function loginIntegration(Request $request)
    {
        $credentials = $request->only([
            'email',
            'password'
        ]);

        if (!$credentials['email'] || !$credentials['password']) {
            return redirect()->route('login');
        }

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('dashboard');
        } else {
            return redirect()->route('login')->with('password', 'Senha inválida')->withInput();
        }
    }
    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}
