<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoverPicturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('cover_pictures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
            ->constrained()->onDelete('cascade')
            ->onUpdate('cascade');
            $table->string('coverPic');
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
        Schema::dropIfExists('cover_pictures');
    }
}
