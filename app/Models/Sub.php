<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sub extends Model
{
    protected $fillable = ['medicine_id','medicine_name', 'quantity', 'description'];
     public function medicine()
    {
        return $this->belongsTo('App\Models\Medicine');
    }
}
