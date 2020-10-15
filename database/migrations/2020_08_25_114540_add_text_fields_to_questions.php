<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTextFieldsToQuestions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->string('question_text');
            $table->string('question_answer_a');
            $table->string('question_answer_b');
            $table->string('question_answer_c');
            $table->string('question_answer_d');
            $table->string('question_answer_e');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->dropColumn('question_text');
            $table->dropColumn('question_answer_a');
            $table->dropColumn('question_answer_b');
            $table->dropColumn('question_answer_c');
            $table->dropColumn('question_answer_d');
            $table->dropColumn('question_answer_e');
        });
    }
}
