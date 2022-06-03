<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BookController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        // Automatically invoked the policy registered for Book class each time a corresponding method is called
//        $this->authorizeResource(Book::class, 'book');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::with('booktypes')->orderBy('updated_at', 'DESC')->simplePaginate()->withQueryString();
        return view('resources.books.books-index', ['books' => $books]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $booktypes = DB::table('booktypes')->get()->pluck('name', 'id')->prepend('none');
        $books = DB::table('books')->get()->pluck('title', 'id')->prepend('none');
        return view('resources.books.books-create')
            ->with('booktypes', $booktypes)
            ->with('books', $books);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $title = $request->input('title');

        if(Book::where('title', $title)->get() == null) {
            $slug = $request->input('title');
            $id = DB::table('books')->insertGetId([
                'title' => $request->input('title'),
                'slug' => Str::slug($slug),
                'author' => $request->input('author'),
                'publication_year' => $request->input('pub_year'),
                'cover_image' => 'http://localhost/storage/images/book-covers/sample-book-cover.png',
                'description' => $request->input('description'),
                'quantity' => $request->input('quantity'),
                'deleted_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $booktypes = $request->input('booktype_ids');

            foreach ($booktypes as $booktype) {
                DB::table('book_booktype')->insert([
                    'book_id' => $id,
                    'booktype_id' => $booktype,
                ]);
            }
        }

        return redirect()->route('books.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        $book->loadAvg('feedbacks as average_rating', 'rating');
        return view('resources.books.books-show', ['book' => $book]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {

    }
}
