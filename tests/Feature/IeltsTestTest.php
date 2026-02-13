<?php

namespace Tests\Feature;

use App\Models\IeltsTest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IeltsTestTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_get_all_tests(): void
    {
        IeltsTest::factory()->count(3)->create();

        $response = $this->getJson('/api/tests');

        $response->assertStatus(200);
        $response->assertJsonCount(3, 'data');
    }

    public function test_can_get_single_test(): void
    {
        $test = IeltsTest::factory()->create();

        $response = $this->getJson("/api/tests/{$test->id}");

        $response->assertStatus(200);
        $response->assertJsonPath('data.title', $test->title);
    }

    public function test_admin_can_create_test(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->postJson('/api/tests', [
            'title' => 'New Test',
            'description' => 'Test Description',
            'duration' => 180,
            'total_marks' => 100,
            'passing_marks' => 60,
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('ielts_tests', ['title' => 'New Test']);
    }

    public function test_student_cannot_create_test(): void
    {
        $student = User::factory()->create(['role' => 'student']);

        $response = $this->actingAs($student)->postJson('/api/tests', [
            'title' => 'New Test',
            'description' => 'Test Description',
            'duration' => 180,
            'total_marks' => 100,
            'passing_marks' => 60,
        ]);

        $response->assertStatus(403);
    }
}
