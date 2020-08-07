<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Activistes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activists', function (Blueprint $table) {
            $table->id();
             $table->string('first_name')->unique();
             $table->string('last_name')->unique();
             $table->string('phone')->unique();
             $table->string('email')->unique(); 
             $table->bigInteger('association_id')->unsigned();
           
         });
         Schema::table('activists', function($table){
      $table->foreign('association_id')->references('id')->on('associations')->onDelete('cascade');
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
