<?php

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateFinancas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('financas', function (Blueprint $table) {
            $table->id();
            $table->string('title', 140);
            $table->string('description', 350)->nullable();
            $table->float('price');
            $table->integer('day');
            $table->integer('month');
            $table->integer('year');
            $table->tinyInteger('status')->default('0')->nullable();
            $table->tinyInteger('trash')->default('0');
            $table->dateTime('data')->useCurrent(); 
            $table->foreignIdFor(Category::class)->constrained()->onDelete('CASCADE');
            $table->foreignIdFor(User::class)->constrained()->onDelete('CASCADE');
        });

        Schema::table('financas', function (Blueprint $table) {
            DB::statement('alter table `financas` modify price float NOT NULL'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('financas');
    }
}
