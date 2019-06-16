<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePort6sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('port_6s', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('student');
            $table->string('class');
            $table->string('school');
            $table->string('idExam');
            $table->string('q1')->default('X');
            $table->string('q2')->default('X');
            $table->string('q3')->default('X');
            $table->string('q4')->default('X');
            $table->string('q5')->default('X');
            $table->string('q6')->default('X');
            $table->string('q7')->default('X');
            $table->string('q8')->default('X');
            $table->string('q9')->default('X');
            $table->string('q10')->default('X');
            $table->string('q11')->default('X');
            $table->string('q12')->default('X');
            $table->string('q13')->default('X');
            $table->string('q14')->default('X');
            $table->string('q15')->default('X');
            $table->string('q16')->default('X');
            $table->string('q17')->default('X');
            $table->string('q18')->default('X');
            $table->string('q19')->default('X');
            $table->string('q20')->default('X');
            $table->string('q21')->default('X');
            $table->string('q22')->default('X');
            $table->string('q23')->default('X');
            $table->string('q24')->default('X');
            $table->string('q25')->default('X');
            $table->string('q26')->default('X');
            $table->string('q27')->default('X');
            $table->string('q28')->default('X');
            $table->string('q29')->default('X');
            $table->string('q30')->default('X');
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
        Schema::dropIfExists('port_6s');
    }
}
