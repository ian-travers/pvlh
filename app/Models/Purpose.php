<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Purpose
 *
 * @property int $id
 * @property string $name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\LocomotiveApplication[] $apps
 * @property-read int|null $apps_count
 * @method static Builder|Purpose newModelQuery()
 * @method static Builder|Purpose newQuery()
 * @method static Builder|Purpose query()
 * @method static Builder|Purpose whereId($value)
 * @method static Builder|Purpose whereName($value)
 * @mixin \Eloquent
 */
class Purpose extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public $timestamps = false;

    public function apps()
    {
        return $this->hasMany(LocomotiveApplication::class);
    }

    public function isDeletable(): bool
    {
        return !$this->apps->count();
    }
}
