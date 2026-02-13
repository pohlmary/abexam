<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\IeltsAttempt;
use Illuminate\Http\Request;

class IeltsResultController extends Controller
{
    public function index(Request $request)
    {
        $results = IeltsAttempt::where('user_id', auth()->id())
            ->where('status', '!=', 'in_progress')
            ->with('test', 'answers')
            ->orderByDesc('finished_at')
            ->paginate(10);

        return response()->json($results);
    }

    public function show(IeltsAttempt $attempt)
    {
        $this->authorize('view', $attempt);

        return response()->json($attempt->load('test.sections.questions', 'answers.question'));
    }

    public function getStatistics(Request $request)
    {
        $user = auth()->user();
        $attempts = $user->attempts()->where('status', '!=', 'in_progress')->get();

        $stats = [
            'total_attempts' => $attempts->count(),
            'average_band' => $attempts->avg('overall_band'),
            'highest_band' => $attempts->max('overall_band'),
            'passed_count' => $attempts->where('overall_band', '>=', 6.0)->count(),
            'average_listening' => $attempts->avg('listening_score'),
            'average_reading' => $attempts->avg('reading_score'),
            'average_writing' => $attempts->avg('writing_score'),
            'average_speaking' => $attempts->avg('speaking_score'),
        ];

        return response()->json($stats);
    }
}
