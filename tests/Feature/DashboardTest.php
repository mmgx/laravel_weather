<?php
namespace Tests\Feature;

use Tests\TestCase;

/**
 * Class DashboardTest.
 */
class DashboardTest extends TestCase
{
    /** неаутентифицированный пользователь редиректится на страницу login */
    public function test_unauthenticated_users_cant_access_admin_dashboard()
    {
        $this->get(route('dashboard'))->assertRedirect('/login');
    }

    /**
     * админ может посетить страницу создания пользователей
     */
    public function test_admin_can_visit_user_create_page()
    {
        $this->loginAsAdmin();
        $response = $this->get(route('admin.auth.user.create'));
        $response->assertOk();
    }

    /**
     * пользователь не может посетить страницу создания пользователей
     */
    public function test_user_can_not_visit_user_create_page()
    {
        $this->loginAsUser();
        $response = $this->get(route('admin.auth.user.create'));
        $response->assertRedirect(route('dashboard'));
    }

    /**
     * пользователь не может посетить страницу создания пользователей
     */
    public function test_weather_current_without_auth()
    {
        $response = $this->get(route('test.weather.current', ['city' => 'Саранск']));
        $response->assertStatus(200);
    }

    /**
     * пользователь не может посетить страницу создания пользователей
     */
    public function test_weather_all_without_auth()
    {
        $response = $this->get(route('test.weather.all', ['city' => 'Саранск']));
        $response->assertStatus(200);
    }
}
