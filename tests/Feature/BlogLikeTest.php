<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BlogLikeTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_to_login(): void
    {
        $post = Post::factory()->create();

        $this->post(route('blog.like', $post))
            ->assertRedirect(route('login'));
    }

    public function test_authenticated_user_can_like_and_unlike_a_post(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();

        $this->actingAs($user)->post(route('blog.like', $post));
        $this->assertTrue($post->fresh()->isLikedBy($user));

        $this->actingAs($user)->post(route('blog.like', $post));
        $this->assertFalse($post->fresh()->isLikedBy($user));
    }

    public function test_the_post_page_shows_the_like_button_and_count(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();
        $post->likedByUsers()->attach($user->id);

        $this->actingAs($user)
            ->get(route('blog.show', $post))
            ->assertOk()
            ->assertSee('1')
            ->assertSee(__('Liked'));
    }
}
