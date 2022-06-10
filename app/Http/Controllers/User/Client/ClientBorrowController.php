<?php

namespace App\Http\Controllers\User\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;
use App\Models\Borrow;
use App\Http\Requests\Client\BorrowBookRequest;
use App\Models\BorrowsHistory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;

class ClientBorrowController extends Controller
{
    /**
     * Show all borrowing books of the current user
     *
     * @return Renderable
     */
    public function index(User $user)
    {
        Gate::authorize('books.borrows.read');
        //$user = auth()->user();

        $records = BorrowsHistory::with('book')->whereBelongsTo($user)
            ->orderBy('borrowed_date', 'DESC')
            ->paginate();

        return view('client.borrow-books-index', ['records' => $records]);
    }

    /**
     * Display borrow book form.
     *
     * @param \App\Models\Book $book
     * @return Renderable
     */
    public function create(Book $book)
    {
        $this->authorize('createBorrow', $book);

        if($book->isUserBorrowing(auth()->user())) {
            return redirect()->route('users.books.borrows.show', ['book' => $book]);
        }

        $user = User::find(auth()->user()->id);

        if($book->quantity <= 0 || $user->borrowCount() >= Borrow::BORROW_MAX_COUNT) {
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
        $this->authorize('createBorrow', $book);

        $data = $request->validated();
        $borrowed_date = Carbon::parse($data['borrowed_date']);
        $due_date = $borrowed_date->copy()->addDays($data['term']);

        $book->users()->attach(auth()->user()->id, [
            'borrowed_date' => $borrowed_date,
            'due_date' => $due_date,
        ]);

        $book->quantity -= 1;
        $book->save();

        return redirect()->route('books.show', ['book' => $book])->with('success', 'The borrow request created successfully');
    }

    /**
     * Display the specified borrow form
     *
     * @param \App\Models\Book $book
     * @return Renderable
     */
    public function show(Book $book)
    {
        $this->authorize('viewBorrow', $book);

        $borrows = $book->users->find(auth()->user()->id)->borrows;

        return view('client.borrow-books-show', ['book' => $book, 'borrows' => $borrows]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $this->authorize('updateBorrow', $book);

        $borrows = $book->users->find(auth()->user()->id)->borrows;
        $term = Carbon::parse($borrows->due_date)->diffInDays($borrows->borrowed_date);

        return view('client.borrow-books-edit', ['book' => $book, 'borrows' => $borrows, 'term' => $term]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book $book
     * @return \Illuminate\Http\Response
     */
    public function update(BorrowBookRequest $request, Book $book)
    {
        $this->authorize('updateBorrow', $book);

        $data = $request->validated();

        $borrowed_date = Carbon::parse($data['borrowed_date']);
        $due_date = $borrowed_date->copy()->addDays($data['term']);

        $book->users()->updateExistingPivot(auth()->user()->id, [
            'borrowed_date' => $borrowed_date,
            'due_date' => $due_date,
        ]);

        return redirect()->route('books.show', ['book' => $book])->with('success', 'The borrow request updated successfully');
    }

    /**
     * Display the specified borrow form
     *
     * @param \App\Models\Book $book
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

    public function returnBook(Book $book)
    {
        $this->authorize('updateBorrow', $book);

        $book->users()->updateExistingPivot(auth()->user()->id, [
            'returned_date' => now(),
        ]);

        $book->quantity += 1;
        $book->save();

        return redirect()->route('books.show', ['book' => $book])->with('success', 'The book has been marked as returned');
    }
}
