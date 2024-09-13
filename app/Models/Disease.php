<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
    protected $fillable = ['patient_id', 'doctor_id', 'description', 'temperature', 'pulse_rate', 'respiration_rate', 'blood_pressure' ,'created_at'];
    public function patient()
    {
        return $this->belongsTo('App\Models\Patient');
    }
    public function doctor()
    {
        return $this->belongsTo('App\Models\Doctor');
    }
}
 