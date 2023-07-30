<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateContasReceita extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contas_receita', function (Blueprint $table) {
            $table->id();
            $table->string('name', 220);
            $table->text('description')->nullable();
            $table->foreignIdFor(User::class)->constrained()->onDelete('CASCADE');
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contas_receita');
    }
} 