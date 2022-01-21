<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assign_leads', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id');
            $table->string('property_name');
            $table->integer('salesmanager')->nullable();
            $table->integer('salesexecutive')->nullable();
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
        Schema::dropIfExists('assign_leads');
    }
}
