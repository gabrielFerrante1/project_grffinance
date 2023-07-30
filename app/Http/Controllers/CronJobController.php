<?php

namespace App\Http\Controllers;

use App\Models\Financa;
use Illuminate\Http\Request;
use App\Models\FinancaFixa;
use DateTime;

class CronJobController extends Controller
{
    public function despesasFixas()
    {
        //Date
        date_default_timezone_set('America/Sao_Paulo'); 

        $despesasFixas = FinancaFixa::where('last_month_released', '!=', date('n'))->get();

        foreach ($despesasFixas as $value) {
            if ($value->day == date('j') || $value->day > date('t')) {
                $saveFinanca = new Financa();
                $saveFinanca->title = $value->title;
                $saveFinanca->description = $value->description;
                $saveFinanca->price = $value->price;
                $saveFinanca->status = $value->status;
                $saveFinanca->day = $value->day;
                $saveFinanca->month = date('n');
                $saveFinanca->year = date('Y');
                $saveFinanca->user_id = $value->user_id;
                $saveFinanca->category_id = $value->category_id;
                $saveFinanca->save();

                # Update Financa Fixa - last month released
                FinancaFixa::where('id', $value->id)
                ->update(['last_month_released' => date('n')]);
            }
        }

    }
}
