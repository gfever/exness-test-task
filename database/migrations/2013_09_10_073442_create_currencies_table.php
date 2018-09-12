<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::transaction(function (){
            Schema::create('currencies', function (Blueprint $table) {
                $table->increments('id');
                $table->char('code', 3)->unique();
                $table->string('name')->unique();
                $table->string('symbol', 10);
            });

            resolve(CurrenciesSeeder::class)->run();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('currencies');
    }
}
