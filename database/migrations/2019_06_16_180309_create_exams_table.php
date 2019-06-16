<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('idExam');
            $table->string('subject');
            $table->integer('qNumber');
            $table->string('class');
            $table->integer('scope');
            $table->string('source');
            $table->string('description');
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
            $table->smallInteger('d1')->default(0);
            $table->smallInteger('d2')->default(0);
            $table->smallInteger('d3')->default(0);
            $table->smallInteger('d4')->default(0);
            $table->smallInteger('d5')->default(0);
            $table->smallInteger('d6')->default(0);
            $table->smallInteger('d7')->default(0);
            $table->smallInteger('d8')->default(0);
            $table->smallInteger('d9')->default(0);
            $table->smallInteger('d10')->default(0);
            $table->smallInteger('d11')->default(0);
            $table->smallInteger('d12')->default(0);
            $table->smallInteger('d13')->default(0);
            $table->smallInteger('d14')->default(0);
            $table->smallInteger('d15')->default(0);
            $table->smallInteger('d16')->default(0);
            $table->smallInteger('d17')->default(0);
            $table->smallInteger('d18')->default(0);
            $table->smallInteger('d19')->default(0);
            $table->smallInteger('d20')->default(0);
            $table->smallInteger('d21')->default(0);
            $table->smallInteger('d22')->default(0);
            $table->smallInteger('d23')->default(0);
            $table->smallInteger('d24')->default(0);
            $table->smallInteger('d25')->default(0);
            $table->smallInteger('d26')->default(0);
            $table->smallInteger('d27')->default(0);
            $table->smallInteger('d28')->default(0);
            $table->smallInteger('d29')->default(0);
            $table->smallInteger('d30')->default(0);
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
        Schema::dropIfExists('exams');
    }
}
