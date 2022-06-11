<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * ユーザーのログイン処理
     *
     * @param User|null $user 
     * @return User $user
     */
    public function login(User $user = null)
    {
        $user = $user ?? User::factory()->create(); 
        $this->actingAs($user);

        return $user;
    }
}
