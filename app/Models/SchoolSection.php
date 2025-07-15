<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolSection extends Model
{
    public function class()
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }
}
