<?php

namespace App\Http\Controllers\Financas;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Financa;
use App\Models\FinancaFixa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FinancaCreateController extends Controller
{
    public function viewNewFinanca()
    {
        $user = auth()->user();

        //Pegando todas as categorias do usuário
        $categories = Category::select('id', 'name')->where('user_id', $user->id)->get();

        return view('newFinanca', [
            'user' => $user,
            'categories' => $categories
        ]);
    }


    public function createFinanca(Request $request)
    {
        $user = Auth::user();

        //Tratando os dados
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

        if ($validator->fails()) {
            return redirect('/nova_financa')->withErrors($validator)->withInput();
        }

        $valor = $data['preco'];
        $valorMySQL = str_replace(".", "", $valor);
        $valorMySQL = str_replace(",", ".", $valorMySQL);

        if (!Category::where('user_id', $user->id)->where('id', $data['categoria'])->first()) {
            return redirect('/nova_financa')->with('error', 'Categoria inválida');
        }
        //Salvando
        $new = new Financa();
        $new->title = $data['titulo'];
        $new->description = $data['descricao'];
        $new->category_id = $data['categoria'];
        $new->price = $valorMySQL;
        $new->month = $data['mes'];
        $new->year = $data['ano'];
        $new->user_id = $user->id;
        $new->status = $data['status'];
        $new->day = $data['dia'];
        $new->save();

        return redirect('/nova_financa')->with('success', 'Sua despesa foi adicionada com sucesso, vá na área de consulta de despesas para ver ela');
    }

    public function viewNewFinancaFixa()
    {
        $user = auth()->user();

        //Pegando todas as categorias do usuário
        $categories = Category::select('id', 'name')->where('user_id', $user->id)->get();

        return view('newFinancaFixa', [
            'user' => $user,
            'categories' => $categories
        ]);
    }

    public function createFinancaFixa(Request $request)
    {
        $user = Auth::user();

        //Tratando os dados
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
            return redirect('/nova_financa_fixa')->withErrors($validator)->withInput();
        }

        $valor = $data['preco'];
        $valorMySQL = str_replace(".", "", $valor);
        $valorMySQL = str_replace(",", ".", $valorMySQL);

        if (!Category::where('user_id', $user->id)->where('id', $data['categoria'])->first()) {
            return redirect('/nova_financa_fixa')->with('error', 'Categoria inválida');
        }
        //Salvando
        $new = new FinancaFixa();
        $new->title = $data['titulo'];
        $new->description = $data['descricao'];
        $new->category_id = $data['categoria'];
        $new->price = $valorMySQL;
        $new->user_id = $user->id;
        $new->status = $data['status'];
        $new->day = $data['dia'];
        $new->save();

        return redirect('/nova_financa_fixa')->with('success', 'A despesa fixa foi cadastrado com sucesso');
    }
}
