<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Setting extends Model
{
    use HasFactory;

    protected $casts = ['logo' => 'array','icon' => 'array'];

    protected $fillable = ['title','description','keywords','logo', 'icon'];

}
