<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTranslatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('translates', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('content');
            $table->text('delivery_text')->nullable();
            $table->integer('language');
            $table->integer('category');
            $table->date('delivery_date');
            $table->float('price');
            $table->integer('count');
            $table->integer('translator_id')->nullable();
            $table->integer('order_id');
            $table->integer('status')->default(0);
            $table->string('translate_file')->nullable();
            $table->string('translate_change_file')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('translates');
    }
}
