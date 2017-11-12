<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');

            $table->text('body');
            $table->string('image')->nullable();
            $table->string('video')->nullable();

            $table->unsignedTinyInteger('number_of_answers')->default(4);
            $table->string('type_of_answer')->default('text');

            $table->unsignedTinyInteger('time_limit')->default(10);

            $table->boolean(
                'is_multipart')->default(false);
            $table->boolean(
                'enabled')->default(false);
            $table->boolean(
                'approved')->default(false);

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
        Schema::dropIfExists('questions');
    }
}
