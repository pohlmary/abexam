<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\IeltsAnswer;
use App\Models\IeltsAttempt;
use Illuminate\Http\Request;

class IeltsAnswerController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'attempt_id' => 'required|exists:ielts_attempts,id',
            'question_id' => 'required|exists:ielts_questions,id',
            'answer_text' => 'nullable|string',
            'selected_option_id' => 'nullable|exists:ielts_options,id',
        ]);

        $attempt = IeltsAttempt::findOrFail($validated['attempt_id']);
        $this->authorize('update', $attempt);

        $answer = IeltsAnswer::where('attempt_id', $attempt->id)
            ->where('question_id', $validated['question_id'])
            ->first();

        $question = $attempt->test->sections()
            ->with('questions')
            ->get()
            ->flatMap->questions
            ->firstWhere('id', $validated['question_id']);

        $isCorrect = null;
        $score = 0;

        if ($question->question_type === 'multiple_choice' && $validated['selected_option_id']) {
            $correctOption = $question->getCorrectOption();
            $isCorrect = $correctOption && $correctOption->id === $validated['selected_option_id'];
            $score = $isCorrect ? $question->marks : 0;
        }

        if ($answer) {
            $answer->update([
                'answer_text' => $validated['answer_text'],
                'selected_option_id' => $validated['selected_option_id'],
                'is_correct' => $isCorrect,
                'score' => $score,
                'answered_at' => now(),
            ]);
        } else {
            $answer = IeltsAnswer::create([
                'attempt_id' => $attempt->id,
                'question_id' => $validated['question_id'],
                'answer_text' => $validated['answer_text'],
                'selected_option_id' => $validated['selected_option_id'],
                'is_correct' => $isCorrect,
                'score' => $score,
                'answered_at' => now(),
            ]);
        }

        return response()->json($answer, 201);
    }

    public function update(Request $request, IeltsAnswer $answer)
    {
        $this->authorize('update', $answer->attempt);

        $validated = $request->validate([
            'answer_text' => 'nullable|string',
            'selected_option_id' => 'nullable|exists:ielts_options,id',
        ]);

        $answer->update($validated);

        return response()->json($answer);
    }
}
