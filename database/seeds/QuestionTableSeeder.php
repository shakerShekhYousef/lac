<?php

use Illuminate\Database\Seeder;

class QuestionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('questions')->insert([
            'question'=>'Question 01',
            'question_ar'=>'السؤال 01',
            'answer'=>'Answer 01',
            'answer_ar'=>'الجواب 01',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
    }
}
