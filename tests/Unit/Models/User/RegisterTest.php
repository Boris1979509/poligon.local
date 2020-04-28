<?php

namespace Tests\Unit\Models\User;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Models\User;

class RegisterTest extends TestCase
{
    use DatabaseTransactions;

    protected $name = 'name';
    protected $email = 'email';
    protected $password = 'password';

    public function testRequest(): void
    {
        $user = User::register($this->name, $this->email, $this->password);
        self::assertNotEmpty($user, 'User is empty.');
        self::assertEquals($this->name, $user->name, 'Name fields are not equal.');
        self::assertEquals($this->email, $user->email, 'Email fields are not equal.');

        self::assertNotEmpty($user->password, 'Password is empty.');
        self::assertFalse($user->isActive(), 'Status is not waiting.');
    }

    public function testVerify(): void
    {
        $user = User::register($this->name, $this->email, $this->password);

        $user->verify();

        self::assertFalse($user->isWait(), 'Status is not active.');
        self::assertTrue($user->isActive());
    }

    public function testAlreadyVerified(): void
    {
        $user = User::register($this->name, $this->email, $this->password);
        $user->verify();

        $this->expectExceptionMessage('User is already verified.');
        $user->verify();
    }
}
