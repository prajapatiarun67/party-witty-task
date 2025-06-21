<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class ConsumerModel extends Model
{
    use HasFactory;
    use Notifiable;
    use SoftDeletes;

    protected $table = 'consumers';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'email',
        'type',
        'contact_info',
    ];

    public function transactions()
    {
        return $this->hasMany(TransactionModel::class);
    }
}
