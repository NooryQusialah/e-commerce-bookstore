<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\User;
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

    public function allAuthors()
    {
        $authors = Author::with('user','books')->get();
        return view('dashboard.admin.authors.allAuthors', compact('authors'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.admin.authors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'userName' => 'required|max:255',
            'userEmail' => 'required|email|max:255|unique:users,email',
            'userPassword' => 'required|min:6',
            'userProfileImage' => 'image|mimes:jpeg,png,jpg|max:2048',
            'userDescription' => 'required|max:255',
            'userAddress' => 'required|max:255',
            'userPhone' => 'required|max:255',
        ]);

        if ($request->hasFile('userProfileImage')) {
            $file=$request->file('userProfileImage');
            $fileName=time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('authorImages', $fileName, 'public');
            $validatedData['userProfileImage'] = 'storage/authorImages/' . $fileName;

        }
        $userData=User::create([
            'name'=>$validatedData['userName'],
            'email'=>$validatedData['userEmail'],
            'password'=>bcrypt($validatedData['userPassword']),
            'profileImage'=>$validatedData['userProfileImage'],
            'role_id'=>3,
        ]);
        $userData->author()->create([
            'description'=>$validatedData['userDescription'],
            'address'=>$validatedData['userAddress'],
            'phone'=>$validatedData['userPhone'],
        ]);
        session()->flash('flash_message','تمت الاظافة بنجاح ');
        return redirect()->route('admin.authors.index')->with('success','تمت إضافة الناشر بنجاح.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        return view('dashboard.admin.authors.show', compact('author'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Author $author)
    {
        return  view('dashboard.admin.authors.update', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Author $author)
    {

        $validatedData = $request->validate([
            'userName' => 'required|max:255',
            'userDescription' => 'required',
            'userAddress' => 'required|max:255',
            'userPhone' => 'required|max:255|unique:authors,phone,' .$author->id,
        ]);

        $author->user()->update([
            'name'=>$validatedData['userName'],
        ]);
        $author->update([
            'description'=>$validatedData['userDescription'],
            'address'=>$validatedData['userAddress'],
            'phone'=>$validatedData['userPhone'],
        ]);
        session()->flash('flash_message','تمت التعديل بنجاح ');
        return redirect()->route('admin.authors.index')->with('success','تمت التعديل  بنجاح.');
    }

    public function block(Author $author)
    {
        if ($author->user)
        {
            $user = $author->user;
            $user->active = $user->active == 0 ? 1 : 0;
            $user->save();

        }
        else {
            $message = 'لا يوجد مستخدم مرتبط بهذا المؤلف.';
        }
        if ($user->active == 1)
        {
            session()->flash('flash_message','تم رفع الحظر عن المستخدم. ');
        }
        else
        {
            session()->flash('flash_message','تم حظر المستخدم بنجاح. ');
        }
        return redirect()->route('admin.authors.index')->with('success','تمت  العملية بنجاح.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {

        if ($author->books()->count() > 0)
        {
            session()->flash('flash_message','  لايمكن حذف المؤلف. ');
            return redirect()->route('admin.publishers.index')->with('success','لايمكن حذف المؤلف.');
        }
        else
        {
            $author->user()->delete();
            $author->delete();
            session()->flash('flash_message','  تم الحذف بنجاح. ');
            return redirect()->route('admin.publishers.index')->with('success','تم الحذف بنجاح.');
        }
    }
}
