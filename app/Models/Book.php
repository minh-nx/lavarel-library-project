<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Custom\Traits\Filterable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory, Filterable, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'books';

    /**
     * The attributes that are exactly filterable
     *
     * @var array<string, string>
     */
    protected $filterable = [
        'publication_year',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'author',
        'publication_year',
        'cover_image',
        'description',
        'quantity',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'publication_year' => 'integer',
    ];

    /**
     * Filter a book's title using LIKE
     *
     * @var array<string, string>
     */
    public function filterTitle($query, $value)
    {
        return $query->where('title', 'LIKE', '%' . $value . '%');
    }

    /**
     * Filter a book's author using LIKE
     *
     * @var array<string, string>
     */
    public function filterAuthor($query, $value)
    {
        return $query->where('author', 'LIKE', '%' . $value . '%');
    }

    /**
     * Filter a book's description using LIKE
     *
     * @var array<string, string>
     */
    public function filterDescription($query, $value)
    {
        return $query->where('author', 'LIKE', '%' . $value . '%');
    }

    /**
     * Get the booktypes of the book
     */
    public function booktypes()
    {
        return $this->belongsToMany(Booktype::class, 'book_booktype');
    }

    /**
     * Get the feedbacks for the book
     */
    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }

    /**
     * Get the feedbacks for the book, sorted by updated time (with eager loading for users relation by default)
     */
    public function sortedFeedbacks(bool $withUsers = true, string $orderBy = "DESC")
    {
        $query = $this->feedbacks();
        if($withUsers) {
            $query = $query->with('user');
        }

        return $query->orderBy('feedbacks.updated_at', $orderBy);
    }

    /**
     * Get the users borrowing/borrowed the book
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'borrows')
                    ->using(Borrow::class)
                    ->as('borrows')
                    ->withPivot(['borrowed_date', 'due_date', 'returned_date']);
    }

    /**
     * Get the users whose lease time expired
     */
    public function overdueUsers()
    {
        return $this->users()->wherePivot(['due_date', '<=', now()]);
    }

    /**
     * Get the users returned the book
     */
    public function returnedUsers()
    {
        return $this->users()->wherePivotNotNull('returned_date');
    }

    /**
     * Get the users borrowing the book
     */
    public function borrowingUsers()
    {
        return $this->users()->wherePivotNull('returned_date');
    }

    /**
     * Get the users who gave feedbacks to the book
     */
    public function feedbackUsers()
    {
        return $this->hasManyThrough(User::class, Feedback::class);
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Database\Factories\BookFactory::new();
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Helper function to determined if a given user is borrowing
     *
     * @param int|User $user
     * 
     * @return string
     */
    public function isUserBorrowing($user) : bool
    {
        return $this->borrowingUsers->contains($user);
    }
}
