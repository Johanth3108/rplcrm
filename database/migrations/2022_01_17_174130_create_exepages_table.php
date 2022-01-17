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
            $table->boolean('message');
            $table->boolean('whatsapp');
            $table->boolean('calendar');
            $table->boolean('employees');
            $table->boolean('add_user');
            $table->boolean('apex');
            $table->boolean('gen_leads');
            $table->boolean('add_lead');
            $table->boolean('gen_prop');
            $table->boolean('add_prop');
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
