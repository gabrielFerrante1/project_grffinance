<?php

namespace App\Http\Controllers\Receitas;

use App\Http\Controllers\Controller;
use App\Models\Entrada;
use App\Models\Receita;
use App\Models\ReceitaConta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReceitaCreateController extends Controller
{
    public function viewNewConta() {
        return view('newConta', [
            'user' => $this->getClientLooged()
        ]);
    }

    public function createConta(Request $request) {
        $data = $request->only([
            'nome',
            'descricao' 
        ]);

        $validator = Validator::make($data, [
            'nome' => 'required|max:220' 
        ]);

        if($validator->fails()) {
            return redirect('/nova_conta')->withErrors($validator)->withInput();
        }

        //Save
        $save = new ReceitaConta();
        $save->user_id = $this->getClientLooged()->id;
        $save->name = $data['nome'];
        $save->description = $data['descricao'];
        $save->save();

        return redirect('/nova_conta')->with('success', 'Conta adicionada com sucesso!');
    }

    public function viewNewReceita()
    {
        return view('newReceita', [
            'user' => $this->getClientLooged(),
            'contas' => ReceitaConta::select('id', 'name')->where('user_id', $this->getClientLooged()->id)->get()
        ]);
    }

    public function createReceita(Request $request)
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
            'nome' => 'required|max:220',
            'conta' => 'required',
            'valor' => 'required',
            'dia' => 'required|max:2',
            'mes' => 'required|max:2',
            'ano' => 'required|max:4',
        ]);

        if ($validator->fails()) {
            return redirect('/nova_receita')->withErrors($validator)->withInput();
        }

        if (!ReceitaConta::find($data['conta'])) {
            return redirect('/nova_receita')->with('error', 'Conta inválida')->withInput();
        }

        $valor = $data['valor'];
        $valorMySQL = str_replace(".", "", $valor);
        $valorMySQL = str_replace(",", ".", $valorMySQL);

        //Save
        $save = new Receita();
        $save->user_id = $this->getClientLooged()->id;
        $save->title = $data['nome'];
        $save->value = $data['valor'];
        if ($data['descricao']):
            $save->description = $data['descricao'];
        endif;
        $save->day = $data['dia'];
        $save->month = $data['mes'];
        $save->year = $data['ano'];
        $save->receita_conta_id = $data['conta'];
        $save->save();

        return redirect('/nova_receita')->with('success', 'Conta adicionada com sucesso!');
    }


    private function getClientLooged() 
    {
        return Auth::user();
    }
}
