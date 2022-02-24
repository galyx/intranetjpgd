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
        Schema::create('solicitacaos', function (Blueprint $table) {
            $table->id();
            $table->integer('lojista_id');
            $table->integer('client_id');
            $table->integer('veiculo_id');
            $table->longText('observacao')->nullable();
            $table->longText('despachante_observacao')->nullable();
            $table->string('gravame')->nullable();
            $table->string('purchase_change_address2')->nullable();
            $table->float('valor_orcamento')->nullable();
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('solicitacaos');
    }
};
