<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUserPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_plans', function (Blueprint $table) {
            $table->id();
            $table->integer('plan_id');
            $table->integer('user_id');
            $table->integer('coupen_id')->nullable();
            $table->integer('status')->nullable();
            $table->integer('price');
            $table->integer('anet_subscription_id');
            $table->date('week1');
            $table->date('week2');
            $table->date('week3');
            $table->date('week4');
            $table->dateTime('expire_at');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE user_plans AUTO_INCREMENT = 10001;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_plans');
    }
}
