<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaPosts extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('posts', function(Blueprint $table)
		{
			$table->increments('id');
                        $table->text('cuerpo');
                        //$table->integer('user_id')->unsigned();
                        //$table->foreign('user_id')->references('id')->on('users');
                        $table->string('autor',25);
                        $table->integer('tema_id')->unsigned();
                        $table->foreign('tema_id')->references('id')->on('temas');
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
		Schema::drop('posts');
	}

}
