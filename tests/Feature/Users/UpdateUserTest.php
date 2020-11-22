<?php

namespace Tests\Feature\Users;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

/**
 * Class UpdateUserTest.
 */
class UpdateUserTest extends TestCase
{
    use RefreshDatabase;

    /** администратор имеет доступ к странице редактирования пользователя */
    public function test_an_admin_can_access_the_edit_user_page()
    {
        $this->loginAsAdmin();
        $user = User::factory()->create();
        $response = $this->get(route('admin.auth.user.edit', [ 'user' => $user->id ]));
        $response->assertOk();
    }

    /** Администратор может обновлять информации о пользователях */
    public function test_admin_can_update_users()
    {
        $name = Str::random(20);
        $email = Str::random(20) . '@site.com';

        $updatedName = 'upd_' . $name;
        $updatedEmail = 'upd_' . $email;

        $this->loginAsAdmin();
        $user = User::factory()->create();

        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
            'name' => $name,
            'email' => $email,
        ]);

        $response = $this->patch(route('admin.auth.user.update', $user->id), [
            'name' => $updatedName,
            'email' => $updatedEmail,
        ]);

        $response->assertSessionHas('toast_success', __('Успешно обновлен пользователь ' . $updatedEmail));

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => $updatedName,
            'email' => $updatedEmail,
        ]);
    }

    /** Только администратор может просматривать страницу редактирования администратора */
    public function test_only_admin_can_view_edit_admin_page()
    {
        $admin = $this->loginAsAdmin();
        $this->get(route('admin.auth.user.edit', [ 'user' => $admin->id ]))->assertOk();
        $this->resetAuth();

        $user = $this->loginAsUser();
        $this->actingAs($user);
        $response = $this->get(route('admin.auth.user.edit', [ 'user' => $admin->id ]));
        $response->assertRedirect(route('login'));
    }

    /** Администратор может обновить информацию о себе */
    public function test_only_admin_can_update_admin()
    {
        $admin = $this->loginAsAdmin();
        $adminName = $admin->name;

        $response = $this->patch(route('admin.auth.user.update', [ 'user' => $admin->id ]), [
            'name' => $adminName . '_upd',
            'email' => $admin->email,
        ]);
        $response->assertSessionHas('toast_success', __('Успешно обновлен пользователь ' . $admin->email));

        $this->assertDatabaseHas('users', [
            'name' => $adminName . '_upd',
            'email' => $admin->email,
        ]);
    }
}
