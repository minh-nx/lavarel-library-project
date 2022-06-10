<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Custom\Traits\Filterable;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Book extends Model
{
    use HasFactory, Filterable;

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
    ];

    /**
     * Pseudo field represents availability of the book
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function status() : Attribute
    {
        return Attribute::make(
            get: fn($value, $attributes) => ($attributes['quantity'] > 0) ? 'Available' : 'Unavailable',
        );
    }

    /**
     * Filter books by title using LIKE
     *
     * @param string $value
     * @return $query
     */
    public function filterTitle($query, $value)
    {
        return $query->where('title', 'LIKE', '%' . $value . '%');
    }

    /**
     * Filter books by author using LIKE
     *
     * @param string $value
     * @return $query
     */
    public function filterAuthor($query, $value)
    {
        return $query->where('author', 'LIKE', '%' . $value . '%');
    }

    /**
     * Filter books by publication year using LIKE
     *
     * @param string $value
     * @return $query
     */
    public function filterPublicationYear($query, $value)
    {
        return $query->where('publication_year', 'LIKE', '%' . $value . '%');
    }

    /**
     * Filter books by book types
     *
     * @param array $ids IDs of types to filter
     * @return $query
     */
    public function filterBooktypes($query, array $ids)
    {
        foreach($ids as $id) {
            $query->whereExists(function ($query) use($id){
                $query->select(DB::raw(1))
                    ->from('book_booktype')
                    ->whereColumn('book_booktype.book_id', 'books.id')
                    ->where('book_booktype.booktype_id', $id);
            });
        }

        return $query;
    }

    /**
     * Get unavailable books
     *
     * @return $query
     */
    public function scopeUnavailable($query)
    {
        return $query->where('quantity', 0);
    }

    /**
     * Get available books
     *
     * @return $query
     */
    public function scopeAvailable($query)
    {
        return $query->where('quantity', '>', 0);
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
        return User::whereIn('id', BorrowsHistory::select('user_id')
            ->where('book_id', $this->getAttribute('id'))
        );
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
     * Get the borrows history of the book
     */
    public function borrows_history()
    {
        return $this->hasMany(BorrowsHistory::class);
    }

    /**
     * Helper function to determined if a given user is borrowing
     *
     * @param int|User $user
     *
     * @return bool
     */
    public function isUserBorrowing($user) : bool
    {
        return $this->borrowingUsers->contains($user);
    }
}
