<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItemSelectedAttribute extends Model
{
    use HasFactory, SoftDeletes;

    public function categoryAttribute()
    {
        return $this->belongsTo(CategoryAttribute::class,'category_attribute_id');
    }

    public function categoryAttributeValue()
    {
        return $this->belongsTo(CategoryValue::class,'category_value_id');
    }

    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class);
    }
}
