<?php

namespace Tests\Feature;

use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_add_new_comment()
    {
        $commentToAdd = Comment::factory()->make();

        $response = $this->json('POST', '/api/comments', [
            'name' => $commentToAdd->name,
            'comment' => $commentToAdd->comment,
        ]);

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'name' => $commentToAdd->name,
            'comment' => $commentToAdd->comment,
            'level' => $commentToAdd->level,
        ]);
        $this->assertDatabaseHas('comments', [
            'name' => $commentToAdd->name,
            'comment' => $commentToAdd->comment,
            'level' => $commentToAdd->level,
            'parent_id' => null,
        ]);
    }

    /** @test */
    public function name_is_required()
    {
        $commentToAdd = Comment::factory()->make();

        $response = $this->json('POST', '/api/comments', [
            'comment' => $commentToAdd->comment,
            'level' => 1,
        ]);

        $response->assertStatus(422);
    }

    /** @test */
    public function comment_is_required()
    {
        $commentToAdd = Comment::factory()->make();

        $response = $this->json('POST', '/api/comments', [
            'name' => $commentToAdd->name,
            'level' => 1,
        ]);

        $response->assertStatus(422);
    }
}
