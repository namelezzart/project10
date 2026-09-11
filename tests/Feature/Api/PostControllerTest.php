<?php

namespace Tests\Feature\Api;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_only_published_posts(): void
    {
        Post::factory()->count(2)->create();
        Post::factory()->draft()->create();

        $response = $this->getJson('/api/posts');

        $response->assertOk()
            ->assertJsonCount(2, 'data');
    }

    public function test_show_returns_a_published_post(): void
    {
        $post = Post::factory()->create();

        $this->getJson("/api/posts/{$post->id}")
            ->assertOk()
            ->assertJsonFragment(['id' => $post->id]);
    }

    public function test_show_returns_404_for_a_draft_post(): void
    {
        $post = Post::factory()->draft()->create();

        $this->getJson("/api/posts/{$post->id}")
            ->assertNotFound();
    }

    public function test_store_requires_authentication(): void
    {
        $this->postJson('/api/posts', [
            'title' => 'Hello',
            'content' => 'World',
        ])->assertUnauthorized();
    }

    public function test_store_validates_required_fields(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->postJson('/api/posts', [])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['title', 'content']);
    }

    public function test_authenticated_user_can_create_a_post(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson('/api/posts', [
            'title' => 'My post',
            'content' => 'Some content',
        ]);

        $response->assertCreated()
            ->assertJsonFragment(['title' => 'My post']);

        $this->assertDatabaseHas('posts', [
            'title' => 'My post',
            'user_id' => $user->id,
        ]);
    }

    public function test_user_cannot_update_another_users_post(): void
    {
        $owner = User::factory()->create();
        $other = User::factory()->create();
        $post = Post::factory()->for($owner)->create();

        $this->actingAs($other)
            ->putJson("/api/posts/{$post->id}", ['title' => 'Hacked'])
            ->assertForbidden();
    }

    public function test_owner_can_update_their_post(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->for($user)->create(['title' => 'Old title']);

        $this->actingAs($user)
            ->putJson("/api/posts/{$post->id}", ['title' => 'New title'])
            ->assertOk()
            ->assertJsonFragment(['title' => 'New title']);
    }

    public function test_owner_can_delete_their_post(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->for($user)->create();

        $this->actingAs($user)
            ->deleteJson("/api/posts/{$post->id}")
            ->assertNoContent();

        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
    }

    public function test_like_toggles_on_and_off(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();

        $this->actingAs($user)
            ->postJson("/api/posts/{$post->id}/like")
            ->assertOk()
            ->assertJson(['liked' => true, 'likes_count' => 1]);

        $this->actingAs($user)
            ->postJson("/api/posts/{$post->id}/like")
            ->assertOk()
            ->assertJson(['liked' => false, 'likes_count' => 0]);
    }
}
