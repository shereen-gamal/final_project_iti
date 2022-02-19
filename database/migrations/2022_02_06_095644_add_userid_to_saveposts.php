<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUseridToSaveposts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('save_posts', function (Blueprint $table) {
            $table->foreignId('user_id')
            ->nullable()
            ->constrained()->onDelete('cascade')
            ->onUpdate('cascade');
                });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('saveposts', function (Blueprint $table) {
            //
        });
    }
}
