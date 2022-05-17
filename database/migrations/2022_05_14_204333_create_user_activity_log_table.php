<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserActivityLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_activity_log', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_user')->nullable();
            $table->string('name_admin')->nullable();
            $table->string('pp')->nullable();
            $table->string('status_activity')->nullable();
            $table->string('gambar')->nullable();
            $table->string('status_jadwal')->nullable();
            $table->string('tanggal')->nullable();
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_activity_log');
    }
}