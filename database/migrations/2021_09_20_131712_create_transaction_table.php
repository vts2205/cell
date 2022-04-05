<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('profile_id');
            $table->string('details')->nullable();
            $table->string('amount');
            $table->unsignedBigInteger('from_to')->nullable();
            $table->string('cd_status');
            $table->timestamps();
            $table->foreign('profile_id')->references('id')->on('profile')->onDelete('cascade');
            $table->foreign('from_to')->references('id')->on('profile')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction');
    }
}