<?php

namespace App\Http\Controllers\Financas;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Financa;
use App\Models\FinancaFixa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FinancaUpdateController extends Controller
{
    public function viewUpdateFinanca(Int $id, Request $request) {
        $link = $request->input('link');
        $query = Financa::where('user_id', Auth::id())->where('id', $id)->first();

        if(!($link && $query)) return redirect('/home');

        return view('editFinanca', [
            'user' => Auth::user(),
            'link' => $link,
            'data' => $query,
            'categories' => Category::where('user_id', Auth::id())->get()
        ]);
    }

    public function updateFinanca($id, Request $request) {
        $link = $request->input('link');
        $query = Financa::where('user_id', Auth::id())->where('id', $id)->first();

       if(!($link && $query)) return redirect('/home');
   
        $user = Auth::user();

        $data = $request->only([
            'titulo',
            'descricao',
            'categoria',
            'preco',
            'mes',
            'ano',
            'status',
            'dia'
        ]);
         
        $validator = Validator::make($data, [
            'titulo' => 'required|max:140',
            'descricao' => 'max:350',
            'categoria' => 'required|max:150',
            'preco' => 'required',
            'mes' => 'required|max:2',
            'ano' => 'required|max:4',
            'status' => 'required|max:1',
            'dia' => 'required|max:2'
        ]);

        if($validator->fails()) {
            return redirect('/financa/edit/'.$id.'?link='.$link)->withErrors($validator);
        }

        $valor = $data['preco'];
        $valorMySQL = str_replace(".", "", $valor);
        $valorMySQL = str_replace(",", ".", $valorMySQL);

        if(!Category::where('user_id', $user->id)->where('id', $data['categoria'])->first()) {
            return redirect('/financa/edit/'.$id.'?link='.$link)->with('error', 'Categoria inválida');
        }

    
        //Alterando 
        Financa::where('user_id', $user->id)->where('id', $id)->update([
            'title' => $data['titulo'],
            'description' => $data['descricao'],
            'category_id' => $data['categoria'],
            'price' => $valorMySQL,
            'day' => $data['dia'],
            'month' => $data['mes'],
            'year' => $data['ano'],
            'status' => $data['status']
        ]);
        
        return redirect($link)->with('success', 'Despesa alterada com sucesso!');
    }

    public function updateFinancaStatus($id, Request $request) {
        $user = Auth::user();
        $value = $request->input('status');

        Financa::where('user_id', $user->id)->where('id', $id)->update(['status' => $value]);
        
        return redirect($_SERVER['HTTP_REFERER']);
    }

    public function viewUpdateFinancaFixa(Int $id, Request $request) { 
        $query = FinancaFixa::where('user_id', Auth::id())->where('id', $id)->first();

        if (!$query) return redirect('/home');

        return view('editFinancaFixa', [
            'user' => Auth::user(), 
            'data' => $query,
            'categories' => Category::where('user_id', Auth::id())->get()
        ]);
    }

    public function updateFinancaFixa(Int $id, Request $request)
    {
        $query = FinancaFixa::where('user_id', Auth::id())->where('id', $id)->first();

        if (!$query) return redirect('/home');

        $user = Auth::user();

        $data = $request->only([
            'titulo',
            'descricao',
            'categoria',
            'preco', 
            'status',
            'dia'
        ]);

        $validator = Validator::make($data, [
            'titulo' => 'required|max:140',
            'descricao' => 'max:350',
            'categoria' => 'required|max:150',
            'preco' => 'required', 
            'status' => 'required|max:1',
            'dia' => 'required|max:2'
        ]);

        if ($validator->fails()) {
            return redirect(route('financasFixas'))->withErrors($validator);
        }

        $valor = $data['preco'];
        $valorMySQL = str_replace(".", "", $valor);
        $valorMySQL = str_replace(",", ".", $valorMySQL);

        if (!Category::where('user_id', $user->id)->where('id', $data['categoria'])->first()) {
            return redirect(route('financasFixas'))->with('error', 'Categoria inválida');
        }


        //Alterando 
        FinancaFixa::where('user_id', $user->id)->where('id', $id)->update([
            'title' => $data['titulo'],
            'description' => $data['descricao'],
            'category_id' => $data['categoria'],
            'price' => $valorMySQL,  
            'day' => $data['dia'],
            'status' => $data['status']
        ]);

        return  redirect(route('financasFixas'))->with('success', 'Despesa fixa alterada com sucesso!');
    }
}
