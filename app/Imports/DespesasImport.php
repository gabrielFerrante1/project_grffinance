<?php

namespace App\Imports;

use App\Models\Category;
use App\Models\Financa;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation; 
use Maatwebsite\Excel\Concerns\Importable;

class DespesasImport implements ToModel, WithHeadingRow, WithValidation
{ use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $user = Auth::user();

        $r = $user->id;
 

        //save 
        $ne = new Financa;
        $ne->title = $row['titulo'];

        //Consulta de categoria
        $category = Category::where('user_id', $r)->where('token', $row['categoria'])->first();
        if($category) {
            $ne->category_id = $category->id;
        } else {
            $save = new Category();
            $save->id_user = $r;
            $save->name = $row['categoria'];
            $save->token = $row['categoria'];
            $save->save();

            $ne->category_id = $save->id;
        }
 
        if(!isset($row['descricao']) && empty($row['descricao'])) {
            $row['descricao'] = '';
        }

        $ne->description = $row['descricao'];
        $ne->price = $row['valor'];
        $ne->day = $row['dia'];
        $ne->month = $row['mes'];
        $ne->year = $row['ano'];

        if(isset($row['status']) && !empty($row['status'])) {
            if($row['status'] === 'Pago' ||  $row['status'] === 'pago') {
                $ne->status = 1;
            } else if ($row['status'] === 'Pendente' || $row['status'] === 'pendente') {
                $ne->status = 0;
            } 
        }
        $ne->id_user = $r;
        $ne->save();

      
    }
   
    public function rules(): array
    {
        return [
            'titulo' => 'required|max:140',
            'categoria' => 'required|max:150',
            'valor' => 'required|numeric',
            'mes' => 'required|numeric|max:12|min:1',
            'dia' => 'required|numeric|max:31|min:1',
            'ano' => 'required|numeric|min:1',
            'descricao' => 'max:350'
        ];
    }

    public function customValidationMessages()
    {

        return [
            'titulo.required' => 'A coluna titulo deve estar preenchida', 
            'titulo.max' => 'A coluna titulo não pode ter mais de :max caracteres',
            'categoria.required' => 'A coluna categoria deve estar preenchida', 
            'categoria.max' => 'A coluna categoria não pode ter mais de :max caracteres',
            'valor.required' => 'A coluna valor deve estar preenchida',
            'valor.numeric' => 'A coluna valor deve ser um número',
            'mes.required' => 'A coluna mes deve estar preenchida',
            'mes.numeric' => 'A coluna mes deve ser um mês válido',
            'mes.max' => 'A coluna mes não pode ser maior que 12',
            'mes.min' => 'A coluna mes não pode ser menor que 1',
            'dia.required' => 'A coluna dia deve estar preenchida',
            'dia.numeric' => 'A coluna dia deve ser um dia válido',
            'dia.max' => 'A coluna dia não pode ser maior que 31',
            'dia.min' => 'A coluna dia não pode ser menor que 1',
            'ano.required' => 'A coluna ano deve estar preenchida',
            'ano.numeric' => 'A coluna ano deve ser um ano válido',
            'ano.min' => 'A coluna ano não pode ser menor que 1',
            'descricao.max' => 'A coluna descricao não pode ter mais de :max caracteres'
        ];
    }
}
