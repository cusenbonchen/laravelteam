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
            $table->string('username')->unique();
            $table->string('first_name')->nullable()->default("Vô Danh");
            $table->string('last_name')->nullable()->default("Vô Danh");
            $table->string('sex')->nullable()->default(false);
            $table->string('is_love')->nullable()->default(false);
            $table->string('email')->unique();
            $table->string('password');
            $table->string('address')->nullable();
            $table->string('avatar')->nullable();
            $table->string('phone_number')->nullable(); 
            $table->text('projects')->nullable();
            $table->bigInteger('permisstion')->default(3);
            $table->boolean('status')->default(false);
            $table->boolean('email_verified')->default(false); 
            $table->string('token_email')->nullable();
            $table->string('remember_token')->nullable();
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
