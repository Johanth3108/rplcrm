<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManpagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manpages', function (Blueprint $table) {
            $table->id();
            $table->boolean('employees')->nullable();
            $table->boolean('add_user')->nullable();
            $table->boolean('email')->nullable();
            $table->boolean('email_temp')->nullable();
            $table->boolean('broadcast')->nullable();
            $table->boolean('view_clients')->nullable();
            $table->boolean('gen_leads')->nullable();
            $table->boolean('add_lead')->nullable();
            $table->boolean('gen_prop')->nullable();
            $table->boolean('add_prop')->nullable();
            $table->boolean('add_proptype')->nullable();
            $table->boolean('lpm')->nullable();
            $table->boolean('lpp')->nullable();
            $table->boolean('mal')->nullable();
            $table->boolean('aal')->nullable();
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
        Schema::dropIfExists('manpages');
    }
}
