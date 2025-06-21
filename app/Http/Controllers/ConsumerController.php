<?php

namespace App\Http\Controllers;

use App\Http\Requests\consumer\createConsumer;
use App\Http\Requests\consumer\updateConsumer;
use App\Models\ConsumerModel;
use Illuminate\Http\Request;

class ConsumerController extends Controller
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
        $email       = $request->input('email'); 
        $this->data['base_url'] = route('consumer.index'); 
        $this->data['consumers'] = ConsumerModel::when($name, function ($query, $name) {
                                    return $query->where('name', 'like', '%' . $name . '%');
                                })
                                ->when($email, function ($query, $email) {
                                    return $query->where('email', 'like', '%' . $email . '%');
                                })
                                ->whereNull('deleted_at')
                                ->orderBy('updated_at', 'DESC')
                                ->get();
         if ($request->ajax()) {
            return view('consumer.records', $this->data);
        }
        return view('consumer.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $this->data['base_url'] = route('consumer.create'); 
       return view('consumer.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(createConsumer $request)
    {
        $product = ConsumerModel::create([
            'name' => $request->name,
            'email' => $request->email,
            'type' => $request->type,
            'contact_info' => $request->contact_info,
        ]);

        
        return response()->json([
            'success' => true,
            'message' => "Consumer added successfully",
            'redirect' => route('consumer.index'),
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
    public function edit(ConsumerModel $consumer)
    {
         $this->data['consumer'] = $consumer;
        return view('consumer.update', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(updateConsumer $request, $id)
    {
        $update = array();
        $update['name'] = $request->name;
        $update['email'] = $request->email;
        $update['type'] = $request->type;
        $update['contact_info'] = $request->contact_info;

        $consumer = ConsumerModel::where('id', $id)->update($update);
        return response()->json([
            'success' => true,
            'message' => "Consumer updated successfully",
            'redirect' => route('consumer.index'),
            'type' => "alert"
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $consumer = ConsumerModel::find($id);
        if ($consumer) {
            $consumer->delete();
        }
        return redirect('/consumer')->with('message', 'Consumer deleted successfully');
    }

    public function import()
    {
        $this->data['base_url'] = route('product.import'); 
        return view('consumer.import', $this->data);
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
                $email = trim($row[1] ?? '');
                $type = trim($row[2] ?? '');
                $contact_info = trim($row[3] ?? '');

                // Validate row data
                if ($name === '' || $email === '' || $type === '' || $contact_info === '') {
                    continue;
                }

                // Check if email exists
                 $existing = ConsumerModel::where('email', $email)->first();
                 
                if ($existing) {
                $existing->update([
                    'name' => $name,
                    'type' => $type,
                    'contact_info' => $contact_info,
                    'updated_at' => now()
                ]);
                } else {
                    $product = ConsumerModel::create([
                        'name' => $name,
                        'email' => $email,
                        'type' => $type,
                        'contact_info' => $contact_info,
                    ]);
                }
                $insertedCount++;
                $rowNumber++;
            }

            fclose($handle);
        }
        if ($insertedCount === 0) {
            return response()->json([
                'success' => false,
                'message' => 'No valid consumer data found in the CSV file.',
                'type' => "alert"
            ], 422);
        }
        return response()->json([
            'success' => true,
            'message' => "Imported $insertedCount consumer successfully",
            'redirect' => route('consumer.index'),
            'type' => "alert"
        ], 201);

    
    }
}
