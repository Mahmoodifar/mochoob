<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Copan extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['user_id','type','status','code','amount','amount_type','discount_ceiling','start_date','end_date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
