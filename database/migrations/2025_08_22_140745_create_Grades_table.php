<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema; 
class CreateGradesTable extends Migration {

	public function up()
	{
		Schema::create('Grades', function(Blueprint $table) {
			$table->id('id');
			$table->timestamps();
			$table->json('Name')->unique();
			$table->text('Notes')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('Grades');
	}
}