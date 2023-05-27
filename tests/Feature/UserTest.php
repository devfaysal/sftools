<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\TestHelper;

class UserTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function it_prevents_unauthenticated_access_to_user_create_form()
    {
        $response = $this->get(route('users.create'));
        $response->assertStatus(302);
    }

    /** @test */
    public function it_prevents_unauthorized_access_to_user_create_form()
    {
        // $this->withoutExceptionHandling();
        $this->actingAs(TestHelper::admin(), 'admin');
        $response = $this->get(route('users.create'));
        $response->assertStatus(403);
    }

    /** @test */
    public function it_allows_authorized_access_to_user_create_form()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(TestHelper::admin(['manage_users']), 'admin');
        $response = $this->get(route('users.create'));
        $response->assertStatus(200);
    }

    /** @test */
    public function user_create_form_has_correct_fields()
    {
        $this->actingAs(TestHelper::admin(['manage_users']), 'admin');
        $response = $this->get(route('users.create'));
        $response->assertStatus(200);
        $response->assertViewIs('users.create');
        
        $user = User::factory()->make();
        $attributes = $user->toArray();
        unset($attributes['email_verified_at']);
        unset($attributes['remember_token']);
        foreach($attributes as $key => $value ){
            $response->assertSee($key);
        }
    }

    /** @test */
    public function users_can_be_storred_in_database()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(TestHelper::admin(['manage_users']), 'admin');
        $user = User::factory()->make();
        $attributes = $user->toArray();
        $attributes['password'] = 'password';
        $response = $this->post(route('users.store'), $attributes);
        $response->assertRedirect(route('users.index'));
        unset($attributes['password']);
        unset($attributes['email_verified_at']);
        $this->assertDatabaseHas('users', $attributes);
    }

    /** @test */
    public function user_update_form_has_correct_fields()
    {
        $this->actingAs(TestHelper::admin(['manage_users']), 'admin');
        $user = User::factory()->create();
        $response = $this->get(route('users.edit', $user->id));
        $response->assertStatus(200);
        $response->assertViewIs('users.edit');
        
        $attributes = $user->toArray();
        unset($attributes['email_verified_at']);
        unset($attributes['remember_token']);
        unset($attributes['updated_at']);
        unset($attributes['created_at']);
        foreach($attributes as $key => $value ){
            $response->assertSee($key);
        }
        $response->assertViewHas('user', $user);
    }

    /** @test */
    public function updated_users_info_can_be_updated_in_database()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(TestHelper::admin(['manage_users']), 'admin');
        $user = User::factory()->create();
        $attributes = $user->toArray();
        $attributes['password'] = 'changedpassword';
        $attributes['first_name'] = 'Updated First Name';
        $response = $this->patch(route('users.update', $user->id), $attributes);
        $response->assertRedirect(route('users.index'));
        unset($attributes['password']);
        unset($attributes['email_verified_at']);
        unset($attributes['updated_at']);
        unset($attributes['created_at']);
        $this->assertDatabaseHas('users', $attributes);
    }

}
