<?php

// namespace App\Models\Market;

// use App\Models\User;
// use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;
// use Illuminate\Database\Eloquent\Factories\HasFactory;

// class Comment extends Model
// {
//     use HasFactory, SoftDeletes;


//     protected $fillable = ['body','parent_id','status','commentable_id','commentable_type','approved','author_id'];

//     public function commentable()
//     {
//         return $this->morphTo();
//     }

//     public function user()
//     {
//         return $this->belongsTo(User::class,'author_id');
//     }

//     public function parent()
//     {
//         return $this->belongsTo($this, 'parent_id');
//     }

//     public function answer()
//     {
//         return $this->hasMany($this, 'parent_id');
//     }
// }
