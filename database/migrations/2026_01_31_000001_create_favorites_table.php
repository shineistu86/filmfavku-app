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
        Schema::create('favorites', function (Blueprint $table) {
            $table->id();
            $table->string('film_id')->unique();
            $table->string('title');
            $table->integer('year')->nullable();
            $table->decimal('rating', 3, 1)->nullable(); // Rating dari 1-10 dengan 1 angka desimal
            $table->text('notes')->nullable();
            $table->string('poster_url')->nullable();
            $table->string('imdb_id')->nullable();
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
        Schema::dropIfExists('favorites');
    }
};