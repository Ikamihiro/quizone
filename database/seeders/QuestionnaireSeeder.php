<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class QuestionnaireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Questionnaire::factory(10)
            ->has(\App\Models\Question::factory()
                ->has(\App\Models\Option::factory()->count(5), 'options')
                ->count(10), 'questions')
            ->has(\App\Models\Topic::factory()->count(3))
            ->create();
    }
}
