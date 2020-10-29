<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\LocomotiveApplication
 *
 * @property int $id
 * @property int $user_id
 * @property int $sections
 * @property int $hours
 * @property int $count
 * @property \Illuminate\Support\Carbon $on_date
 * @property string $description
 * @property int $purpose_id
 * @property int $depot_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Depot $depot
 * @property-read \App\Models\Purpose $purpose
 * @property-read \App\Models\User $user
 * @method static Builder|LocomotiveApplication newModelQuery()
 * @method static Builder|LocomotiveApplication newQuery()
 * @method static Builder|LocomotiveApplication query()
 * @method static Builder|LocomotiveApplication whereCount($value)
 * @method static Builder|LocomotiveApplication whereCreatedAt($value)
 * @method static Builder|LocomotiveApplication whereDepotId($value)
 * @method static Builder|LocomotiveApplication whereDescription($value)
 * @method static Builder|LocomotiveApplication whereHours($value)
 * @method static Builder|LocomotiveApplication whereId($value)
 * @method static Builder|LocomotiveApplication whereOnDate($value)
 * @method static Builder|LocomotiveApplication wherePurposeId($value)
 * @method static Builder|LocomotiveApplication whereSections($value)
 * @method static Builder|LocomotiveApplication whereUpdatedAt($value)
 * @method static Builder|LocomotiveApplication whereUserId($value)
 * @mixin \Eloquent
 */
class LocomotiveApplication extends Model
{
    use HasFactory;

    public const SECTIONS_ONE = 1;
    public const SECTIONS_TWO = 2;

    protected $guarded = ['id'];

    protected $dates = ['on_date'];

    public static function sectionsList()
    {
        return [
            self::SECTIONS_ONE => 'Односекционный',
            self::SECTIONS_TWO => 'Двухсекционный',
        ];
    }

    public function depot()
    {
        return $this->belongsTo(Depot::class);
    }

    public function purpose()
    {
        return $this->belongsTo(Purpose::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sectionsName(): string
    {
        return self::sectionsList()[$this->sections];
    }
}
