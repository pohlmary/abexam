<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\IeltsTest;
use App\Models\IeltsAttempt;
use Illuminate\Http\Request;

class IeltsExamSessionController extends Controller
{
    public function start(Request $request)
    {
        $validated = $request->validate([
            'test_id' => 'required|exists:ielts_tests,id',
        ]);

        $test = IeltsTest::findOrFail($validated['test_id']);

        $existing = IeltsAttempt::where('user_id', auth()->id())
            ->where('test_id', $test->id)
            ->where('status', 'in_progress')
            ->first();

        if ($existing) {
            return response()->json($existing->load('test.sections.questions.options'));
        }

        $attempt = IeltsAttempt::create([
            'user_id' => auth()->id(),
            'test_id' => $test->id,
            'started_at' => now(),
            'status' => 'in_progress',
            'ip_address' => $request->ip(),
        ]);

        return response()->json($attempt->load('test.sections.questions.options'), 201);
    }

    public function show(IeltsAttempt $attempt)
    {
        $this->authorize('view', $attempt);
        return response()->json($attempt->load('test.sections.questions.options', 'answers'));
    }

    public function submit(Request $request, IeltsAttempt $attempt)
    {
        $this->authorize('update', $attempt);

        if ($attempt->status !== 'in_progress') {
            return response()->json(['message' => 'Exam already submitted'], 400);
        }

        $attempt->update([
            'status' => 'submitted',
            'finished_at' => now(),
            'time_spent' => now()->diffInSeconds($attempt->started_at),
        ]);

        $this->scoreAutomatic($attempt);

        return response()->json([
            'message' => 'Exam submitted successfully',
            'attempt' => $attempt->load('answers'),
        ]);
    }

    private function scoreAutomatic(IeltsAttempt $attempt)
    {
        $listeningScore = 0;
        $readingScore = 0;

        foreach ($attempt->answers as $answer) {
            $question = $answer->question;
            $section = $question->section;

            if ($answer->is_correct) {
                if ($section->section_type === 'listening') {
                    $listeningScore += $question->marks;
                } elseif ($section->section_type === 'reading') {
                    $readingScore += $question->marks;
                }
            }
        }

        $totalScore = $listeningScore + $readingScore;

        $attempt->update([
            'listening_score' => $listeningScore,
            'reading_score' => $readingScore,
            'total_score' => $totalScore,
            'overall_band' => $this->calculateBand($totalScore),
        ]);
    }

    private function calculateBand($score)
    {
        if ($score >= 90) return 9.0;
        if ($score >= 85) return 8.5;
        if ($score >= 80) return 8.0;
        if ($score >= 75) return 7.5;
        if ($score >= 70) return 7.0;
        if ($score >= 65) return 6.5;
        if ($score >= 60) return 6.0;
        if ($score >= 55) return 5.5;
        if ($score >= 50) return 5.0;
        return 4.5;
    }

    public function recordTabSwitch(Request $request, IeltsAttempt $attempt)
    {
        $this->authorize('update', $attempt);
        $attempt->increment('tab_switches');

        return response()->json(['tab_switches' => $attempt->tab_switches]);
    }
}
