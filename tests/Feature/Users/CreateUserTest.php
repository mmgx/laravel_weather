<?php

namespace Tests\Feature\Users;

use App\Models\User;
use Illuminate\Support\Str;
use Tests\TestCase;

/**
 * Class CreateUserTest.
 */
class CreateUserTest extends TestCase
{
    /** администратор может открыть страницу создания пользователей */
    public function test_admin_can_visit_create_user_page()
    {
        $this->loginAsAdmin();
        $response = $this->get(route('admin.auth.user.create'));
        $response->assertOk();
    }

    /** пользователь не может посетить страницу создания пользователя */
    public function test_user_can_not_visit_create_user_page()
    {
        $this->loginAsUser();
        $response = $this->get(route('admin.auth.user.create'));
        $response->assertSessionHas('flash_danger', __('У вас нет доступа'));
    }

    /** наличие валидации при создании пользователя */
    public function test_create_user_requires_validation()
    {
        $this->loginAsAdmin();
        $response = $this->post('/admin/users');
        $response->assertSessionHasErrors(['name', 'email']);
    }

    /** почта требует уникальности */
    public function test_user_email_needs_to_be_unique()
    {
        $name = $this->randomName();
        $email = $this->randomEmail();

        $this->loginAsAdmin();

        User::factory()->create([
            'name' => $name,
            'email' => $email,
        ]);

        $response = $this->post('/admin/users', [
            'name' => $name,
            'email' => $email,
        ]);

        $response->assertSessionHasErrors('email');
    }

    /** Админ может создать пользователя */
    public function test_admin_can_create_new_user()
    {
        $this->loginAsAdmin();
        $name = $this->randomName();
        $email = $this->randomEmail();

        $response = $this->post('/admin/users', [
            'name' => $name,
            'email' => $email,
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertDatabaseHas(
            'users',
            [
                'name' => $name,
                'email' => $email,
            ]
        );

        $response->assertSessionHas(['toast_success' => __('Успешно создан пользователь ' . $email)]);
    }

    /** Пользователь не может создать другого пользователя */
    public function test_user_can_not_create_new_user()
    {
        $this->loginAsUser();
        $name = $this->randomName();
        $email = $this->randomEmail();

        $response = $this->post('/admin/users', [
            'name' => $name,
            'email' => $email,
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertDatabaseMissing(
            'users',
            [
                'name' => $name,
                'email' => $email,
            ],
        );

        $response->assertSessionMissing(['toast_success' => __('Успешно создан пользователь ' . $email)]);
    }

    /**
     * генерация рандомного имени пользователя
     * @return string
     */
    public function randomName(): string
    {
        return Str::random(20);
    }

    /**
     * генерация рандомной почты
     * @return string
     */
    public function randomEmail(): string
    {
        return Str::random(10) .'@'. Str::random(10). '.com';
    }
}
