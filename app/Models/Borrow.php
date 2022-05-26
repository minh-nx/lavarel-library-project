<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Borrow extends Pivot
{
    public const MAX_BORROW_COUNT = 2;
    
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
        'borrowed_date' => 'date',
        'due_date' => 'date',
        'returned_date' => 'date',
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
}
