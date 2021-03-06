<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrintingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('printings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('printing_author_id')->constrained();
            $table->foreignId('printing_pubhouse_id')->constrained();
            $table->foreignId('printing_type_id')->constrained();
            $table->string('title');
            $table->string('slug')->unique();
            $table->integer('publication_year')->unsigned();
            $table->string('isbn')->nullable();
            $table->text('annotation');
            $table->string('picture_path')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('printings');
    }
}
