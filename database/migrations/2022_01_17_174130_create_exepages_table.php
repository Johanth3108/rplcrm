<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExepagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exepages', function (Blueprint $table) {
            $table->id();
            $table->boolean('gen_leads')->nullable();
            $table->boolean('tele')->nullable();
            $table->boolean('add_tele')->nullable();
            $table->boolean('lpp')->nullable();
            $table->boolean('mal')->nullable();
            $table->boolean('aal')->nullable();
            $table->boolean('view_clients')->nullable();
            $table->boolean('broadcast')->nullable();
            $table->boolean('email')->nullable();
            $table->boolean('email_temp')->nullable();
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
        Schema::dropIfExists('exepages');
    }
}
