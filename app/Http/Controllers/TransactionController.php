<?php

namespace App\Http\Controllers;

use App\Http\Requests\transaction\createIssue;
use App\Http\Requests\transaction\createReturn;
use App\Models\ConsumerModel;
use App\Models\ProductInventoryModel;
use App\Models\ProductModel;
use App\Models\TransactionModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{

    protected $data = [];

    public function __construct()
    {

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         $name       = $request->input('name'); 
        $this->data['base_url'] = route('transaction.index'); 
        $this->data['trasactions'] = TransactionModel::with(['product', 'consumer'])
                                ->when($name, function ($query, $name) {
                                    return $query->where('name', 'like', '%' . $name . '%');
                                })
                                ->whereNull('deleted_at')
                                ->orderBy('updated_at', 'DESC')
                                ->get();
         if ($request->ajax()) {
            return view('transaction.records', $this->data);
        }
        return view('transaction.index', $this->data);
    }

    public function show_issue()
    {
        
        $this->data['base_url'] = route('transaction.issue'); 
        $this->data['consumers'] = ConsumerModel::whereNull('deleted_at')->get();
        $this->data['products'] = ProductModel::with('inventory')->whereNull('deleted_at')->orderBy('name', 'ASC')->get();
        return view('transaction.issue', $this->data);
    }

    public function store_issue(createIssue $request)
    {
        $inventory = ProductInventoryModel::where('product_id', $request->product_id)->first();

        if (!$inventory || $inventory->available_units < $request->quantity) {
            return response()->json([
                'success' => false,
                'message' => "Not enough stock available.",
                //'redirect' => route('transaction.index'),
                'type' => "alert"
            ], 200);
        }

        $transaction = TransactionModel::create([
            'consumer_id' => $request->consumer_id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'transaction_type' => 'Issue',
            'transaction_date' => now(),
        ]);

        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => "Failed to record transaction.",
                //'redirect' => route('transaction.index'),
                'type' => "alert"
            ], 200);
        }
        
        $inventory->decrement('available_units', $request->quantity);

        return response()->json([
            'success' => true,
            'message' => "Issue transaction added successfully",
            'redirect' => route('transaction.index'),
            'type' => "alert"
        ], 201);
    }

    public function show_return()
    {
        $this->data['base_url'] = route('transaction.issue'); 
        $this->data['consumers'] = ConsumerModel::whereNull('deleted_at')->get();
        $this->data['products'] = ProductModel::with('inventory')->whereNull('deleted_at')->orderBy('name', 'ASC')->get();
        return view('transaction.return', $this->data);
    }

    /* public function store_return(createReturn $request)
    {
        $validFrom = Carbon::now()->subDays(30);
        $issued = TransactionModel::where('consumer_id', $request->consumer_id)
            ->where('product_id', $request->product_id)
            ->where('transaction_type', 'Issue')
            ->where('transaction_date', '>=', $validFrom)
            ->sum('quantity');

        $returned = TransactionModel::where('consumer_id', $request->consumer_id)
            ->where('product_id', $request->product_id)
            ->where('transaction_type', 'Return')
            ->where('transaction_date', '>=', $validFrom)
            ->sum('quantity');

        if ($request->quantity > ($issued - $returned)) {
            return response()->json([
                'success' => false,
                'message' => "Return quantity exceeds issued amount in last 30 days.",
                'type' => "alert"
            ], 200);
        }

        TransactionModel::create([
            'consumer_id' => $request->consumer_id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'transaction_type' => 'Return',
            'transaction_date' => now(),
        ]);

        $inventory = ProductInventoryModel::where('product_id', $request->product_id)->first();
        $inventory->increment('available_units', $request->quantity);

        return response()->json([
            'success' => true,
            'message' => "Return processed successfully.",
            'redirect' => route('transaction.index'),
            'type' => "alert"
        ], 201);
    } */

    public function store_return(createReturn $request)
{

    $product_id = $request->product_id;
    $consumer_id = $request->consumer_id;
    $quantity = $request->quantity;

    // Total issued quantity in last 30 days
    $issued = TransactionModel::where('product_id', $product_id)
        ->where('consumer_id', $consumer_id)
        ->where('transaction_type', 'Issue')
        ->where('transaction_date', '>=', Carbon::now()->subDays(30))
        ->sum('quantity');
        
    // Total returned quantity in last 30 days
    $returned = TransactionModel::where('product_id', $product_id)
        ->where('consumer_id', $consumer_id)
        ->where('transaction_type', 'Return')
        ->where('transaction_date', '>=', Carbon::now()->subDays(30))
        ->sum('quantity');

    $maxReturnQty = $issued - $returned;
   
    if ($quantity > $maxReturnQty) {
        return response()->json([
            'success' => false,
            'message' => "Return quantity exceeds issued amount in last 30 days.",
            'type' => "alert"
        ], 200);
    }

    DB::transaction(function () use ($product_id, $consumer_id, $quantity) {
        // Insert return transaction
        TransactionModel::create([
            'product_id' => $product_id,
            'consumer_id' => $consumer_id,
            'quantity' => $quantity,
            'transaction_type' => 'Return',
            'transaction_date' => now(),
        ]);

        // Update inventory
        $inventory = ProductInventoryModel::where('product_id', $product_id)->first();
        $inventory->available_units += $quantity;
        $inventory->save();
    });

    //return redirect()->route('transaction.return.create')->with('success', 'Product returned successfully.');
    return response()->json([
            'success' => true,
            'message' => "Product returned successfully.",
            'redirect' => route('transaction.index'),
            'type' => "alert"
        ], 201);
}


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
