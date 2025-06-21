<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class TransactionModel extends Model
{
    use HasFactory;
    use Notifiable;
    use SoftDeletes;

    protected $table = 'transactions';
    protected $primaryKey = 'id';   

    protected $fillable = [
        'consumer_id',
        'product_id',
        'transaction_type',
        'quantity',
        'transaction_date',
        'notes',
    ];

    public function product()
    {
        return $this->belongsTo(ProductModel::class);
    }

    public function consumer()
    {
        return $this->belongsTo(ConsumerModel::class);
    }
}
