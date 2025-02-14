<?php

namespace App\Http\Controllers;

use App\Services\BookScraper;
use App\Services\BookScraper2;
use Illuminate\Http\Request;

class BookController extends Controller
{

    public function __construct(BookScraper2 $scraper)
    {
        $this->scraper = $scraper;
    }

    public function index()
    {
        return view('books.search');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $books = $this->scraper->scrapeBooks($query);

       // dd($books);

        return view('books.results', compact('books', 'query'));
    }

    public function show($id)
    {
        $book = $this->scraper->scrapeBookDetails($id);
        //dd($book);

        if (!$book) {
            return abort(404, 'الكتاب غير موجود');
        }

        return view('books.show', compact('book'));
    }
}
