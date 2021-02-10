<?php

namespace Tests\Unit;

use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_have_many_replies(): void
    {
        $firstComment = Comment::factory()->create();

        $this->assertCount(0, $firstComment->replies);

        $replies = Comment::factory()->count(3)->create([
            'parent_id' => $firstComment->id,
        ]);

        $this->assertCount(3, $firstComment->fresh()->replies);
        $this->assertInstanceOf(Comment::class, $firstComment->fresh()->replies->first());
        $this->assertDatabaseHas('comments', [
            'parent_id' => $firstComment->id,
            'name' => $replies->first()->name,
            'comment' => $replies->first()->comment,
        ]);
    }

    /** @test */
    public function comment_reply_can_be_replied(): void
    {
        $firstComment = Comment::factory()->create();
        $firstReply = Comment::factory()->create([
            'parent_id' => $firstComment->id,
        ]);

        $this->assertCount(0, $firstReply->replies);

        $replyToFirstReply = Comment::factory()->create([
            'parent_id' => $firstReply->id,
        ]);

        $this->assertCount(1, $firstReply->fresh()->replies);
        $this->assertInstanceOf(Comment::class, $replyToFirstReply);
        $this->assertDatabaseHas('comments', [
            'parent_id' => $firstReply->id,
            'name' => $replyToFirstReply->name,
            'comment' => $replyToFirstReply->comment,
        ]);
    }

    /** @test */
    public function comment_reply_can_have_many_replies(): void
    {
        $firstComment = Comment::factory()->create();
        $firstReply = Comment::factory()->create([
            'parent_id' => $firstComment->id,
        ]);

        $this->assertCount(0, $firstReply->replies);

        $repliesToFirstReply = Comment::factory()->count(5)->create([
            'parent_id' => $firstReply->id,
        ]);

        $this->assertCount(5, $firstReply->fresh()->replies);
    }

    /** @test */
    public function make_sure_that_the_comment_replies_pertain_to_the_actual_comment(): void
    {
        $firstComment = Comment::factory()->create();
        $firstCommentReplies = Comment::factory()->count(2)->create([
            'parent_id' => $firstComment->id,
        ]);

        $secondComment = Comment::factory()->create();
        $secondCommentReplies = Comment::factory()->count(6)->create([
            'parent_id' => $secondComment->id,
        ]);

        $this->assertCount(2, $firstComment->replies);
        $this->assertCount(6, $secondComment->replies);
        $this->assertEquals($firstComment->id, $firstCommentReplies->random()->parent_id);
        $this->assertEquals($secondComment->id, $secondCommentReplies->random()->parent_id);
    }
}
