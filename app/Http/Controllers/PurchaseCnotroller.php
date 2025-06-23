<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Shopping;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use App\Mail\OrderMail;
use Illuminate\Support\Facades\Mail;


class PurchaseCnotroller extends Controller
{

    public function sendOrderConfirmationMail($order,$user)
    {
        Mail::to($user->email)->send(new OrderMail($order,$user));

    }
    public function creditCheckOut(Request $request)
    {
        $intent = auth()->user()->createSetupIntent();
        $userId=auth()->user()->id;
        $books=User::find($userId)->booksInCart;
        $totalPrice=0;
        foreach($books as $book){
            $totalPrice+=$book->price*$book->pivot->numberOfCopies;
        }
        return view('credit.creditCheckOut',compact('intent','totalPrice'));
    }

    public function purchase(Request $request)
    {
        $user = $request->user();
        $paymentMethod = $request->input('payment_method');

        $userId = $user->id;
        $books = $user->booksInCart;
        $totalPrice = 0;

        foreach ($books as $book) {
            $totalPrice += $book->price * $book->pivot->numberOfCopies;
        }

        try {
            Stripe::setApiKey(config('cashier.secret')); // or your stripe secret key directly
            // Create PaymentIntent manually
            $paymentIntent = PaymentIntent::create([
                'amount' => $totalPrice * 100,
                'currency' => 'usd',
                'customer' => $user->stripe_id ?? $user->createAsStripeCustomer(),
                'payment_method' => $paymentMethod,
                'confirm' => true,
                'off_session' => true,
                'automatic_payment_methods' => [
                    'enabled' => true,
                    'allow_redirects' => 'never',
                ],
            ]);

        } catch (\Exception $e) {
            return back()->with('error', 'حدث خطأ أثناء شراء المنتج، الرجاء التأكد من معلومات البطاقة: ' . $e->getMessage());
        }
        $this->sendOrderConfirmationMail($books,auth()->user());
        $purchaseTime = now();
        foreach ($books as $book) {
            $user->booksInCart()->updateExistingPivot($book->id, [
                'bought' => true,
                'created_at' => $purchaseTime,
            ]);
        }

        return redirect()->route('viewCart')->with('message', 'تم الشراء بنجاح');
    }

    public function myProducts(Book $book)
    {
        $userId=auth()->user()->id;
        $myBooks=User::find($userId)->purchaedProducts;
        return view('books.myProducts',compact('userId','myBooks'));

    }

    public function allProducts()
    {
        $allBooks=Shopping::with(['book','user'])->where('bought',true)->get();

        return view('dashboard.admin.books.allProducts',compact('allBooks'));
    }

}
