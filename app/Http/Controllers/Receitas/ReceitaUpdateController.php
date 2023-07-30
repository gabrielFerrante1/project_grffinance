<?php

namespace App\Http\Controllers\Receitas;

use App\Http\Controllers\Controller;
use App\Models\Entrada;
use App\Models\Receita;
use App\Models\ReceitaConta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReceitaUpdateController extends Controller
{
    public function viewUpdateConta($id) 
    {
        $query = ReceitaConta::where('user_id', Auth::id())->where('id', $id)->first();

        return view('editConta', [
            'user' => Auth::user(),
            'data' => $query
        ]);
    }

    public function updateConta($id, Request $request) 
    {
        $data = $request->only([
            'nome',
            'descricao' 
        ]);

        $validator = Validator::make($data, [
            'nome' => 'required|max:200' 
        ]);

        if($validator->fails()) {
            return redirect('/conta/edit/'.$id)->withErrors($validator)->withInput();
        }

        ReceitaConta::where('id', $id)->update([
            'name' => $data['nome'],
            'description' => $data['descricao'] 
        ]);

        return redirect('/contas')->with('success', 'Conta alterada com sucesso!');
    }

    public function viewUpdateReceita($id)
    {
        $query = Receita::where('user_id', Auth::id())->where('id', $id)->first();

        return view('editReceita', [
            'user' => Auth::user(),
            'data' => $query,
            'contas' => ReceitaConta::select('id', 'name')->where('user_id', Auth::id())->get()
        ]);
    }

    public function updateReceita($id, Request $request)
    {
        $data = $request->only([
            'nome',
            'descricao',
            'conta',
            'valor',
            'dia',
            'mes',
            'ano'
        ]);

        $validator = Validator::make($data, [
            'nome' => 'required|max:200',
            'conta' => 'required',
            'valor' => 'required',
            'dia' => 'required|max:2',
            'mes' => 'required|max:2',
            'ano' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('/receita/edit/' . $id)->withErrors($validator)->withInput();
        }

        if (!ReceitaConta::find($data['conta'])) {
            return redirect('/receita/edit/'.$id)->with('error', 'Conta inválida')->withInput();
        } 


        $valor = $data['valor'];
        $valorMySQL = str_replace(".", "", $valor);
        $valorMySQL = str_replace(",", ".", $valorMySQL);

        Receita::where('id', $id)->update([
            'title' => $data['nome'],
            'description' => $data['descricao'],
            'receita_conta_id' => $data['conta'],
            'value' => $valorMySQL,
            'day' => $data['dia'],
            'month' => $data['mes'],
            'year' => $data['ano'],
        ]);

        return redirect('/rcts')->with('success', 'Receita alterada com sucesso!');
    }
}
