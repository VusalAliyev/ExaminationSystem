<?php

namespace Database\Seeders;

use App\Models\ExamAnswer;
use App\Models\ExamQuestion;
use Illuminate\Database\Seeder;

class ExamAnswerSeeder extends Seeder
{
    public function run()
    {
        // Bütün sualları alırıq
        $questions = ExamQuestion::all();

        foreach ($questions as $question) {
            // Hər sual üçün 4 cavab yaradacağıq (1 doğru, 3 yanlış)
            $answerCount = 4;
            $correctAnswerIndex = rand(0, $answerCount - 1); // Təsadüfi olaraq doğru cavabın indeksini seçirik

            for ($i = 0; $i < $answerCount; $i++) {
                $isCorrect = ($i === $correctAnswerIndex); // Yalnız bir cavab doğru olacaq

                ExamAnswer::create([
                    'answer_content' => "Cavab " . ($i + 1) . ": Sual {$question->id} üçün nümunə cavab",
                    'state' => $isCorrect, // Doğru cavab üçün true, yanlışlar üçün false
                    'exam_question_id' => $question->id,
                ]);
            }
        }
    }
}
