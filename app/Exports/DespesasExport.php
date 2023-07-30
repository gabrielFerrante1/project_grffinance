<?php

namespace App\Exports;

use App\Models\Category;
use App\Models\Financa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\Auth;

class DespesasExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings(): array
    {
        return [
            'Título',
            'Descrição', 
            'Status',
            'Valor',
            'Dia',
            'Mês',
            'Ano', 
            'Categoria'
        ];
    }

    public function collection()
    {
        $user = Auth::user();

        $query = Financa::select('title', 'description', 'category_id', 'status', 'price', 'day', 'month', 'year')->where('user_id', $user->id)->get();
        foreach($query as $k => $v) {
            $cat = Category::select('name')->where('id', $v->category_id)->first();

            $query[$k]['category'] = $cat->name;
            unset($v->category_id);
        }

        return $query;
    }
}
