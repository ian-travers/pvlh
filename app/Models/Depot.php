<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Depot
 *
 * @property int $id
 * @property string $name
 * @method static Builder|Depot newModelQuery()
 * @method static Builder|Depot newQuery()
 * @method static Builder|Depot query()
 * @method static Builder|Depot whereId($value)
 * @method static Builder|Depot whereName($value)
 * @mixin \Eloquent
 */
class Depot extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public $timestamps = false;
}
