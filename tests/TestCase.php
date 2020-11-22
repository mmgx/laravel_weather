<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication/*, RefreshDatabase*/;

    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('migrate:refresh');
        Artisan::call('db:seed');
    }

    protected function getAdmin()
    {
        return User::find(1);
    }

    protected function getUser()
    {
        return User::find(2);
    }

    /**
     * залогиниться админом
     * @return mixed
     */
    protected function loginAsAdmin()
    {
        $admin = $this->getAdmin();
        $this->actingAs($admin, 'web');
        return $admin;
    }

    /**
     * залогиниться пользователем
     * @return mixed
     */
    protected function loginAsUser()
    {
        $user = $this->getUser();
        $this->actingAs($user, 'web');

        return $user;
    }

    protected function logout()
    {
        return auth()->logout();
    }

    protected function resetAuth(array $guards = null)
    {
        $guards = $guards ?: array_keys(config('auth.guards'));

        foreach ($guards as $guard) {
            $guard = $this->app['auth']->guard($guard);

            if ($guard instanceof \Illuminate\Auth\SessionGuard) {
                $guard->logout();
            }
        }

        $protectedProperty = new \ReflectionProperty($this->app['auth'], 'guards');
        $protectedProperty->setAccessible(true);
        $protectedProperty->setValue($this->app['auth'], []);
    }
}
