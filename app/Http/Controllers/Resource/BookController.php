<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\Controller;
use App\Http\Requests\Resources\BookRequest;
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
//        $data = $request->validate();
//
//        $book = new Book();
//        $book->title = $data['title'];
//        $book->author = $data['author'];
//        $book->publication_year = $data['publication_year'];
//        $book->cover_image = $data['cover-image'];
//        $book->description = $data['description'];
//        $book->quantity = $data['quantity'];
//
//        $book->save();

        $title = $request->input('title');
        $book = DB::table('books')
                ->where('title', $title)
                ->get();

        if($book != null) {
            $id = DB::table('books')->insertGetId([
                'title' => $title,
                'slug' => Str::slug($title),
                'author' => $request->input('author'),
                'publication_year' => $request->input('publication_year'),
                'cover_image' => 'http://localhost/storage/images/book-covers/sample-book-cover.png',
                'description' => $request->input('description'),
                'quantity' => $request->input('quantity'),
            ]);

            $booktypes = $request->input('booktype_ids');

            foreach ($booktypes as $booktype) {
                DB::table('book_booktype')->insert([
                    'book_id' => $id,
                    'booktype_id' => $booktype,
                ]);
            }
            return redirect()->route('books.index');
        } else {
            return redirect()->route('books.create');
        }
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
        $booktypes = DB::table('booktypes')->get()->pluck('name', 'id')->prepend('none');
        $bookBooktypes = DB::table('book_booktype')->where('book_id', $book->id)->get()->pluck('booktype_id');
        return view('resources.books.books-edit')
            ->with('book', $book)
            ->with('booktypes', $booktypes)
            ->with('bookBooktypes', $bookBooktypes);
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
        $title = $request->input('title');
        DB::table('books')->where('id', $book->id)->update([
            'title' => $title,
            'slug' => Str::slug($title),
            'author' => $request->input('author'),
            'publication_year' => $request->input('publication_year'),
            'cover_image' => 'http://localhost:8080/assets/img/book.png',
            'description' => $request->input('description'),
            'quantity' => $request->input('quantity'),
        ]);

        $booktypes = $request->input('booktype_ids');
        DB::table('book_booktype')->where('book_id', $book->id)->delete();

        foreach ($booktypes as $booktype) {
            DB::table('book_booktype')->insert([
                'book_id' => $book->id,
                'booktype_id' => $booktype,
            ]);
        }

        return redirect()->route('books.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        DB::table('book_booktype')->where('book_id', $book->id)->delete();
        DB::table('books')->where('id', $book->id)->delete();

        return redirect()->route('books.index');
    }
}
