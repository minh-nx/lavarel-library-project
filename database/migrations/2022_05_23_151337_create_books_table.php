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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->string('author')->nullable();
            $table->year('publication_year')->nullable();
            $table->string('cover_image');
            $table->text('description')->nullable();
            $table->unsignedInteger('quantity')->default(1);
            $table->timestamps();

            $table->unique('title', 'books_title_unique');
            $table->unique('slug', 'books_slug_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
};
