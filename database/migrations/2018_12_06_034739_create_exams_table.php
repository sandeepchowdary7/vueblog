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
            $table->increments('id');
            $table->dateTime('exam_date');
            $table->unsignedInteger('subject_id');
            $table->foreign('subject_id')->references('id')->on('subjects');
            $table->unsignedInteger('course_year_id');
            $table->foreign('course_year_id')->references('id')->on('course_years');
            $table->timestamps();
            $table -> unsignedInteger('created_by') -> nullable() -> default(null) -> after('created_at');
            $table -> unsignedInteger('updated_by') -> nullable() -> default(null) -> after('updated_at');
            $table -> unsignedInteger('deleted_by') -> nullable() -> default(null) -> after('updated_by');
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
