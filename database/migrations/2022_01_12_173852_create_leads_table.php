<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('property_name');
            $table->text('address')->nullable();
            $table->string('location')->default('India');
            $table->string('state');
            $table->string('district');
            $table->string('prop_type');
            $table->string('lead_from')->default('manual');
            $table->string('assigned_man')->nullable();
            $table->string('assigned_exe')->nullable();
            $table->string('assigned_tele')->nullable();
            $table->integer('status');
            $table->text('feedback')->nullable();
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
        Schema::dropIfExists('leads');
    }
}
