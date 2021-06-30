<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTopicQuestionnaireTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topic_questionnaire', function (Blueprint $table) {
            $table->foreignUuid('topic_id')->constrained('topics')->onDelete('cascade');
            $table->foreignUuid('questionnaire_id')->constrained('questionnaires')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('topic_questionnaire');
    }
}
