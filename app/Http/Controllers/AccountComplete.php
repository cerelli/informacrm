<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Address;

class AccountComplete extends Controller
{
    public function create(Request $request)
    {
        return view('inf.accountcomplete');
    }

    public function store(Request $request)
    {
        // dd($request->address);
        $account = Account::create($request->account);
        for ($i=0; $i < count($request->address); $i++) {
            Address::create([
                'account_id' => $account->id,
                'address_line_1' => $request->address[$i]
            ]);
        }
        // $invoice = Invoice::create($request->invoice);
        // for ($i=0; $i < count($request->product); $i++) {
        //     if (isset($request->qty[$i]) && isset($request->price[$i])) {
        //         InvoicesItem::create([
        //             'invoice_id' => $invoice->id,
        //             'name' => $request->product[$i],
        //             'quantity' => $request->qty[$i],
        //             'price' => $request->price[$i]
        //         ]);
        //     }
        // }

        return $account;
    }

}
