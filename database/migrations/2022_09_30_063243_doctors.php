<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();

            $table->text("name");
            $table->text("mname")->nullable()->default(null);
            $table->text("lname")->nullable()->default(null);
            $table->date("dob");
            $table->boolean("gender");
            $table->string("phone", 14);
            $table->string("email");
            $table->string("city");
            $table->string("address", 455);

            $table->unsignedBigInteger('department_id');
            $table->foreign('department_id')->references('id')->on('departments');

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
};
