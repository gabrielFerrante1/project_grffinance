<?php
 
use Illuminate\Support\Facades\Route; 

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CronJobController; 
use App\Http\Controllers\Receitas\ReceitaCreateController;
use App\Http\Controllers\Financas\Categorias\CategoriaController;
use App\Http\Controllers\Financas\Categorias\CategoriaCreateController;
use App\Http\Controllers\Financas\Categorias\CategoriaDeleteController;
use App\Http\Controllers\Financas\Categorias\CategoriaUpdateController;
use App\Http\Controllers\Financas\FinancaController;
use App\Http\Controllers\Financas\FinancaCreateController;
use App\Http\Controllers\Financas\FinancaTrashController;
use App\Http\Controllers\Financas\FinancaUpdateController;
use App\Http\Controllers\Financas\ImportAndExportController;
use App\Http\Controllers\Receitas\ReceitaController;
use App\Http\Controllers\Receitas\ReceitaDeleteController;
use App\Http\Controllers\Receitas\ReceitaUpdateController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

if (env('APP_ENV') == 'local') {
    Route::get('/login-account-test', function () {
        Auth::loginUsingId(1);
    });
}

Route::get('/', function () {
    return redirect()->route('home');
});

Route::middleware('auth')->group(function() { 
    Route::get('/home', [FinancaController::class, 'viewDashboard'])->name('home');

    //Visualizar
    Route::get('/financas', [FinancaController::class, 'viewAllFinancas'])->name('financas');

    Route::get('/finans_fixas', [FinancaController::class, 'viewAllFinancasFixas'])->name('financasFixas'); 
    
    Route::get('/pendentes', [FinancaController::class, 'viewPendentesFinancas'])->name('financasPendentes'); 
    
    Route::get('/categorias', [CategoriaController::class, 'viewAllCategorias'])->name('categorias');

    Route::get('/rcts', [ReceitaController::class, 'viewAllReceitas']);

    Route::get('/contas', [ReceitaController::class, 'viewAllContas']);

    //Adicionar
    Route::get('/nova_financa', [FinancaCreateController::class, 'viewNewFinanca']);
    Route::post('/nova_financa', [FinancaCreateController::class, 'createFinanca']);

    Route::get('/nova_financa_fixa', [FinancaCreateController::class, 'viewNewFinancaFixa']);
    Route::post('/nova_financa_fixa', [FinancaCreateController::class, 'createFinancaFixa']);

    Route::get('/nova_categoria', [CategoriaCreateController::class, 'viewNewCategoria']);
    Route::post('/nova_categoria', [CategoriaCreateController::class, 'createCategoria']); 
    
    Route::get('/nova_conta', [ReceitaCreateController::class, 'viewNewConta']);
    Route::post('/nova_conta', [ReceitaCreateController::class, 'createConta']);

    Route::get('/nova_receita', [ReceitaCreateController::class, 'viewNewReceita']);
    Route::post('/nova_receita', [ReceitaCreateController::class, 'createReceita']);  

    //Atualizar
    Route::get('/financa/edit/{id}', [FinancaUpdateController::class, 'viewUpdateFinanca']);
    Route::post('/financa/edit/{id}', [FinancaUpdateController::class, 'updateFinanca']);

    Route::get('/financa_fixa/edit/{id}', [FinancaUpdateController::class, 'viewUpdateFinancaFixa']);
    Route::post('/financa_fixa/edit/{id}', [FinancaUpdateController::class, 'updateFinancaFixa']);

    Route::get('/status/despesa/{id}', [FinancaUpdateController::class, 'updateFinancaStatus']);

    Route::get('/categoria/edit/{id}', [CategoriaUpdateController::class, 'viewUpdateCategoria']);
    Route::post('/categoria/edit/{id}', [CategoriaUpdateController::class, 'updateCategoria']); 

    Route::get('/conta/edit/{id}', [ReceitaUpdateController::class, 'viewUpdateConta']);
    Route::post('/conta/edit/{id}', [ReceitaUpdateController::class, 'updateConta']);

    Route::get('/receita/edit/{id}', [ReceitaUpdateController::class, 'viewUpdateReceita']);
    Route::post('/receita/edit/{id}', [ReceitaUpdateController::class, 'updateReceita']);

    //Deletar
    Route::get('/del-all-trash', [FinancaTrashController::class, 'deleteAllTrash']);

    Route::get('/trash', [FinancaTrashController::class, 'viewFinancasInTrash']);
    Route::get('/trash/{id}', [FinancaTrashController::class, 'toogleFinancaTrash']);

    Route::get('/del-categoria/{id}', [CategoriaDeleteController::class, 'delCategoria']); 
    Route::get('/del-financa-fixa/{id}', [FinancaTrashController::class, 'delFinancaFixa']);
    Route::get('/del-conta/{id}', [ReceitaDeleteController::class, 'delConta']);
    Route::get('/del-receita/{id}', [ReceitaDeleteController::class, 'delReceita']);

    //Importando as depesas do usuário em arquivo XLSX
    Route::get('/importacao', [ImportAndExportController::class, 'viewImport']);
    Route::post('/importacao', [ImportAndExportController::class, 'import']);

    //Exportando as depesas do usuário em arquivo XLSX
    Route::get('/exportacao', [ImportAndExportController::class, 'viewExport']);
    Route::get('/despesa/exportacao/xlsx', [ImportAndExportController::class, 'exportAquivheXLSX']);
    Route::get('/despesa/exportacao/csv', [ImportAndExportController::class, 'exportAquivheCSV']);



    Route::get('/logout', [AuthController::class, 'logout']);
}); 

Auth::routes();

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginIntegration']);

Route::get('/signup', [AuthController::class, 'signup'])->name('signup');
Route::post('/signup', [AuthController::class, 'creteUserOfIntegration']);

Route::middleware('cronjob')->prefix('/cron-job')->group(function() {
    Route::get('/despesas-fixas', [CronJobController::class, 'despesasFixas']);
});