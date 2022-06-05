<?php

namespace App\Http\Controllers\User\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\BorrowsHistory;
use App\Models\Borrow;
use App\Models\Book;

class AdminBorrowController extends Controller
{
    /**
     * Show all borrowing records
     * 
     * @return Renderable
     */
    public function index()
    {
        Gate::authorize('books.borrows.read');

        $records = BorrowsHistory::with('book')->with('user')->orderBy('borrowed_date', 'DESC')
                                                             ->simplePaginate();

        return view('admin.borrows.borrow-books-index', ['records' => $records]);
    }
}
