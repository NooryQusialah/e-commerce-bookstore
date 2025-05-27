<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use function PHPUnit\Framework\isEmpty;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $books=Book::all();
        $title="معرض الكتب";
        return view('books.allBooks',compact('books','title'));
    }

    public function search(Request $request)
    {

        $books=Book::where('title','like',"%{$request->term}%")->paginate(8);
        $title=' نتائج البحث عن  '.$request->term;
        return view('books.allBooks',compact('books','title'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function allBooks()
    {
        $books=Book::with('author.user','publisher.user','category:id,name')
            ->paginate(8);
        return view('dashboard.admin.books.allBooks',compact('books'));

    }
    public function create()
    {
        $categories=Category::all();
        $authors=Author::with('user')->get();
        $publishers=Publisher::with('user')->get();
        return view('dashboard.admin.books.create',compact('categories','authors','publishers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'isBn' => 'required|string|max:255|unique:books',
            'cover_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price' => 'required|numeric',
            'publish_year' => 'required|integer',
            'numberOfPages' => 'required|integer',
            'numberOfCopies' => 'required|integer',
            'category' => 'required|integer',
            'publisher' => 'required|integer',
            'authors' => 'required|array',
        ]);

        if ($validator->fails()) {
            return redirect('/books/create')
                ->withErrors($validator)
                ->withInput();
        }

        $validatedData = $validator->validated();

        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('booksImage', $fileName, 'public');
            $validatedData['cover_image'] = 'storage/booksImage/' . $fileName;
        }


//        if ($request->hasFile('cover_image')) {
//            $file = $request->file('cover_image');
//            $fileName = time() . '.' . $file->getClientOriginalExtension();
//            $file->storeAs('public/booksImage', $fileName);
//            $validatedData['cover_image'] = 'storage/booksImage/' . $fileName;
//        }

        // Create the book
        $book = Book::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'isBn' => $validatedData['isBn'],
            'coverImage' => $validatedData['cover_image'],
            'price' => $validatedData['price'],
            'publishYear' => $validatedData['publish_year'],
            'numberOfPages' => $validatedData['numberOfPages'],
            'numberOfCopies' => $validatedData['numberOfCopies'],
            'category_id' => $validatedData['category'],
            'publisher_id' => $validatedData['publisher'],
        ]);

        // Attach authors (many-to-many relationship)
        $book->author()->attach($validatedData['authors']);

        session()->flash('flash_message','تمت إضافة الكتاب بنجاح');
        return redirect()->route('admin.books.index')->with('success', 'تمت إضافة الكتاب بنجاح.');
    }

    public function showBook(Book $book)
    {
        return view('dashboard.admin.books.show',compact('book'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {

        return view('components.books.book-details',compact('book'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        $categories=Category::all();
        $authors=Author::with('user')->get();
        $publishers=Publisher::with('user')->get();

        return view('dashboard.admin.books.update',compact('book','categories','authors','publishers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'isBn' => 'required|string|max:255|unique:books,isBn,' . $book->id,
                'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'price' => 'required|numeric',
                'publish_year' => 'required|integer',
                'numberOfPages' => 'required|integer',
                'numberOfCopies' => 'required|integer',
                'category' => 'required|integer',
                'publisher' => 'required|integer',
                'authors' => 'required|array',
            ]);


            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $validatedData = $validator->validated();

            if ($request->hasFile('cover_image')) {
                if ($book->coverImage && Storage::disk('public')->exists(str_replace('storage/', '', $book->coverImage))) {
                    Storage::disk('public')->delete(str_replace('storage/', '', $book->coverImage));
                }

                $file = $request->file('cover_image');
                $fileName = time() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('booksImage', $fileName, 'public');
                $validatedData['coverImage'] = 'storage/booksImage/' . $fileName;
            }

            // Update the book
            $book->update([
                'title' => $validatedData['title'],
                'description' => $validatedData['description'],
                'isBn' => $validatedData['isBn'],
                'coverImage' => $validatedData['coverImage'] ?? $book->coverImage,
                'price' => $validatedData['price'],
                'publishYear' => $validatedData['publish_year'],
                'numberOfPages' => $validatedData['numberOfPages'],
                'numberOfCopies' => $validatedData['numberOfCopies'],
                'category_id' => $validatedData['category'],
                'publisher_id' => $validatedData['publisher'],
            ]);

            $book->author()->sync($validatedData['authors']);

            session()->flash('flash_message', 'تم تعديل الكتاب بنجاح');
            return redirect()->route('admin.books.index')->with('success', 'تم تعديل الكتاب بنجاح.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء التعديل.');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        Storage::disk('public')->delete(str_replace('storage/', '', $book->coverImage));
        $book->delete();
        session()->flash('flash_message', 'تم حذف الكتاب بنجاح');
        return redirect()->route('admin.books.index')->with('success', 'تم حذف الكتاب بنجاح.');
    }
}
