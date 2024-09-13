<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrescriptionDetail extends Model
{
    protected $fillable = ['prescription_id', 'medicine_id', 'quantity', 'description'];
    public function prescription()
    {
        return $this->belongsTo('App\Models\Prescription');
    }
    public function medicine()
    {
        return $this->belongsTo('App\Models\Medicine');
    }
}