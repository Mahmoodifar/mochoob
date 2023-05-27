<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OnlinePayment extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = ['id'];


    protected $fillable = ['amount','user_id','gateway','transaction_id','bank_first_response','bank_second_response','status'];

    public function peyments()
    {
        return $this->morphMany('App\Models\Market\Payment','paymentable');
    }
}
