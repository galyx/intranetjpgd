<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_data', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('razao_social')->nullable();
            $table->string('nome_fantasia')->nullable();
            $table->string('cnpj')->nullable();
            $table->string('phone1')->nullable();
            $table->string('phone2')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('address')->nullable();
            $table->string('home_number')->nullable();
            $table->string('address2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('complement')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_data');
    }
};
