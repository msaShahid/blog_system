<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CheckRoleMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_admin_can_access_admin_route()
    {

        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);  

        $response = $this->get(route('admin.dashboard'));

        $response->assertStatus(200);
    }

    /** @test */
    public function a_user_cannot_access_admin_route()
    {
        $user = User::factory()->create(['role' => 'user']);
        $this->actingAs($user); 

        $response = $this->get(route('admin.dashboard'));

        $response->assertRedirect(route('user.dashboard'));
    }

    /** @test */
    public function a_user_can_access_user_route()
    {
        $user = User::factory()->create(['role' => 'user']);
        $this->actingAs($user);  

        $response = $this->get(route('user.dashboard'));

        $response->assertStatus(200);
    }

    /** @test */
    public function an_admin_cannot_access_user_route()
    {

        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);  

        $response = $this->get(route('user.dashboard'));

        $response->assertRedirect(route('admin.dashboard'));
    }

    /** @test */
    public function an_unauthenticated_user_is_redirected_to_login()
    {
        $response = $this->get(route('admin.dashboard'));

        $response->assertRedirect(route('login')); 

        $response = $this->get(route('user.dashboard'));

        $response->assertRedirect(route('login'));
    }
}
