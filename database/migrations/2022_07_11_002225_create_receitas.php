<?php

use App\Models\ReceitaConta;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateReceitas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receitas', function (Blueprint $table) {
            $table->id();
            $table->string('title', 220);
            $table->text('description')->nullable();
            $table->float('value');
            $table->integer('day');
            $table->integer('month');
            $table->integer('year');
            $table->foreignIdFor(User::class)->constrained()->onDelete('CASCADE');
            $table->unsignedBigInteger('receita_conta_id');
            $table->foreign('receita_conta_id')->references('id')->on('contas_receita');
        });

        Schema::table('receitas', function (Blueprint $table) {
            DB::statement('alter table `receitas` modify value float NOT NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('receitas');
    }
}
