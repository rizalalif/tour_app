<?php

namespace App\Http\Controllers;

use App\Models\HolidayPackage;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function checkout(Request $request)
    {
        // dd($request);
        $package = HolidayPackage::findOrFail($request->package_id);

        $amount = $package->price * $request->person;


        $checkout = [
            "user_id" => $request->user_id,
            "code" => 'TR' . random_int(100, 999),
            "holiday_package_id" => $request->package_id,
            "total_amount" => $amount,
            "departure" => $request->departure,
            "total_pax" => $request->person,
            "status" => 'pending',
            "payment_proof" => ' ',
        ];



        $transaction = Transaction::create($checkout);


        return redirect()->route('package.checkout.page', ['transaction' => $transaction->code]);
    }

    public function checkoutPage(Transaction $transaction)
    {
        // dd($transaction->with('holiday_package')->first());

        return view('package.payment', compact('transaction'));
    }
    public function payment(Request $request)
    {
        $proof = $request->file('proof');
        // dd($transaction->with('holiday_package')->first());

        Transaction::where('id', $request->transaction_id)->update([
            'payment_proof' => $proof->getClientOriginalName(),
            'status' => 'success'
        ]);

        $proof->storeAs('public/images', $proof->getClientOriginalName());

        return redirect()->intended('/');
    }
}
