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
        Schema::create('estado', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->timestamps();
        });

        Schema::create('cidade', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->unsignedBigInteger('estado_id');
            $table->foreign('estado_id')->references('id')->on('estado');
            $table->timestamps();
        });

        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('email')->unique();
            $table->unsignedBigInteger('cidade_id');
            $table->foreign('cidade_id')->references('id')->on('cidade');
            $table->timestamps();
        });


        Schema::create('hobbies', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->timestamps();
        });

        Schema::create('usuario_hobbie', function (Blueprint $table) {
            $table->unsignedBigInteger('usuario_id');
            $table->foreign('usuario_id')->references('id')->on('usuarios');
            $table->unsignedBigInteger('hobbie_id');
            $table->foreign('hobbie_id')->references('id')->on('hobbies');
            $table->timestamps();
        });

        
        // Inserir dados nas tabelas

        // Inserir hobbies
        $hobbies = [
            ['nome' => 'Andar de bicicleta'],
            ['nome' => 'Caminhar'],
            ['nome' => 'Fotografia'],
            ['nome' => 'Jardinagem'],
            ['nome' => 'Culinária']
        ];

        DB::table('hobbies')->insert($hobbies);

        // Inserir estados
        $estados = [
            ['nome' => 'Paraíba'],
            ['nome' => 'Pernambuco'],
            ['nome' => 'Ceará']
        ];

        DB::table('estado')->insert($estados);

        // Inserir cidades
        $cidades = [
            ['nome' => 'Campina Grande', 'estado_id' => 1],
            ['nome' => 'João Pessoa', 'estado_id' => 1],
            ['nome' => 'Bayeux', 'estado_id' => 1],
            ['nome' => 'Recife', 'estado_id' => 2],
            ['nome' => 'Olinda', 'estado_id' => 2],
            ['nome' => 'Caruaru', 'estado_id' => 2],
            ['nome' => 'Fortaleza', 'estado_id' => 3],
            ['nome' => 'Juazeiro do Norte', 'estado_id' => 3],
            ['nome' => 'Sobral', 'estado_id' => 3],
        ];

        DB::table('cidade')->insert($cidades);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuario_hobbie');
        Schema::dropIfExists('hobbies');
        Schema::dropIfExists('usuarios');
        Schema::dropIfExists('cidade');
        Schema::dropIfExists('estado');
    }
};
