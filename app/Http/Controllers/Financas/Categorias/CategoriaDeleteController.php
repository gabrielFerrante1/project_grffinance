<?php

namespace App\Http\Controllers\Financas\Categorias;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Financa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriaDeleteController extends Controller
{
    public function delCategoria($id)
    {
        $count = Financa::where('user_id', Auth::id())->where('category_id', $id)->count();
    
        if($count === 0) {
            Category::where('user_id', Auth::id())->where('id', $id)->delete();

            return redirect()->route('categorias')->with('success', 'Categoria deletada com sucesso!');
        } else {
            return redirect()->route('categorias');
        }
    }
}
