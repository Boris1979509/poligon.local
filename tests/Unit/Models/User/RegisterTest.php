<?php

namespace Tests\Unit\Models\User;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Models\User;

class RegisterTest extends TestCase
{
    use DatabaseTransactions;

    public function testRequest(): void
    {
        $user = User::register('name1', 'email2', 'password');
        self::assertNotEmpty($user, 'User is empty.');
        self::assertEquals('name', $user->name, 'Name fields are not equal.');
        self::assertEquals('email', $user->email, 'Email fields are not equal.');

        self::assertNotEmpty($user->password, 'Password is empty.');
        self::assertEquals('password', $user->password, 'Password fields are not equal.');
        self::assertFalse($user->isActive(), 'Status is not waiting.');
    }

    public function testVerify(): void
    {
        $user = User::register('name', 'email', 'password');

        $user->verify();

        self::assertFalse($user->isWait(), 'Status is not active.');
        self::assertTrue($user->isActive());
    }

    public function testAlreadyVerified(): void
    {
        $user = User::register('name', 'email', 'password');
        $user->verify();

        $this->expectExceptionMessage('User is already verified.');
        $user->verify();
    }
}
