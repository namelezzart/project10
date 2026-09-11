<?php

namespace Tests\Feature\Admin;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        $user = User::factory()->create();
        $user->admin = true;
        $user->save();

        return $user;
    }

    public function test_guest_is_redirected_to_login(): void
    {
        $this->get('/admin/posts')->assertRedirect('/login');
    }

    public function test_non_admin_user_is_forbidden(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('/admin/posts')
            ->assertForbidden();
    }

    public function test_admin_sees_posts_from_all_users(): void
    {
        $admin = $this->admin();
        $otherUser = User::factory()->create();
        Post::factory()->for($otherUser)->create(['title' => 'Someone else\'s post']);

        $this->actingAs($admin)
            ->get('/admin/posts')
            ->assertOk()
            ->assertSee("Someone else's post");
    }

    public function test_admin_can_update_any_users_post(): void
    {
        $admin = $this->admin();
        $owner = User::factory()->create();
        $post = Post::factory()->for($owner)->create();

        $this->actingAs($admin)
            ->put("/admin/posts/{$post->id}", [
                'title' => 'Edited by admin',
                'content' => $post->content,
            ])
            ->assertRedirect(route('admin.posts'));

        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'title' => 'Edited by admin',
        ]);
    }

    public function test_admin_can_delete_any_users_post(): void
    {
        $admin = $this->admin();
        $owner = User::factory()->create();
        $post = Post::factory()->for($owner)->create();

        $this->actingAs($admin)
            ->delete("/admin/posts/{$post->id}")
            ->assertRedirect(route('admin.posts'));

        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
    }
}
