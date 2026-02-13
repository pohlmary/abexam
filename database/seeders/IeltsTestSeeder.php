<?php

namespace Database\Seeders;

use App\Models\IeltsTest;
use App\Models\IeltsSection;
use App\Models\IeltsQuestion;
use App\Models\IeltsOption;
use Illuminate\Database\Seeder;

class IeltsTestSeeder extends Seeder
{
    public function run(): void
    {
        // Create a test
        $test = IeltsTest::create([
            'title' => 'IELTS Mock Test 1',
            'description' => 'Complete IELTS mock test with all sections',
            'duration' => 180,
            'total_marks' => 100,
            'passing_marks' => 60,
            'is_published' => true,
            'created_by' => 1,
        ]);

        // Create sections
        $sections = [
            ['name' => 'Listening', 'duration' => 30, 'total_marks' => 25],
            ['name' => 'Reading', 'duration' => 60, 'total_marks' => 25],
            ['name' => 'Writing', 'duration' => 60, 'total_marks' => 25],
            ['name' => 'Speaking', 'duration' => 30, 'total_marks' => 25],
        ];

        foreach ($sections as $index => $sectionData) {
            $section = $test->sections()->create([
                'name' => $sectionData['name'],
                'description' => 'IELTS ' . $sectionData['name'] . ' section',
                'duration' => $sectionData['duration'],
                'total_marks' => $sectionData['total_marks'],
                'order' => $index + 1,
            ]);

            // Create questions for each section
            for ($i = 1; $i <= 10; $i++) {
                $question = $section->questions()->create([
                    'question_text' => 'Sample question ' . $i . ' for ' . $sectionData['name'],
                    'type' => $this->getQuestionType($sectionData['name']),
                    'marks' => 2.5,
                    'order' => $i,
                ]);

                // Create options for MCQ questions
                if ($question->type === 'mcq') {
                    for ($j = 1; $j <= 4; $j++) {
                        $question->options()->create([
                            'option_text' => 'Option ' . chr(64 + $j),
                            'is_correct' => $j === 1,
                            'order' => $j,
                        ]);
                    }
                }
            }
        }
    }

    private function getQuestionType($section): string
    {
        return match ($section) {
            'Listening' => 'mcq',
            'Reading' => 'true_false',
            'Writing' => 'essay',
            'Speaking' => 'short_answer',
            default => 'mcq',
        };
    }
}
