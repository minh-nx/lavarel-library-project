<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'feedbacks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'book_id',
        'comment',
        'rating',
    ];

    /**
     * Get the book having the feedback
     */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    /**
     * Get the user giving the feedback
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
