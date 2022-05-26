<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'firstname',
        'lastname',
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Get the feedbacks of the user
     */
    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }

    /**
     * Get the books the user borrowed
     */
    public function books()
    {
        return $this->belongsToMany(Book::class, 'borrows')
                    ->using(Borrow::class)
                    ->as('borrows')
                    ->withPivot(['borrowed_date', 'due_date', 'returned_date']);
    }

    /**
     * Get the books the user has returned
     */
    public function returnedBooks()
    {
        return $this->books()->wherePivotNotNull('returned_date');
    }

    /**
     * Get the books the user is borrowing
     */
    public function borrowingBooks()
    {
        return $this->books()->wherePivotNull('returned_date');
    }

    /**
     * Get the books the user gave feedbacks to
     */
    public function feedbackBooks()
    {
        return $this->hasManyThrough(Book::class, Feedback::class);
    }

    /**
     * Always encrypt the password when it is set/updated.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function password() : Attribute
    {
        return Attribute::make(
            set: fn($value) => bcrypt($value),
        );
    }

    /**
     * Always convert the first character of each words in firstname to uppercase when it is set/updated.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function firstname() : Attribute
    {
        return Attribute::make(
            set: fn($value) => ucwords($value),
        );
    }

    /**
     * Always convert the first character of each words in lastname to uppercase when it is set/updated.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function lastname() : Attribute
    {
        return Attribute::make(
            set: fn($value) => ucwords($value),
        );
    }

    /**
     * Pseudo attribute represents the full name of the user
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function fullname() : Attribute
    {
        return Attribute::make(
            get: fn($value, $attributes) => $attributes['firstname'] . ' ' . $attributes['lastname'],
        );
    }
}
