<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'nid',
        'slug',
        'phone',
        'gender',
        'dob',
        'skills',
        'department',
        'about',
        'address',
        'image',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    

    public function getImageAttribute($value)
    {
        $path = public_path($value);

        if ($value && file_exists($path)) {
            return asset('public/' . $value);
        }

        return asset('public/backend/upload/default.jpg');
    }

}
