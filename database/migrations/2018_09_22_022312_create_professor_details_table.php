<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfessorDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('professor_details', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('Role', array ('Techincal', 'Non-Technical', 'Other'));
            $table->unsignedInteger('professor_id');
            $table->foreign('professor_id')->references('id')->on('professors');
            $table->double('amount', 10, 2);
            $table->boolean('is_active')->default(true);
            $table->timestamp('joined_on');
            $table->timestamp('resigned_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('professor_details');
    }
}
