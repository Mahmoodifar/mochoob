<?php

namespace App\Models\Market;

use App\Models\User;
use App\Models\Address;
use Illuminate\Database\Eloquent\Model;
use App\Models\Market\Delivery;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];


    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function delivery()
    {
        return $this->belongsTo(Delivery::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function copan()
    {
        return $this->belongsTo(Copan::class);
    }

    public function commonDiscount()
    {
        return $this->belongsTo(CommonDiscount::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getPaymentStatusValueAttribute()
    {
        switch ($this->payment_status) {
            case 0:
                $resutl =  'پرداخت نشده';
                break;
            case 1:
                $resutl =  'پرداخت تکمیل شده';
                break;
            case 2:
                $resutl =  'کنسل شده';
                break;
            default:
                $resutl =  'بازگشت داده شده ';
                break;
        }

        return $resutl;
    }

    public function getOrderStatusValueAttribute()
    {
        switch ($this->order_status) {
            case 0:
                $resutl = 'بررسی نشده';
                break;
            case 1:
                $resutl = 'در انتظار تایید';
                break;
            case 2:
                $resutl = 'تایید نشده';
                break;
            case 3:
                $resutl =  'تایید شده';
                break;
            case 4:
                $resutl = ' باطل شده';
                break;
            default:
                $resutl = ' مرجوع شده';
                break;
        }

        return $resutl;
    }

    public function getDeliveryStatusValueAttribute()
    {
        switch ($this->delivery_status) {
            case 0:
                $resutl = ' ارسال نشده';
                break;
            case 1:
                $resutl =  'درحال ارسال';
                break;
            case 2:
                $resutl =  'ارسال شده';
                break;
            default:
                $resutl =  'تحویل داده شده';
                break;
        }

        return $resutl;
    }

    public function getPeymentTypeValueAttribute()
    {
        switch ($this->peyment_type) {
            case 0:
                $resutl = 'انلاین';
                break;
            case 1:
                $resutl =  'افلاین';
                break;
            default:
                $resutl =  'در محل';
                break;
        }

        return $resutl;
    }
}
