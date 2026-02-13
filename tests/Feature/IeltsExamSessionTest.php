<?php

namespace Tests\Feature;

use App\Models\IeltsTest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IeltsExamSessionTest extends TestCase
{
    use RefreshDatabase;

    public function test_student_can_start_exam(): void
    {
        $student = User::factory()->create(['role' => 'student']);
        $test = IeltsTest::factory()->create();

        $response = $this->actingAs($student)->postJson('/api/exam-sessions/start', [
            'test_id' => $test->id,
        ]);

        $response->assertStatus(201);
        $response->assertJsonStructure(['data' => ['id', 'test_id', 'user_id']]);
    }

    public function test_can_get_exam_session(): void
    {
        $student = User::factory()->create(['role' => 'student']);
        $test = IeltsTest::factory()->create();

        $attempt = $student->attempts()->create([
            'test_id' => $test->id,
            'started_at' => now(),
        ]);

        $response = $this->actingAs($student)->getJson("/api/exam-sessions/{$attempt->id}");

        $response->assertStatus(200);
        $response->assertJsonPath('data.id', $attempt->id);
    }

    public function test_student_can_submit_exam(): void
    {
        $student = User::factory()->create(['role' => 'student']);
        $test = IeltsTest::factory()->create();

        $attempt = $student->attempts()->create([
            'test_id' => $test->id,
            'started_at' => now(),
        ]);

        $response = $this->actingAs($student)->postJson("/api/exam-sessions/{$attempt->id}/submit", [
            'answers' => [],
        ]);

        $response->assertStatus(200);
    }
}
