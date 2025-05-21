<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('image_url');
            $table->text('description');
            $table->decimal('imdb_score', 3, 1);
            $table->text('trailer_url');
            $table->foreignId('type_id')->constrained('types')->onDelete('cascade');

            $table->year('release_year');
            $table->integer('duration')->nullable(); // in minutes
            $table->integer('total_episode')->nullable(); // for series/anime

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('movies');
    }
}
