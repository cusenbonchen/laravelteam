<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Project extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('project_name')->nullable();
            $table->string('client');
            $table->bigInteger('level')->default(3); 
            $table->bigInteger('type')->default(3); 
            $table->bigInteger('process')->default(3); 
            $table->longText('content')->default(''); 
            $table->text('assign');
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
        //
    }
}
