<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    protected $fillable = ['medicine_name', 'unit', 'unit_price'];
   public function prescription_details()
    {
        return $this->hasMany('App\Models\PrescriptionDetail');
    }
}
