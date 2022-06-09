<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;

class HomeController extends Controller
{
    /**
     * Display about guest home page
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offset = 0;
        $limit = 8;
        $books = Book::orderBy('updated_at', 'DESC')
                     ->offset($offset)
                     ->limit($limit)
                     ->get();

        return view('user.home', ['books' => $books]);
    }

    /**
     * Display intro page to books index
     * 
     * @return \Illuminate\Http\Response
     */
    public function booksIntro()
    {
        $offset = 0;
        $limit = 30;
        $books = Book::orderBy('updated_at', 'DESC')
                     ->offset($offset)
                     ->limit($limit)
                     ->get()
                     ->random(3);

        return view('user.books-intro', ['books' => $books]);
    }
}
