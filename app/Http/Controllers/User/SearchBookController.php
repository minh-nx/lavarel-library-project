<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;

class SearchBookController extends Controller
{
    /**
     * Display search page
     * 
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $this->authorize('viewAny', Book::class);
        
        return view('user.search-books-page');
    }

    /**
     * Display search result
     * 
     * @param Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $this->authorize('viewAny', Book::class);

        //$param = $request->all();
        //$books = Book::filter($param)->paginate(5);
        $books = Book::where('title', 'LIKE', '%'. $request->title .'%')
                    ->orderBy('updated_at', 'DESC')
                    ->simplePaginate(10)->withQueryString();
        
        if($request->ajax())
        {
            return view('resources.books.books-table', ['books' => $books])->render();
        }
        else
        {
            return view('user.search-books-page', ['books' => $books]);
        }
    }
}
