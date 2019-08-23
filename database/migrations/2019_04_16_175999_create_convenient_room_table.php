<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConvenientRoomTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('convenient_room', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->bigInteger('room_id')->unsigned();
			$table->bigInteger('convenient_id')->unsigned();
			$table->timestamps();
			//relationship
			$table->foreign('room_id')->references('id')
				->on('rooms')
				->onDelete('cascade')
				->onUpdate('cascade');
			$table->foreign('convenient_id')->references('id')
				->on('convenients')
				->onDelete('cascade')
				->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('convenient_room');
	}
}