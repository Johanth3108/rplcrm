<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreamanpagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('areamanpages', function (Blueprint $table) {
            $table->id();
            $table->boolean('message')->nullable();
            $table->boolean('whatsapp')->nullable();
            $table->boolean('calendar')->nullable();
            $table->boolean('employees')->nullable();
            $table->boolean('add_user')->nullable();
            $table->boolean('apex')->nullable();
            $table->boolean('clients')->nullable();
            $table->boolean('gen_leads')->nullable();
            $table->boolean('add_lead')->nullable();
            $table->boolean('gen_prop')->nullable();
            $table->boolean('add_prop')->nullable();
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
        Schema::dropIfExists('areamanpages');
    }
}
