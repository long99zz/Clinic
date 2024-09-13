<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    protected $fillable = ['patient_id', 'doctor_id', 'description', 'created_at'];
     public function patient()
    {
        return $this->belongsTo('App\Models\Patient');
    }
    public function doctor()
    {
        return $this->belongsTo('App\Models\Doctor');
    }
}
