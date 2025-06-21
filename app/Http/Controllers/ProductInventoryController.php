<?php

namespace App\Http\Controllers;

use App\Models\ProductInventoryModel;
use Illuminate\Http\Request;

class ProductInventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    
    public function getStock(ProductInventoryModel $product)
    {
        return response()->json($product->inventory);
    }
}
