<?php

namespace App\Http\Controllers\User\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;
use App\Models\Borrow;
use App\Http\Requests\Client\BorrowBookRequest;

class BorrowBookController extends Controller
{
    /**
     * Show all borrowing books
     * 
     * 
     * @return Renderable
     */
    public function index()
    {
        $this->authorize('viewAnyBorrow', Book::class);
    }

    /**
     * Display borrow book form.
     * 
     * @param \App\Models\Book $book
     * 
     * @return Renderable
     */
    public function create(Book $book)
    {
        $this->authorize('borrow', $book);

        if($book->isUserBorrowing(auth()->user())) {
            return redirect()->route('books.borrows.show', ['book' => $book]);
        }

        $user = User::find(auth()->user()->id);

        if($book->quantity <= 0 || !($user->borrowingBooks()->count() < Borrow::MAX_BORROW_COUNT)) {
            return redirect()->back();
        }

        return view('client.borrow-books-create', ['book' => $book]);
    }

    /**
     * Handle borrow form.
     * 
     * @param \App\Http\Requests\Client\BorrowBookRequest $request
     * @param \App\Models\Book $book
     * 
     * @return Renderable
     */
    public function store(BorrowBookRequest $request, Book $book)
    {
        $this->authorize('borrow', $book);

        $data = $request->validated();

        $book->users()->attach(auth()->user()->id, [
            'borrowed_date' => $data['borrowed_date'],
            'due_date' => $data['due_date'],
        ]);

        $book->quantity -= 1;
        $book->save();

        return redirect()->route('books.show', ['book' => $book])->with('success', 'The borrow request created successfully');
    }

    /**
     * Display the specified borrow form
     * 
     * @param \App\Models\Book $book
     * 
     * @return Renderable
     */
    public function show(Book $book)
    {
        $this->authorize('viewBorrow', $book);

        $user = $book->users->find(auth()->user()->id);
        $from = $user->borrows->borrowed_date;
        $to = $user->borrows->due_date;

        return view('client.borrow-books-show', ['book' => $book, 'from' => $from, 'to' => $to]);
    }

    /**
     * Display the specified borrow form
     * 
     * @param \App\Models\Book $book
     * 
     * @return Renderable
     */
    public function destroy(Book $book)
    {
        $this->authorize('deleteBorrow', $book);

        $book->users()->detach(auth()->user()->id);

        $book->quantity += 1;
        $book->save();

        return redirect()->route('books.show', ['book' => $book])->with('success', 'The borrow request deleted successfully');
    }
}
