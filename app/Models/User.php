<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticated;
use Illuminate\Support\Str;

/**
 * @property int $id
 * @property string $name
 * @property string $last_name
 * @property string $email
 * @property string $phone
 * @property bool $phone_verified
 * @property string $password
 * @property string $verify_token
 * @property string $phone_verify_token
 * @property Carbon $phone_verify_token_expire
 * @property boolean $phone_auth
 * @property string $role
 * @property string $status
 *
 * @property Network[] networks
 *
 * @method Builder byNetwork(string $network, string $identity)
 */
class User extends Authenticated
{
    use Notifiable;

    public const STATUS_WAIT = 'wait';
    public const STATUS_ACTIVE = 'active';

    public const ROLE_USER = 'user';
    public const ROLE_MODERATOR = 'moderator';
    public const ROLE_ADMIN = 'admin';

    protected $fillable = [
        'name',
        'last_name',
        'email',
        'phone',
        'password',
        'email_verified_at',
        'verify_token',
        'status',
        'role',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'phone_verified'            => 'boolean',
        'phone_verify_token_expire' => 'datetime',
        'phone_auth'                => 'boolean',
    ];

    public static function rolesList(): array
    {
        return [
            self::ROLE_USER      => 'User',
            self::ROLE_MODERATOR => 'Moderator',
            self::ROLE_ADMIN     => 'Admin',
        ];
    }

    /**
     * @param string $name
     * @param string $email
     * @param string $password
     * @return User
     */
    public static function register(string $name, string $email, string $password): self
    {
        return static::create([
            'name'         => $name,
            'email'        => $email,
            'password'     => bcrypt($password),
            'verify_token' => Str::uuid(),
            'role'         => self::ROLE_USER,
            'status'       => self::STATUS_WAIT,
        ]);
    }

    /**
     * Create a new user in admin
     * @param $name
     * @param $email
     * @return User
     */
    public static function new($name, $email): self
    {
        return static::create([
            'name'              => $name,
            'email'             => $email,
            'password'          => Str::uuid(),
            'email_verified_at' => now(),
            'role'              => self::ROLE_USER,
            'status'            => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * @return bool
     */
    public function isWait(): bool
    {
        return $this->status === self::STATUS_WAIT;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    /**
     * Add status user active
     */
    public function verify(): void
    {
        if (!$this->isWait()) {
            throw new \DomainException('User is already verified.');
        }

        $this->update([
            'status'            => self::STATUS_ACTIVE,
            'verify_token'      => null,
            'email_verified_at' => now(),
        ]);
    }

    /**
     * @param $role
     */
    public function changeRole($role): void
    {
        if (!array_key_exists($role, self::rolesList())) {
            throw new \InvalidArgumentException('Undefined role "' . $role . '"');
        }
        if ($this->role === $role) {
            throw new \DomainException('Role is already assigned.');
        }
        $this->update(['role' => $role]);
    }

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }
}
