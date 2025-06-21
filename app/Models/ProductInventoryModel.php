<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class ProductInventoryModel extends Model
{
    use HasFactory;
    use Notifiable;
    use SoftDeletes;

    protected $table = 'product_inventory';
    protected $primaryKey = 'id';

    protected $fillable = [
        'product_id',
        'available_units', 
    ];

    public function product() {
        return $this->belongsTo(ProductModel::class);
    }

   
}
