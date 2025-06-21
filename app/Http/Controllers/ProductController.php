<?php

namespace App\Http\Controllers;

use App\Http\Requests\product\createProduct;
use App\Http\Requests\product\updateProduct;
use App\Models\ProductInventoryModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;

class ProductController extends Controller
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
        $this->data['base_url'] = route('product.index'); 
        $this->data['products'] = ProductModel::with('inventory')
                                ->when($name, function ($query, $name) {
                                    return $query->where('name', 'like', '%' . $name . '%');
                                })
                                ->whereNull('deleted_at')
                                ->orderBy('updated_at', 'DESC')
                                ->get();
         if ($request->ajax()) {
            return view('product.records', $this->data);
        }
        return view('product.index', $this->data);
    }
   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['base_url'] = route('product.create'); 
       return view('product.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(createProduct $request)
    {
       
        $product = ProductModel::create([
            'name' => $request->name,
            'product_code' => $request->product_code,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        if($product) {
            ProductInventoryModel::create([
                'product_id' => $product->id,
                'available_units' => $request->available_units,
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => "Product added successfully",
            'redirect' => route('product.index'),
            'type' => "alert"
        ], 201
        );
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductModel $product)
    {
        $this->data['product'] = $product;
        return view('product.update', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(updateProduct $request, $id)
    {
        $update = array();
        $update['name'] = $request->name;
        $update['product_code'] = $request->product_code;
        $update['description'] = $request->description;
        $update['price'] = $request->price;


        $product = ProductModel::where('id', $id)->update($update);
        if($product) {
            ProductInventoryModel::where('product_id', $id)->update([
                'product_id' => $id,
                'available_units' => $request->available_units,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => "Product updated successfully",
            'redirect' => route('product.index'),
            'type' => "alert"
        ], 201
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = ProductModel::find($id);
        if ($product) {
            $productInventory = ProductInventoryModel::where('product_id', $id)
                    ->first();

            $productInventory->delete();
            $product->delete();
        }
        return redirect('/product')->with('message', 'Product deleted successfully');
    }

    public function import()
    {
        $this->data['base_url'] = route('product.import'); 
        return view('product.import', $this->data);
    }

    public function store_import(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|mimes:csv|max:2048',
        ]);

        $file = $request->file('csv_file');
        $path = $file->getRealPath();

        $insertedCount = 0;

        if (($handle = fopen($path, 'r')) !== false) {
            $rowNumber = 0;

            while (($row = fgetcsv($handle, 1000, ',')) !== false) {
                // Skip header row (first line)
                if ($rowNumber === 0) {
                    $rowNumber++;
                    continue;
                }
                
                // Access data by index
                $name = trim($row[0] ?? '');
                $price = trim($row[1] ?? '');
                $available_units = is_numeric($row[2] ?? '') ? intval($row[2]) : 0;
                $product_code = trim($row[3] ?? '');
                $description = trim($row[4] ?? '');

                // Validate row data
                if ($name === '' || $product_code === '' || $price === '' || $available_units < 0) {
                    continue;
                }

                // Insert product
                $product = ProductModel::create([
                    'name' => $name,
                    'product_code' => $product_code,
                    'price' => $price,
                    'description' => $description,
                ]);

                // Insert inventory
                ProductInventoryModel::create([
                    'product_id' => $product->id,
                    'available_units' => $available_units
                ]);

                $insertedCount++;
                $rowNumber++;
            }

            fclose($handle);
        }

        if ($insertedCount === 0) {
            return response()->json([
                'success' => false,
                'message' => "No valid products found in the CSV file",
                'type' => "alert"
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => "Imported $insertedCount products successfully",
            'redirect' => route('product.index'),
            'type' => "alert"
        ], 201);

    
    }
}
