<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Customer
 *
 * @property int $id
 * @property string $name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static Builder|Customer newModelQuery()
 * @method static Builder|Customer newQuery()
 * @method static Builder|Customer query()
 * @method static Builder|Customer whereId($value)
 * @method static Builder|Customer whereName($value)
 * @mixin \Eloquent
 */
class Customer extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public $timestamps = false;

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function isDeletable(): bool
    {
        return !$this->users->count();
    }
}
