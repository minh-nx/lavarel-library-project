<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Models\Book;
use App\Http\Requests\Resources\FeedbackRequest;

class FeedbackController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Automatically invoked the policy registered for Feedback class each time a corresponding method is called
        $this->authorizeResource(Feedback::class, 'feedback');
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Book $book
     * @return \Illuminate\Http\Response
     */
    public function index(Book $book)
    {
        $feedbacks = $book->sortedFeedbacks()->simplePaginate();
        return view('resources.feedbacks.feedbacks-index', ['book' => $book, 'feedbacks' => $feedbacks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Book $book
     * @return \Illuminate\Http\Response
     */
    public function create(Book $book)
    {
        $feedback = Feedback::where('book_id', $book->id)
                            ->where('user_id', auth()->user()->id)
                            ->first();

        if($feedback != null) {
            return redirect()->route('books.feedbacks.show', ['book' => $book, 'feedback' => $feedback]);
        }

        $book->loadAvg('feedbacks as average_rating', 'rating');
        return view('resources.feedbacks.feedbacks-create', ['book' => $book]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Resources\FeedbackRequest  $request
     * @param  \App\Models\Book $book
     * @return \Illuminate\Http\Response
     */
    public function store(FeedbackRequest $request, Book $book)
    {
        $data = $request->validated();

        $feedback = new Feedback();
        $feedback->user_id = auth()->user()->id;
        $feedback->book_id = $book->id;
        $feedback->rating = $data['rating'];
        $feedback->comment = $data['comment'];

        $feedback->save();

        return redirect()->route('books.show', ['book' => $book]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book $book
     * @param  \App\Models\Feedback $feedback
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book, Feedback $feedback)
    {
        $book->loadAvg('feedbacks as average_rating', 'rating');
        return view('resources.feedbacks.feedbacks-show', ['book' => $book, 'feedback' => $feedback]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book $book
     * @param  \App\Models\Feedback $feedback
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book, Feedback $feedback)
    {
        $book->loadAvg('feedbacks as average_rating', 'rating');
        return view('resources.feedbacks.feedbacks-edit', ['book' => $book, 'feedback' => $feedback]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Resources\FeedbackRequest  $request
     * @param  \App\Models\Book $book
     * @param  \App\Models\Feedback $feedback
     * @return \Illuminate\Http\Response
     */
    public function update(FeedbackRequest $request, Book $book, Feedback $feedback)
    {
        $data = $request->validated();

        $feedback->rating = $data['rating'];
        $feedback->comment = $data['comment'];

        $feedback->save();

        return redirect()->route('books.show', ['book' => $book]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book $book
     * @param  \App\Models\Feedback $feedback
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book, Feedback $feedback)
    {
        $feedback->delete();

        return redirect()->route('books.show', ['book' => $book])->with('success', 'Feedback deleted successfully');
    }
}
