<?php

namespace App\Http\Controllers;

use App\Models\ConsumerModel;
use App\Models\ProductModel;
use App\Models\TransactionModel;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    protected $data = [];

    public function __construct()
    {

    }
    public function show_report_form()
{
    $this->data['base_url'] = route('report.form'); 
    $this->data['consumers'] = ConsumerModel::whereNull('deleted_at')->get();
    $this->data['products'] = ProductModel::with('inventory')->whereNull('deleted_at')->orderBy('name', 'ASC')->get();
    return view('report.index', $this->data);
}

public function generate_report(Request $request)
{
    $request->validate([
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
    ]);

    $this->data['transactions'] = TransactionModel::with(['product', 'consumer'])
        ->when($request->product_id, function ($query) use ($request) {
            $query->where('product_id', $request->product_id);
        })
        ->when($request->consumer_id, function ($query) use ($request) {
            $query->where('consumer_id', $request->consumer_id);
        })
        ->when($request->type, function ($query) use ($request) {
            $query->where('type', $request->type);
        })
        ->whereBetween('transaction_date', [$request->start_date, $request->end_date])
        ->orderBy('transaction_date', 'desc')
        ->get();

    //$products = Product::all();
    //$consumers = Consumer::all();

    $this->data['consumers'] = ConsumerModel::whereNull('deleted_at')->get();
    $this->data['products'] = ProductModel::with('inventory')->whereNull('deleted_at')->orderBy('name', 'ASC')->get();

    //return view('transaction_report', compact('transactions', 'products', 'consumers'));
    return view('report.index', $this->data);
}

}
