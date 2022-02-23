<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->string('name')->nullable();
            $table->string('email');
            $table->string('password')->nullable();
            //$table->string('avatar')->nullable();

            $table->integer('type')->nullable();
            //basic information
            $table->string('surname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('seiname')->nullable();
            $table->string('meiname')->nullable();
            $table->integer('sex')->default(1);
            $table->integer('abroad')->nullable();
            $table->string('country')->nullable();
            $table->string('country_name')->nullable();
            $table->string('skype_id')->nullable();
            $table->integer('prefecture')->nullable();
            $table->string('prefecture_name')->nullable();

            //career information

            $table->integer('language')->nullable();
            $table->integer('category')->nullable();
            $table->integer('experience_year')->nullable();
            $table->text('score')->nullable();
            $table->text('performance')->nullable();
            $table->text('overseas_experience')->nullable();
            $table->string('good_genre')->nullable();
            $table->string('other_point')->nullable();
            $table->string('bilingual')->nullable();

            //payment information
            $table->string('financial_institution_name')->nullable();
            $table->string('financial_branch_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('account_holder')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('branch_name')->nullable();
            $table->string('stripe_id')->nullable();

            //available
            $table->integer('state')->default(1);

            //agree
            $table->integer('agree')->nullable();

            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
