<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('propname');
            $table->string('address');
            $table->string('district');
            $table->string('state');
            $table->string('prop_type');
            $table->string('owner');
            $table->string('status');
            $table->string('areamanager')->nullable();
            $table->integer('salesmanager')->nullable();
            $table->string('salesexecutive')->nullable();
            $table->integer('telecaller')->nullable();
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
        Schema::dropIfExists('properties');
    }
}
