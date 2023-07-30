<?php

namespace App\Http\Controllers\Financas;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Financa;
use App\Models\FinancaFixa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FinancaController extends Controller
{
    public function viewDashboard(Request $request)
    {
        $user = auth()->user();

        $ano = $request->input('ano', date('Y'));
        $month = $request->input('mes', date('m'));

        //Gráfico de linha
        for ($i = 0; $i <= 12; $i++) {
            $query_line = DB::select('SELECT AVG(price) as total FROM financas WHERE trash = 0 AND user_id = :id AND month = :m AND year LIKE :ano AND status = 1', ['id' => $user->id, 'm' => $i, 'ano' => '%' . $ano . '%']);

            $array[$i] = [$query_line];
        }

        //Gráfico de linha pendencias
        for ($i = 0; $i <= 12; $i++) {
            $query_line_2 = DB::select('SELECT AVG(price) as total FROM financas WHERE  trash = 0 AND user_id = :id AND month = :m AND year LIKE :ano AND status = 0', ['id' => $user->id, 'm' => $i, 'ano' => '%' . $ano . '%']);

            $array_pendentions[$i] = [$query_line_2];
        }

        //Cards
        $despesas_pendentes = DB::select("SELECT price FROM financas WHERE  trash = 0 AND user_id = :id AND status = 0 AND month = :mes AND year = :ano", ['id' => $user->id, 'mes' => $month, 'ano' => $ano]);
        $despesas_pagas = DB::select("SELECT price FROM financas WHERE  trash = 0 AND user_id = :id AND status = 1 AND month = :mes  AND year = :ano", ['id' => $user->id, 'mes' => $month, 'ano' => $ano]);

        //Verificando as 5 categorias mais gastas
        $query_4 = DB::select('SELECT 
        c.name, f.category_id, SUM(f.price) AS total  
        FROM financas  as f
        LEFT JOIN categories as c on(f.category_id = c.id)
        WHERE f.trash = 0 AND f.user_id = :id AND f.status = 1 AND f.month = :mes AND f.year = :ano
        GROUP BY category_id 
        ORDER BY total DESC
        LIMIT 5', [
            'id' => $user->id,
            'mes' => $month,
            'ano' => $ano
        ]);

        //Total de todas as contas 
        $count_all_categorys = Financa::where('user_id', $user->id)->where('trash', 0)->where('status', 1)->where('month', $month)->where('year', $ano)->sum('price');

        //Categoria com maior gasto recuperando o valor
        if (count($query_4) > 0) {
            $category_king = $query_4[0];
        } else {
            $category_king = ['erro' => 'sim'];
        }

        return view('index', [
            'user' => $user,
            'line_graphi' => $array,
            'line_graphi_pendents' => $array_pendentions,
            'mes' => $month,
            'ano' => $ano,
            'count_despesas_pendentes' => count($despesas_pendentes),
            'count_despesas_pagas' => count($despesas_pagas),
            'categorys_ranking' => $query_4,
            'category_king' => $category_king,
            'count_all_categorys' => $count_all_categorys
        ]);
    }


    public function viewAllFinancas(Request $request)
    {
        $user = Auth::user();

        $data = $request->only([
            'titulo',
            'categoria',
            'mes',
            'ano'
        ]);

        if (!$data) {
            $data = ['titulo' => '', 'categoria' => '', 'mes' => '', 'ano' => ''];
        }

        $title = $request->input('titulo', '');
        $category = $request->input('categoria', '');
        $month = $request->input('mes', '');
        $year = $request->input('ano', 'all');

        $filter = [];

        if ($category != 'all' &&  $category) {
            array_push($filter, ['category_id', $category]);
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


        $query = Financa::where('user_id', Auth::id())
            ->where('trash', 0)
            ->where('status', 1)
            ->where($filter)
            ->orderBy('month', 'asc')
            ->orderBy('day', 'asc')
            ->paginate(50);

        foreach ($query as $k => $v) {
            $query[$k]['category'] = Category::select('name')->find($v->category_id)->name;
        }

        //Media
        $query_2 =  Financa::where('user_id', Auth::id())
            ->where('trash', 0)
            ->where('status', 1)
            ->where($filter)
            ->avg('price');


        //Soma
        $query_3 = Financa::where('user_id', Auth::id())
            ->where('trash', 0)
            ->where('status', 1)
            ->where($filter)
            ->sum('price');


        $query_2 = number_format($query_2, 2, ',', '.');
        $query_3 = number_format($query_3, 2, ',', '.');

        //PEgandos todas as categorias do usuário
        $query2 = Category::select('id', 'name')->where('user_id', $user->id)->get();

        return view('despesas', [
            'fin' => $query,
            'fin2' => $query2,
            'dados' => $data,
            'user' => $user,
            'm' => $query_2,
            't' => $query_3
        ]);
    }


    public function viewPendentesFinancas(Request $request)
    {
        $user = Auth::user();

        $data = $request->only([
            'titulo',
            'categoria',
            'mes',
            'ano'
        ]);

        if (!$data) {
            $data = ['titulo' => '', 'categoria' => '', 'mes' => '', 'ano' => ''];
        }

        $title = $request->input('titulo', '');
        $category = $request->input('categoria', '');
        $month = $request->input('mes', '');
        $year = $request->input('ano', 'all');

        $filter = [];

        if ($category != 'all' &&  $category) {
            array_push($filter, ['category_id', $category]);
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


        $query = Financa::where('user_id', Auth::id())
            ->where('trash', 0)
            ->where('status', 0)
            ->where($filter)
            ->orderBy('month', 'asc')
            ->orderBy('day', 'asc')
            ->paginate(50) ;

        foreach ($query as $k => $v) {
            $query[$k]['category'] = Category::select('name')->find($v->category_id)->name;
        }

        //Media
        $query_2 =  Financa::where('user_id', Auth::id())
            ->where('trash', 0)
            ->where('status', 0)
            ->where($filter)
            ->avg('price');


        //Soma
        $query_3 = Financa::where('user_id', Auth::id())
            ->where('trash', 0)
            ->where('status', 0)
            ->where($filter)
            ->sum('price');


        $query_2 = number_format($query_2, 2, ',', '.');
        $query_3 = number_format($query_3, 2, ',', '.');

        //Pegando todas as categorias do usuário
        $query2 = Category::select('id', 'name')->where('user_id', $user->id)->get();

        return view('pendentes', [
            'fin' => $query,
            'fin2' => $query2,
            'dados' => $data,
            'user' => $user,
            'm' => $query_2,
            't' => $query_3
        ]);
    }

    public function viewAllFinancasFixas(Request $request)
    {
        $user = Auth::user();

        $data = $request->only([
            'titulo',
            'categoria',
            'ordena'
        ]);

        if (!$data) {
            $data = ['titulo' => '', 'categoria' => ''];
        }

        $title = $request->input('titulo', '');
        $category = $request->input('categoria', ''); 
        $order = $request->input('ordena', '');

        $filter = [];

        if ($category != 'all' &&  $category) {
            array_push($filter, ['category_id', $category]);
        } 

        if ($title != 'all' &&  $title) {
            array_push($filter, ['title', 'LIKE', '%' . $title . '%']);
        }

        if ($order == 'ia') {
            $orderDate = 'asc';
        } else {
            $orderDate = 'desc';
        }

        $query = FinancaFixa::where('user_id', Auth::id())
            ->where($filter) 
            ->orderBy('data', $orderDate)
            ->paginate(50);

        foreach ($query as $k => $v) {
            $query[$k]['category'] = Category::select('name')->find($v->category_id)->name;
        }
 
        //Pegando todas as categorias do usuário
        $query2 = Category::select('id', 'name')->where('user_id', $user->id)->get();

        return view('financasFixas', [
            'fin' => $query,
            'fin2' => $query2,
            'dados' => $data,
            'user' => $user, 
        ]);
    }
}
