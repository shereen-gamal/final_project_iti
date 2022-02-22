<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();

            $table->string('type',255);

            $table->foreignId('from_user_id')->constrained()->references('id')->on('users')->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreignId('to_user_id')->constrained()->references('id')->on('users')->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreignId('post_id')
            ->nullable()
            ->constrained()->onDelete('cascade')
            ->onUpdate('cascade');
            
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
        Schema::dropIfExists('notifications');
    }
}
