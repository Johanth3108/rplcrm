<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('contact_number');
            $table->string('department');
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('superadmin')->nullable();
            $table->boolean('areamanager')->nullable();
            $table->boolean('salesmanager')->nullable();
            $table->boolean('salesexecutive')->nullable();
            $table->boolean('telecaller')->nullable();
            $table->string('state')->default('active');
            $table->string('district');
            $table->integer('notification')->default(0);
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
