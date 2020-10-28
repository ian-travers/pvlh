<?php

namespace App\Models;

use App\Notifications\LocomotiveApplicationCreated;
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
 * @property string $role
 * @property int|null $customer_id
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
 * @property-read mixed $customer
 * @property-read mixed $full_role
 * @property-read mixed $initials
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User query()
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereCustomerId($value)
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
 * @method static Builder|User whereRole($value)
 * @method static Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    public const ROLE_USER = 'user';
    public const ROLE_CUSTOMER = 'customer';
    public const ROLE_SA = 'sa';
    public const ROLE_NODSHP = 'nodshp';
    public const ROLE_NODT = 'nodt';
    public const ROLE_NODN = 'nodn';
    public const ROLE_NODZ = 'nodz';

    protected $fillable = [
        'name',
        'role',
        'customer_id',
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

    protected $appends = ['fullRole', 'customer', 'deletable'];

    public static function roles(): array
    {
        return [
            self::ROLE_USER => 'Пользователь системы (просмотр заявок, отчетов)',
            self::ROLE_CUSTOMER => 'Заказчик локомотивов (создание, редактирование, удаление заявок)',
            self::ROLE_SA => 'Администратор системы (управление НСИ, пользователями, заявками)',
            self::ROLE_NODSHP => 'Согласование заявок НОДШП',
            self::ROLE_NODT => 'Согласование заявок НОДТ',
            self::ROLE_NODN => 'Согласование заявок НОДН',
            self::ROLE_NODZ => 'Утверждение заявок НОДЗ1',
        ];
    }

    public function apps()
    {
        return $this->hasMany(LocomotiveApplication::class);
    }

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

    public function isUser(): bool
    {
        return $this->role === self::ROLE_USER;
    }

    public function isCustomer(): bool
    {
        return $this->role === self::ROLE_CUSTOMER;
    }

    public function isSA(): bool
    {
        return $this->role === self::ROLE_SA;
    }

    public function isNodshp(): bool
    {
        return $this->role === self::ROLE_NODSHP;
    }

    public function isNodt(): bool
    {
        return $this->role === self::ROLE_NODT;
    }

    public function isNodn(): bool
    {
        return $this->role === self::ROLE_NODN;
    }

    public function isNodz(): bool
    {
        return $this->role === self::ROLE_NODZ;
    }

    public function setAdminRights(): void
    {
        $this->update(['is_admin' => true]);
    }

    public function revokeAdminRights(): void
    {
        $this->update(['is_admin' => false]);
    }

    public function isCanBeDeleted(): bool
    {
        return !$this->apps->count();
    }

    public function getDeletableAttribute()
    {
        return $this->isCanBeDeleted();
    }

    public function initials(): string
    {
        return (new Initials())->name($this->name)->generate();
    }

    public static function browserNotified()
    {
        return self::where('is_browser_notified', true)
            ->whereNotNull('email_verified')
            ->get();
    }

    public static function emailNotified()
    {
        return self::where('is_email_notified', true)
            ->whereNotNull('email_verified')
            ->get();
    }

    public static function notifySubscribers(LocomotiveApplication $locApp)
    {
        foreach (self::browserNotified() as $subscriber) {
            if ($subscriber->id != $locApp->user_id) {
                $subscriber->notify(new LocomotiveApplicationCreated($locApp));
            }
        }
    }

    // Accessors
    public function getInitialsAttribute()
    {
        return $this->initials();
    }

    public function getFullRoleAttribute()
    {
        return self::roles()[$this->role];
    }

    public function getCustomerAttribute()
    {
        return $this->customer_id
            ? Customer::findOrFail($this->customer_id)->name
            : null;
    }

    // Administrator's actions
    public static function createByAdmin(array $data): self
    {
        $user = User::create([
            'name' => $data['name'],
            'role' => $data['role'],
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

    public function toggleBrowserNotification()
    {
        $this->update([
            'is_browser_notified' => !$this->is_browser_notified
        ]);
    }

    public function toggleEmailNotification()
    {
        $this->update([
            'is_email_notified' => !$this->is_email_notified
        ]);
    }

    public function setPassword(string $password)
    {
        $this->update([
            'password' => Hash::make($password)
        ]);
    }

    // Info for dashboard
    public static function getUsersInfo(): array
    {
        $countAll = User::count();
        $countVerified = User::whereNotNull('email_verified_at')->count();

        return compact('countAll', 'countVerified');
    }
}
