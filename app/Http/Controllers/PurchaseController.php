<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Sale;

class PurchaseController extends Controller
{
    public function create()
    {
        $products = Product::all();

        return view('purchase.create', compact('products'));
    }

    public function store(Request $request)
{
    session([
        'purchase_data' => $request->all()
    ]);

    return redirect()->route(
        'purchase.payment',
        $request->product_id
    );
}

public function payment(Product $product)
{
    return view('purchase.payment', compact('product'));
}

public function savePurchase(Request $request)
{
    $purchaseData = session('purchase_data');

    $product = Product::findOrFail(
        $purchaseData['product_id']
    );

    $slipPath = null;

    if($request->hasFile('slip')){
        $slipPath = $request->file('slip')
            ->store('payment-slips', 'public');
    }

    Purchase::create([

        'user_id' => auth()->id(),
        'product_id' => $product->id,

        'full_name' => $purchaseData['full_name'],
        'email' => $purchaseData['email'],
        'mobile' => $purchaseData['mobile'],

        'pan_number' => $purchaseData['pan_number'],
        'gst_number' => $purchaseData['gst_number'],

        'sponsor_id' => $purchaseData['sponsor_id'],
        'enroll_id' => $purchaseData['enroll_id'],

        'state' => $purchaseData['state'],

        'payment_method' => $request->payment_method,
        'payer_name' => $request->payer_name,
        'bank_name' => $request->bank_name,
        'account_number' => $request->account_number,
        'transaction_number' => $request->transaction_number,
        'payment_date' => $request->payment_date,
        'payment_amount' => $request->payment_amount,
        'payment_type' => $request->payment_type,

        'slip' => $slipPath,

        'amount' =>
            $product->price +
            $product->product_tax +
            $product->shipping +
            $product->shipping_tax +
            $product->processing_fee,

        'status' => 'pending'
    ]);

    session()->forget('purchase_data');

    return redirect()
        ->route('purchase.create')
        ->with('success', 'Purchase Submitted Successfully');
}


public function myPurchases()
{
    $purchases = Purchase::with('product')
        ->where('user_id', auth()->id())
        ->latest()
        ->get();

    return view('purchase.list', compact('purchases'));
}


public function adminPurchases()
{
    if(auth()->user()->role != 'admin'){
        abort(403);
    }

    $purchases = Purchase::with(['product'])
                    ->latest()
                    ->get();

    return view('admin.purchases', compact('purchases'));
}

public function approvePurchase($id)
{
    if(auth()->user()->role != 'admin'){
        abort(403);
    }

    $purchase = Purchase::findOrFail($id);

    if($purchase->status == 'approved'){
        return back()->with(
            'success',
            'Purchase Already Approved'
        );
    }


    $saleExists = Sale::where('user_id', $purchase->user_id)
    ->where('product_name', $purchase->product->name)
    ->where('sale_value', $purchase->amount)
    ->exists();

if($saleExists){
    return back()->with(
        'error',
        'Sale Already Created'
    );
}

    $purchase->update([
        'status' => 'approved'
    ]);

    Sale::create([

        'user_id' => $purchase->user_id,

        'product_name' => $purchase->product->name ?? 'Product',

        'sale_value' => $purchase->amount,

        'status' => 'approved',

        'approved_by' => auth()->id(),

        'operational_date' => now()->toDateString(),

        'remarks' => 'Purchase Approved'

    ]);

    return back()->with(
        'success',
        'Purchase Approved & Sale Created'
    );
}

public function rejectPurchase($id)
{
    if(auth()->user()->role != 'admin'){
        abort(403);
    }

    $purchase = Purchase::findOrFail($id);

    $purchase->update([
        'status' => 'rejected'
    ]);

    return back()->with('success', 'Purchase Rejected');
}


}