<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

class Borrow extends Pivot
{
    public const BORROW_MAX_COUNT = 5;
    public const BORROW_MAX_DAY = 30;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'borrows';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = []; // All attributes are mass assignable

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
    ];

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    protected $dateFormat = 'Y-m-d';

    /**
     * Always format the borrowed date after retrieving it
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function borrowed_date() : Attribute
    {
        return Attribute::make(
            get: fn($value) => (new Carbon($value))->format($this->dateFormat),
        );
    }

    /**
     * Always format the due date after retrieving it
     * 
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function due_date() : Attribute
    {
        return Attribute::make(
            get: fn($value) => (new Carbon($value))->format($this->dateFormat),
        );
    }

    /**
     * Always format the returned date after retrieving it (if any)
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function returned_date() : Attribute
    {
        return Attribute::make(
            get: array_key_exists('returned_date', $this->attributes) ? (fn($value) => (new Carbon($value))->format($this->dateFormat)) : null,
        );
    }
}
