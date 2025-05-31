<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users=User::where('role_id',1)->get();
        return view('dashboard.admin.users.allUsers',compact('users'));
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    public function block(User $user)
    {
        if ($user)
        {
            $user->active=$user->active == 1? 0:1;
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
        return redirect()->route('admin.users.index')->with('success','تمت  العملية بنجاح.');

    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {

        if ($user->role_id == 1)
        {
            $user->delete();
            session()->flash('flash_message','  تم الحذف بنجاح. ');
            return redirect()->route('admin.users.index')->with('success','تم الحذف بنجاح.');
        }
        else{
            session()->flash('flash_message','  لايمكن حذف المستخدم. ');
            return redirect()->route('admin.users.index')->with('success','لايمكن حذف المستخدم.');
        }

    }
}
