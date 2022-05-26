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
        Schema::create('book_booktype', function (Blueprint $table) {
            $table->foreignId('book_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('booktype_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();

            $table->primary(['book_id', 'booktype_id']);
            $table->index('book_id', 'book_booktype_book_id_index');
            $table->index('booktype_id', 'book_booktype_booktype_id_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_booktype');
    }
};
