<?php

namespace App\Http\Controllers\Receitas;

use App\Http\Controllers\Controller;
use App\Models\Entrada;
use App\Models\Receita;
use App\Models\ReceitaConta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReceitaController extends Controller
{
    public function viewAllContas(Request $request)
    {
        $data = $request->only([
            'titulo',
            'dia',
            'mes',
            'ano'
        ]);

        if (!$data) $data = ['titulo' => '', 'dia' => '', 'mes' => '', 'ano' => ''];

        $arrayFilter = [];
        $filter = [];

        $day = $request->input('dia', '');
        $month = $request->input('mes', '');
        $year = $request->input('ano', 'all');

        if ($data['titulo'] && $data['titulo'] != 'all') {
            array_push($arrayFilter, ['name', 'LIKE', '%' . $data['titulo'] . '%']);
        }

        if ($day != 'all' &&  $day) {
            array_push($filter, ['day', $day]);
        }

        if ($month != 'all' &&  $month) {
            array_push($filter, ['month', $month]);
        }

        if ($year != 'all' &&  $year) {
            array_push($filter, ['year', $year]);
        }

        $query = ReceitaConta::where('user_id', Auth::id())
            ->where($arrayFilter) 
            ->paginate(10);

        foreach ($query as $key => $value) {
            $query[$key]['count_receitas'] = Receita::where('receita_conta_id', $value->id)->where($filter)->count();
            $query[$key]['sum_receitas'] = Receita::where('receita_conta_id', $value->id)->where($filter)->sum('value');
        }

        return view('contas', [
            'user' => Auth::user(),
            'list' => $query,
            'dados' => $data
        ]);
    }

    public function viewAllReceitas(Request $request)
    {
        $user = Auth::user();

        $data = $request->only([
            'titulo',
            'conta',
            'dia',
            'mes',
            'ano'
        ]);

        if (!$data) {
            $data = ['titulo' => '', 'conta' => '', 'dia' => '', 'mes' => '', 'ano' => ''];
        }

        $title = $request->input('titulo', '');
        $conta = $request->input('conta', '');
        $day = $request->input('dia', '');
        $month = $request->input('mes', '');
        $year = $request->input('ano', 'all');

        $filter = [];

        if ($conta != 'all' &&  $conta) {
            array_push($filter, ['receita_conta_id', $conta]);
        }

        if ($day != 'all' &&  $day) {
            array_push($filter, ['day', $day]);
        }

        if ($month != 'all' &&  $month) {
            array_push($filter, ['month', $month]);
        }

        if ($year != 'all' &&  $year) {
            array_push($filter, ['year', $year]);
        }

        if ($title != 'all' &&  $title) {
            array_push($filter, ['title', 'LIKE', '%' . $title . '%']);
        }


        $query = Receita::where('user_id', Auth::id()) 
            ->where($filter)
            ->orderBy('month', 'asc') 
            ->paginate(50);

        foreach ($query as $k => $v) { 
            $query[$k]['conta'] = ReceitaConta::select('name')->find($v->receita_conta_id)->name;
        }

        //Media
        $query_2 = Receita::where('user_id', Auth::id()) 
            ->where($filter)
            ->avg('value');
 
        //Soma
        $query_3 = Receita::where('user_id', Auth::id()) 
            ->where($filter)
            ->sum('value');


        $query_2 = number_format($query_2, 2, ',', '.');
        $query_3 = number_format($query_3, 2, ',', '.');

        //Pegando todas as contas do usuário
        $query2 = ReceitaConta::select('id', 'name')->where('user_id', $user->id)->get();


        return view('receitas', [
            'fin' => $query,
            'fin2' => $query2,
            'dados' => $data,
            'user' => $user,
            'm' => $query_2,
            't' => $query_3
        ]);

       
    }
}
