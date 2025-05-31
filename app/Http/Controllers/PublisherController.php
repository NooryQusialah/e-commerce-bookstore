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
    public function allPublishers()
    {
        $publishers = Publisher::with('user')->get();
        return view('dashboard.admin.publishers.allPublishers', compact('publishers'));

    }
    public function create()
    {
        return view('dashboard.admin.publishers.create');

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
            $file->storeAs('publisherImages', $fileName, 'public');
            $validatedData['userProfileImage'] = 'storage/publisherImages/' . $fileName;

        }
        $userData=User::create([
            'name'=>$validatedData['userName'],
            'email'=>$validatedData['userEmail'],
            'password'=>bcrypt($validatedData['userPassword']),
            'profileImage'=>$validatedData['userProfileImage'],
            'role_id'=>2,
        ]);
        $userData->publisher()->create([
            'description'=>$validatedData['userDescription'],
            'address'=>$validatedData['userAddress'],
            'phone'=>$validatedData['userPhone'],
        ]);
        session()->flash('flash_message','تمت الاظافة بنجاح ');
        return redirect()->route('admin.publishers.index')->with('success','تمت إضافة الناشر بنجاح.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Publisher $publisher)
    {
        return view('dashboard.admin.publishers.show', compact('publisher'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Publisher $publisher)
    {
        return view('dashboard.admin.publishers.update', compact('publisher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Publisher $publisher)
    {
        $validatedData = $request->validate([
            'userName' => 'required|max:255',
            'userDescription' => 'required',
            'userAddress' => 'required|max:255',
            'userPhone' => 'required|unique:publishers,phone,' . $publisher->id,
        ]);

        $publisher->user()->update([
            'name'=>$validatedData['userName'],
        ]);
        $publisher->update([
            'description'=>$validatedData['userDescription'],
            'address'=>$validatedData['userAddress'],
            'phone'=>$validatedData['userPhone'],
        ]);
        session()->flash('flash_message','تمت التعديل بنجاح ');
        return redirect()->route('admin.publishers.index')->with('success','تمت التعديل  بنجاح.');
    }


    public function block(Publisher $publisher)
    {
        if ($publisher->user) {
            $user = $publisher->user;
            $user->active = $user->active == 1 ? 0 : 1;
            $user->save();

        } else {
            $message = 'لا يوجد مستخدم مرتبط بهذا الناشر.';
        }

        if ($user->active == 1)
        {
            session()->flash('flash_message','تم رفع الحظر عن المستخدم. ');
        }
        else
        {
            session()->flash('flash_message','تم حظر المستخدم بنجاح. ');
        }
        return redirect()->route('admin.publishers.index')->with('success','تمت  العملية بنجاح.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Publisher $publisher)
    {
        if ($publisher->books()->count() > 0) {
            session()->flash('flash_message','  لايمكن حذف الناشر. ');
            return redirect()->route('admin.publishers.index')->with('success','لايمكن حذف الناشر.');
        }
        else
        {
            $publisher->user()->delete();
            $publisher->delete();
            session()->flash('flash_message','  تم الحذف بنجاح. ');
            return redirect()->route('admin.publishers.index')->with('success','تم الحذف بنجاح.');
        }
    }
}
