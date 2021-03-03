<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presences', function (Blueprint $table) {
            $table->id();
            $table->boolean('was_present');
            $table->foreignId('course_profile_id');
            $table->foreignId('lesson_id');
            $table->timestamps();

            $table->foreign('course_profile_id')
                ->references('id')
                ->on('course_profiles')
                ->onDelete('cascade');

            $table->foreign('lesson_id')
                ->references('id')
                ->on('lessons')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('presences', function (Blueprint $table) {
            $table->dropForeign('course_profile_id');
            $table->dropForeign('lesson_id');
        });

        Schema::dropIfExists('presences');
    }
}
