<?php

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateFinancasAutomaticas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('financas_fixas', function (Blueprint $table) {
            $table->id();
            $table->string('title', 140);
            $table->string('description', 350)->nullable();
            $table->float('price');
            $table->integer('day'); 
            $table->tinyInteger('status')->default('0')->nullable(); 
            $table->dateTime('data')->useCurrent();
            $table->integer('last_month_released')->default('0');
            $table->foreignIdFor(Category::class)->constrained()->onDelete('CASCADE');
            $table->foreignIdFor(User::class)->constrained()->onDelete('CASCADE');
        });

        Schema::table('financas_fixas', function (Blueprint $table) {
            DB::statement('alter table `financas_fixas` modify price float NOT NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('financas_fixas');
    }
}
