<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    protected $fillable = ['patient_id', 'doctor_id', 'created_at'] ;

    public function prescription_details()
    {
        return $this->hasMany('App\Models\PrescriptionDetail');
    }
    public function patient()
    {
        return $this->belongsTo('App\Models\Patient');
    }
    public function doctor()
    {
        return $this->belongsTo('App\Models\Doctor');
    }
}
