<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('version')->nullable();
            $table->date('year')->index();
            $table->date('model')->index();
            $table->enum('gearbox', ['Manual', 'Automático', 'Não Informado']);
            $table->integer('doors')->default(2);
            $table->enum('gas', [
                'Álcool', 'Bi-Combustível', 'Diesel', 'Gasolina', 'Gasolina + Kit Gás', 'Kit Gás','Tetra Fuel'
            ]);
            $table->string('license_plate')->nullable();
            $table->json('accessories')->nullable();
            $table->text('descriptions')->nullable();
            $table->boolean('price')->nullable();
            $table->bigInteger('template_id')->unsigned()->index();
            $table->foreign('template_id')
                ->references('id')->on('templates')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->boolean('exchange')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
}
