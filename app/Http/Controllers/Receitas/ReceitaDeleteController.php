<?php

namespace App\Http\Controllers\Receitas;

use App\Http\Controllers\Controller;
use App\Models\Receita;
use App\Models\ReceitaConta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReceitaDeleteController extends Controller
{
    public function delConta($id) {
        ReceitaConta::where('user_id', Auth::id())->where('id', $id)->delete();

        return redirect('/contas')->with('success', 'Conta deletada com sucesso!');
    }

    public function delReceita($id) {
        Receita::where('user_id', Auth::id())->where('id', $id)->delete();

        return redirect('/rcts')->with('success', 'Receita deletada com sucesso!');
    }
}
