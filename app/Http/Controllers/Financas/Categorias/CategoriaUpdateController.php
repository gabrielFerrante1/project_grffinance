<?php

namespace App\Http\Controllers\Financas\Categorias;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CategoriaUpdateController extends Controller
{
    public function viewUpdateCategoria($id) 
    {
        $check = Category::where('user_id', $this->getClientLooged()->id)->where('id', $id)->first();

        if(!$check) return abort(404);

        return view('editCategoria', [
            'user' => $this->getClientLooged(),
            'data' => $check
        ]);
    }

    public function updateCategoria($id, Request $request) {
        $check = Category::where('user_id', $this->getClientLooged()->id)->where('id', $id)->first();

        if(!$check) return abort(404);

        $data = $request->only([
            'nome',
            'token'
       ]);

       $validator = Validator::make($data, [
           'nome' => 'required|max:120'
       ]);

       if($validator->fails()) {
           return redirect('/categoria/edit/'.$id)->withErrors($validator)->withInput();
       }

       if($data['token'] != $check->token) {
            //Validando o token
            $validate = Category::where('user_id', $this->getClientLooged()->id)->where('token', $data['token'])->first();
            
            if($validate) return redirect('/categoria/edit/'.$id)->with('error', 'Este token já existe');
        }

        Category::where('id', $id)->update([
            'name' => $data['nome'],
            'token' => $data['token'] != '' ? $data['token'] : '' 
        ]);

        return redirect()->route('categorias')->with('success', 'Categoria alterada com sucesso!');
    }

    private function getClientLooged() {
        return Auth::user();
    }
}
