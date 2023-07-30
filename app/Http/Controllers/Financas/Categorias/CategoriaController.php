<?php

namespace App\Http\Controllers\Financas\Categorias;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Financa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriaController extends Controller
{
    public function viewAllCategorias(Request $request)
    {
        $data = $request->only([
            'nome',
            'token',
            'data'
        ]);

        if(!$data) { $data = ['nome' => '', 'token' => '', 'data' => 'desc']; }

        $query = Category::where('user_id', $this->getClientLooged()->id)
        ->where('name', 'LIKE', '%'.$data['nome'].'%')
        ->where('token', 'LIKE', '%'.$data['token'].'%')
        ->orderBy('date', $data['data'])
        ->paginate(10);

        foreach($query as $k => $v) {
            $count_for_each_category = Financa::where('user_id', $this->getClientLooged()->id)->where('category_id', $v->id)->count();

            $query[$k]['count_financas'] = $count_for_each_category;
        }

        return view('categorias', [
            'query' => $query,
            'user' => $this->getClientLooged(),
            'dados' => $data
        ]);
    }

    private function getClientLooged() {
        return Auth::user();
    }
}
