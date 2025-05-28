<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();


        return view('categories.allCategories', compact('categories'));
    }

    public function BooksCategories(Category $category)
    {
        $books=$category->books()->paginate(5);
        $title='الكتب التابعه لتصنيف عن  '.$category->name;
        return view('books.allBooks',compact('books','title'));

    }

    public function search(Request $request)
    {
        $categories = Category::where('name','like',"%{$request->term}%")->paginate(8);
        return view('categories.allCategories', compact('categories'));

    }
    /**
     * admin functionality
     */
    public function allCategories()
    {
        $categories = Category::all();
        return view('dashboard.admin.categories.allCategories',compact('categories'));
    }
    public function create()
    {
        return view('dashboard.admin.categories.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name_cat' => 'required|max:255',
            'description_cat' => 'required',

        ]);
        $validatedData=$validator->validate();
        Category::create([
            'name'=>$validatedData['name_cat'],
            'description'=>$validatedData['description_cat'],
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);

        session()->flash('flash_message','تمت الاظافة بنجاح ');
        return redirect()->route('admin.categories.index')->with('success', 'تمت إضافة الكتاب بنجاح.');
    }

    public function show(Category $category)
    {
        //
    }

    public function edit(Category $category)
    {
        return view('dashboard.admin.categories.update',compact('category'));
    }

    public function update(Request $request, Category $category)
    {

        $validator = Validator::make($request->all(), [
            'name_cat' => 'required|max:255',
            'description_cat' => 'required',
        ]);
        $validatedData=$validator->validate();
        $category->update([
            'name'=>$validatedData['name_cat'],
            'description'=>$validatedData['description_cat'],
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);

        session()->flash('flash_message','تم  التعديل  بنجاح.');
        return redirect()->route('admin.categories.index')->with('success', 'تم  التعديل  بنجاح.');
    }

    public function destroy(Category $category)
    {
        if ($category->books()->count() > 0) {
            session()->flash('flash_message','لايمكن حذف هذا الكتاب ');
            return redirect()->route('admin.categories.index')->with('success', 'لايمكن حذف هذا الكتاب');
        }
        else{
            $category->delete();
            session()->flash('flash_message','تم الحذف  بنجاح.');
            return redirect()->route('admin.categories.index')->with('success', 'تم  الحذف  بنجاح.');
        }
    }
}
