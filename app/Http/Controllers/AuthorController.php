<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors = Author::with('user','books')->get();
        return view('authors.index', compact('authors'));

    }

    public function BooksAuthors(Author $author)
    {
        $books = $author->books()->paginate(8);
        $title='الكتب التابعة للمؤالف ';
        return view('books.allBooks', compact('books','title'));
    }

    public function search(Request $request)
    {

        $term=$request->term;
        $authors=Author::whereHas('books', function ($query) use ($term) {
                      $query->where('name', 'LIKE', '%' . $term . '%');
                  })->with('user')->paginate(8);

        return view('authors.index', compact('authors'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Author $author)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Author $author)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        //
    }
}
