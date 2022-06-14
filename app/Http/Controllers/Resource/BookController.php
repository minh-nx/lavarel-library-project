<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\Controller;
use App\Http\Requests\Resources\BookRequest;
use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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
        $books = Book::with('booktypes')
                     ->orderBy('updated_at', 'DESC')
                     ->simplePaginate();

        return view('resources.books.books-list', ['books' => $books]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $booktypes = DB::table('booktypes')->get()->pluck('name', 'id');
        $books = DB::table('books')->get()->pluck('title', 'id')->prepend('none');
        return view('resources.books.books-add')
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
        $book = DB::table('books')
                ->where('title', $title)
                ->get();

        if($request->hasFile('cover-image')) {
            $imageFile = $request->file('cover-image');
            $imageName = $imageFile->getClientOriginalName();
            $path = $imageFile->move('images', $imageName);
        }

        if($book != null) {
            $id = DB::table('books')->insertGetId([
                'title' => $title,
                'slug' => Str::slug($title),
                'author' => $request->input('author'),
                'publication_year' => $request->input('publication_year'),
                'cover_image' => url('images/' . $imageName),
                'description' => $request->input('description'),
                'quantity' => $request->input('quantity'),
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
            return redirect()->route('test.books.index');
        } else {
            return redirect()->route('test.books.create');
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
        $booktypes = DB::table('booktypes')->get()->pluck('name', 'id');
        $bookBooktypes = DB::table('book_booktype')->where('book_id', $book->id)->get()->pluck('booktype_id');
        return view('resources.books.books-manage')
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
            'updated_at' => now(),
        ]);

        $booktypes = $request->input('booktype_ids');
        DB::table('book_booktype')->where('book_id', $book->id)->delete();

        foreach ($booktypes as $booktype) {
            DB::table('book_booktype')->insert([
                'book_id' => $book->id,
                'booktype_id' => $booktype,
            ]);
        }

        return redirect()->route('test.books.index');
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

        return redirect()->route('test.books.index');
    }

    /**
     * Show the confirm page.
     *
     * @param  \App\Models\Book $book
     * @return \Illuminate\Http\Response
     */
    public function confirm(Book $book)
    {
        return view('resources.books.books-delete')
            ->with('book', $book);
    }
}
