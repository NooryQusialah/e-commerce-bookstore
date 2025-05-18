<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Publisher;
use Illuminate\Http\Request;
use App\Models\User;

class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $publishers = Publisher::with('user')
                                ->get();
        return view('publishers.index', compact('publishers'));

    }


    public function BooksPublishers(Publisher $publisher)
    {

        $books=$publisher->books()->paginate(8);
        $title='الكتب التابعة للناشر ';
        return view('books.allBooks', compact('books','title'));

    }

    public function search(Request $request)
    {
        $term = $request->term;

        $publishers = Publisher::whereHas('user', function ($query) use ($term) {
            $query->where('name', 'like', "%{$term}%");
        })->with('user')->get();

        return view('publishers.index', compact('publishers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

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
    public function show(Publisher $publisher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Publisher $publisher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Publisher $publisher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Publisher $publisher)
    {
        //
    }
}
