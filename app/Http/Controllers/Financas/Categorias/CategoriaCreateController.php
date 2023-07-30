<?php

namespace App\Http\Controllers\Financas\Categorias;

use App\Http\Controllers\Controller;
use App\Models\Category; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CategoriaCreateController extends Controller
{   
    public function viewNewCategoria()
    { 
        return view('newCategoria', ['user' => $this->getClientLooged()]);
    }
    
    public function createCategoria(Request $request)
    {
        $data = $request->only([
             'nome',
             'token'
        ]);

        $validator = Validator::make($data, [
            'nome' => 'required|max:120'
        ]);

        if($validator->fails()) {
            return redirect('/nova_categoria')->withErrors($validator)->withInput();
        }

        if($data['token']) {
            //Validando o token
            $validate = Category::where('user_id', $this->getClientLooged()->id)->where('token', $data['token'])->first();
            
            if($validate) return redirect('/nova_categoria')->with('error', 'Este token já existe');
        }

        $save = new Category();
        $save->user_id = $this->getClientLooged()->id;
        $save->name = $data['nome'];
        $save->token = $data['token'] ? $data['token'] : '';
        $save->save();

        return redirect('/nova_categoria')->with('success', 'Categoria cadastrada com sucesso');
    }




    private function getClientLooged() {
        return Auth::user();
    }
}
