<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Purpose
 *
 * @property int $id
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|Purpose newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Purpose newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Purpose query()
 * @method static \Illuminate\Database\Eloquent\Builder|Purpose whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Purpose whereName($value)
 * @mixin \Eloquent
 * @noinspection PhpFullyQualifiedNameUsageInspection
 */
class Purpose extends Model
{
    protected $guarded = ['id'];

    public $timestamps = false;
}
