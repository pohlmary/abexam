<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\IeltsTest;
use Illuminate\Http\Request;

class IeltsTestController extends Controller
{
    public function index()
    {
        $tests = IeltsTest::where('is_published', true)
            ->where('status', 'active')
            ->with('creator')
            ->paginate(10);

        return response()->json($tests);
    }

    public function show(IeltsTest $test)
    {
        $test->load('sections.questions.options');
        return response()->json($test);
    }

    public function store(Request $request)
    {
        $this->authorize('create', IeltsTest::class);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:academic,general',
            'total_time' => 'required|integer|min:60',
            'price' => 'nullable|numeric|min:0',
        ]);

        $test = IeltsTest::create([
            ...$validated,
            'created_by' => auth()->id(),
        ]);

        return response()->json($test, 201);
    }

    public function update(Request $request, IeltsTest $test)
    {
        $this->authorize('update', $test);

        $validated = $request->validate([
            'title' => 'string|max:255',
            'description' => 'nullable|string',
            'type' => 'in:academic,general',
            'total_time' => 'integer|min:60',
            'status' => 'in:active,inactive',
            'is_published' => 'boolean',
            'price' => 'nullable|numeric|min:0',
        ]);

        $test->update($validated);

        return response()->json($test);
    }

    public function destroy(IeltsTest $test)
    {
        $this->authorize('delete', $test);
        $test->delete();

        return response()->json(['message' => 'Test deleted']);
    }
}
