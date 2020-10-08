<?php

namespace App\Models;

use Hash;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use LasseRafn\Initials\Initials;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $position
 * @property bool $is_browser_notified
 * @property bool $is_email_notified
 * @property bool $is_admin
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $initials
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User query()
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereEmailVerifiedAt($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereIsAdmin($value)
 * @method static Builder|User whereIsBrowserNotified($value)
 * @method static Builder|User whereIsEmailNotified($value)
 * @method static Builder|User whereName($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User wherePosition($value)
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'position',
        'email',
        'password',
        'is_browser_notified',
        'is_email_notified',
        'is_admin',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_browser_notified' => 'boolean',
        'is_email_notified' => 'boolean',
        'is_admin' => 'boolean',
    ];

    public function hasBrowserNotifications()
    {
        return $this->email_verified_at ? $this->is_browser_notified : false;
    }

    public function hasEmailNotifications()
    {
        return $this->email_verified_at ? $this->is_email_notified : false;
    }

    public function isAdmin(): bool
    {
        return $this->is_admin;
    }

    public function setAdminRights(): void
    {
        $this->update(['is_admin' => true]);
    }

    public function revokeAdminRights(): void
    {
        $this->update(['is_admin' => false]);
    }

    public function isCanBeDeleted()
    {
        // TODO: Check for everything that might interfere...
        return true;
    }

    public function initials(): string
    {
        return (new Initials())->name($this->name)->generate();
    }

    public function getInitialsAttribute()
    {
        return $this->initials();
    }

    // Administrator's actions
    public static function createByAdmin(array $data): self
    {
        $user = User::create([
            'name' => $data['name'],
            'position' => $data['position'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $user->markEmailAsVerified();

        return $user;
    }

    public function editByAdmin(array $data): self
    {
        $this->update($data);

        return $this;
    }
}
