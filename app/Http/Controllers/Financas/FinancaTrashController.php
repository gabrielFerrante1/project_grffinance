<?php

namespace App\Http\Controllers\Financas;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Financa;
use App\Models\FinancaFixa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FinancaTrashController extends Controller
{
    public function viewFinancasInTrash(Request $request) {
        $user = Auth::user();

        $data = $request->only([
            'titulo',
            'categoria',
            'mes',
            'ano',
            'status'
        ]);

        if(!$data) {
            $data = ['titulo' => '', 'categoria' => '', 'mes' => '', 'ano' => '', 'status' => ''];
        }

        $title = $request->input('titulo', '');
        $category = $request->input('categoria', '');
        $month = $request->input('mes', '');
        $year = $request->input('ano', 'all');
        $status = $request->input('status', '');

        if($status == 'all') {
            $status = '';
        } else  {
            if($status == 'pe') {
                $status = 'AND status = 0';
            } else if($status == 'pa') {
                $status = 'AND status = 1';
            }
            
        }

        if($category == 'all' || !$category) {
            $category = 'AND category_id >= 0';
        } else {
           $category = 'AND category_id = '.$category;
        }


        if($month == 'all' || !$month) {
            $month_bug = 'AND month BETWEEN  1 and 12';
        } else {
            $month_bug = 'AND month = '.$month;
        }

        if($year == 'all') {
            $year_bug = 'AND year BETWEEN  2021 and '.date('Y');
        } else {
            $year_bug = 'AND year = '.$year;
        }
 
        $query = DB::select("SELECT f.id, f.title, f.price, f.day, f.month, f.year, f.description, f.data, f.status, c.name as category
            FROM 
                financas as f
                LEFT JOIN categories as c on (f.category_id = c.id)
            WHERE 
                f.title LIKE :title AND 
                f.user_id = :id AND  
                f.trash = 1

                $month_bug

                $year_bug

                $category 

                $status

                ORDER BY day ASC
        ",  [
        'title' => '%'.$title.'%', 
        'id' => $user->id
        ]); 

        //PEgandos todas as categorias do usuário
        $query2 = Category::select('id', 'name')->where('user_id', $user->id)->get();

        return view('trash', [
            'fin' => $query,
            'fin2' => $query2,
            'dados' => $data,
            'user' => $user 
        ]); 
    }

    public function toogleFinancaTrash(Request $request, Int $id) {
        $user = Auth::user();
 
        $link = $request->input('link'); 

        if(!$link)  return redirect('/home');
 
        DB::update('UPDATE financas SET trash = 1 - trash WHERE user_id  = :user_id AND id = :id', [
            'user_id' => $user->id,
            'id' => $id
        ]);

        return redirect($link); 
    }

    public function deleteAllTrash() {
        $user = Auth::user();

        Financa::where('user_id', $user->id)->where('trash', 1)->delete();

        return redirect('/trash');
    }

    public function delFinancaFixa($id) {
        $user = Auth::user();

        FinancaFixa::where('user_id', $user->id)->where('id', $id)->delete();
   
        return redirect(route('financasFixas'));
    }
}
