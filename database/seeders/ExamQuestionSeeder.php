<?php

namespace Database\Seeders;

use App\Models\Exam;
use App\Models\ExamQuestion;
use App\Models\ExamSubject;
use Illuminate\Database\Seeder;

class ExamQuestionSeeder extends Seeder
{
    public function run()
    {
        $exams = Exam::all();
        $subjects = ExamSubject::all()->pluck('id', 'name')->toArray();

        foreach ($exams as $exam) {
            $questionCount = rand(5, 10); // Hər imtahan üçün 5-10 sual
            for ($i = 1; $i <= $questionCount; $i++) {
                $subject = array_rand($subjects);
                ExamQuestion::create([
                    'question_content' => "Sual $i: {$exam->name} üçün nümunə sual",
                    'point' => rand(1, 5),
                    'exam_subject_id' => $subjects[$subject],
                    'exam_id' => $exam->id,
                ]);
            }
        }
    }
}
