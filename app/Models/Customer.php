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
}
