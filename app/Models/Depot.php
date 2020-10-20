<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Depot
 *
 * @property int $id
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|Depot newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Depot newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Depot query()
 * @method static \Illuminate\Database\Eloquent\Builder|Depot whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Depot whereName($value)
 * @mixin \Eloquent
 * @noinspection PhpFullyQualifiedNameUsageInspection
 */
class Depot extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public $timestamps = false;
}
