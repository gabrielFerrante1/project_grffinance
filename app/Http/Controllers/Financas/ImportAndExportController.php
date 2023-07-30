<?php

namespace App\Http\Controllers\Financas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Financa;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DespesasExport;
use App\Imports\DespesasImport;

class ImportAndExportController extends Controller
{
    public function viewImport() {
        $user = Auth::user();

        return view('import', [
            'user' => $user
        ]);
    }

    public function import() 
    { 
        if(!request()->file('file')) return redirect('/importacao')->with('error', 'Envie um arquivo!'); 

        //Dados do arquivo
        $arquivo = $_FILES['file'];
        $extension = pathinfo($arquivo['name'], PATHINFO_EXTENSION);

        if($extension != 'xlsx' && $extension != 'csv') return redirect('/importacao')->with('error', 'Envie um arquivo do tipo .xlsx ou .csv'); 
         
        $countLast = Financa::where('user_id', Auth::id())->where('trash', 0)->count();
        Excel::import(new DespesasImport, request()->file('file'));
        $countNow = Financa::where('user_id', Auth::id())->where('trash', 0)->count(); 

        $calcReturn = 0;

        if($countLast > 0 && $countNow > 0) {
            $calcReturn = $countNow - $countLast;
        } else if($countLast === 0) {
            $calcReturn = $countNow;
        }
        
        return redirect('/importacao')->with('success', 'Todas as despesas foram inseridas com sucesso!')
                                        ->with('success-count', $calcReturn); 
    }

    public function viewExport() {
        $user = Auth::user();

        return view('export', ['user' => $user]);
    }

    public function exportAquivheXLSX() {
        return Excel::download(new DespesasExport, 'despesas.xlsx');
    }

    public function exportAquivheCSV() {
        return Excel::download(new DespesasExport, 'despesas.csv');
    }
}
