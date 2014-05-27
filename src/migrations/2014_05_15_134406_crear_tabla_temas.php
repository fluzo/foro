<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaTemas extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('temas', function(Blueprint $table)
		{
			$table->increments('id');                        
                        $table->string('titulo',120);
                        $table->string('slug',160);
                        $table->text('cuerpo');
                        $table->string('autor',25);
                        //$table->integer('user_id')->unsigned();
                        //$table->foreign('user_id')->references('id')->on('users');
                        $table->integer('foro_id')->unsigned();
                        $table->foreign('foro_id')->references('id')->on('foros');
                        $table->boolean('aprobado')->default(false);                        
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
		Schema::drop('temas');
	}

}
