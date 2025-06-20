<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class CartController extends Controller
{



    public function addCart(Request $request)
    {

        $book = Book::find($request->id);
        if(auth()->user()->booksInCart->contains($book)){
            $newQuentity=$request->quantity + auth()->user()->booksInCart()->where('book_id',$book->id)->first()->pivot->numberOfCopies;
            if ($newQuentity >$book->numberOfCopies){
                session()->flash('warnning message','لم تتم اضافة الكتاب لقد تجاوزت عدد النسخ المتوفرة لدينا , اقصئ عدد موجود من هذا الكتاب هو '.($book->numberOfCopies-auth()->user()->booksInCart()->where('book_id',$book->id)->first()->pivot->numberOfCopies).' كتاب ');
                return redirect()->back();
            }
            else{
                auth()->user()->booksInCart()->updateExistingPivot($book->id,['numberOfCopies'=>$newQuentity]);
            }
        }
        else{
            auth()->user()->booksInCart()->attach($request->id,['numberOfCopies'=>$request->quantity]);
        }

        $numberOfProduct=auth()->user()->booksInCart()->count();
        return response()->json(['numberOfProduct'=>$numberOfProduct]);
    }
    public function viewCart()
    {
        $allBooksInCart=auth()->user()->booksInCart;


        return view('cart.cart',compact('allBooksInCart'));
    }
    public function removeOne(Book $book)
    {
        $oldQuantity=auth()->user()->booksInCart()->where('book_id',$book->id)->first()->pivot->numberOfCopies;
        if ($oldQuantity > 0)
        {
            auth()->user()->booksInCart()->updateExistingPivot($book->id,['numberOfCopies'=>--$oldQuantity]);
        }
        else
        {
            auth()->user()->booksInCart()->detach($book->id);

        }
        return redirect()->back();
    }
    public function removeAll(Book $book)
    {
        auth()->user()->booksInCart()->detach($book->id);
        return redirect()->back();
    }

}
