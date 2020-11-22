<?php

namespace Tests\Feature\Users;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class DeleteUserTest.
 */
class DeleteUserTest extends TestCase
{
    use RefreshDatabase;

    /** Администратор может удалять пользователя */
    public function test_admin_can_delete_user()
    {
        $this->loginAsAdmin();

        $user = User::factory()->create();
        $response = $this->delete(route('admin.auth.user.delete', ['user' => $user->id]));
        $response->assertSessionHas(['toast_success' => __('Успешно удален пользователь ' . $user->email)]);
        $this->assertSoftDeleted('users', ['id' => $user->id]);
    }

    /** Администратор может удалять пользователя */
    public function test_user_can_not_delete_user()
    {
        $this->loginAsUser();

        $user = User::factory()->create();
        $response = $this->delete(route('admin.auth.user.delete', ['user' => $user->id]));
        $response->assertRedirect(route('dashboard'));
        $response->assertSessionHas('flash_danger', __('У вас нет доступа'));
    }

    /** админ может перманентно удалять пользователей */
    public function test_admin_can_permanently_delete_users()
    {
        $this->loginAsAdmin();
        $user = User::factory()->create();
        $this->delete(route('admin.auth.user.delete', ['user' => $user->id]));
        $this->assertSoftDeleted('users', ['id' => $user->id]);
        $response = $this->delete(route('admin.auth.user.destroy', ['deletedUser' => $user->id]));
        $response->assertSessionHas(['toast_success' => __('Успешно уничтожен пользователь ' . $user->email)]);
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    /** пользователь не может перманентно удалять пользователей */
    public function test_user_can_not_permanently_delete_users()
    {
        $this->loginAsUser();
        $user = User::factory()->create();
        $response = $this->delete(route('admin.auth.user.destroy', ['deletedUser' => $user->id]));
        $response->assertSessionHas(['flash_danger' => __('У вас нет доступа')]);
        $this->assertDatabaseHas('users', ['id' => $user->id]);
    }

    /** Администратор может восстанавливат пользоателей */
    public function test_admin_can_restore_users()
    {
        $this->loginAsAdmin();
        $user = User::factory()->create();
        $this->delete(route('admin.auth.user.delete', ['user' => $user->id]));
        $this->assertSoftDeleted('users', ['id' => $user->id]);
        $response = $this->patch(route('admin.auth.user.restore', ['deletedUser' => $user->id]));
        $response->assertSessionHas(['toast_success' => __('Успешно восстановлен пользователь ' . $user->email)]);
        $this->assertDatabaseHas('users', ['id' => $user->id]);
    }

    /** Пользователь не может восстанавливат пользоателей */
    public function test_users_can_not_restore_users()
    {
        $this->loginAsUser();
        $user = User::factory()->create(['deleted_at' => Carbon::now()]);
        $response = $this->patch(route('admin.auth.user.restore', ['deletedUser' => $user->id]));
        $response->assertSessionHas(['flash_danger' => __('У вас нет доступа')]);
        $this->assertDatabaseHas('users', ['id' => $user->id]);
    }
}
