<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class ProductModel extends Model
{
    use HasFactory;
    use Notifiable;
    use SoftDeletes;

    protected $table = 'product';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'price',
        'description', 
        'product_code', 
    ];

    public function inventory()
    {
        return $this->hasOne(ProductInventoryModel::class, 'product_id');
    }

    public function transactions()
    {
        return $this->hasMany(TransactionModel::class);
    }

}
