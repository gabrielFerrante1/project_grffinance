<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateEntradas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entradas', function (Blueprint $table) {
            $table->id();
            $table->string('name', 200);
            $table->float('value');
            $table->integer('month');
            $table->integer('year'); 
            $table->timestamps();
            $table->foreignIdFor(User::class)->constrained()->onDelete('CASCADE');
        });

        Schema::table('entradas', function (Blueprint $table) {
            DB::statement('alter table `entradas` modify value float NOT NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entradas');
    }
}
