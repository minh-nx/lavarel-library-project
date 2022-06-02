<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

class BorrowsHistory extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'borrows_history';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'id',
    ];

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
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    protected $dateFormat = 'Y-m-d';

    /**
     * Get the book having the borrow history
     */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    /**
     * Get the user having the borrow history
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

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
