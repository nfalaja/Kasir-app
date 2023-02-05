<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\TransactionDetail;


class Transaction extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $table='transaction';
    
    public function user(){
        return $this->belongsTo(User::class, 'users_id');
    }

    public function detail(){
        return $this->hasMany(TransactionDetail::class, 'transaction_id');
    }
}
