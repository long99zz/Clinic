<?php

namespace App\Http\Controllers;

use App\Models\Disease;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Hospital;
use Illuminate\Http\Request;

class DiseaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $diseases = Disease::get();
        $patients = Patient::get();
        $doctors = Doctor::get();
        return view('diseases.index', compact('diseases', 'patients', 'doctors')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $patients = Patient::all();
        $doctors = Doctor::with('employee')->get();
        return view('diseases.add', compact('patients', 'doctors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'doctor_id' => 'required|numeric',
            'patient_id' => 'required|numeric',
            'temperature' => 'required',
            'pulse_rate' => 'required',
            'respiration_rate' => 'required',
            'blood_pressure' => 'required',
            'description' => 'required',
        ]);
        
        Disease::create($request->all());
        return back()->with('success', 'Thêm kết quả khám thành công.');
    }

  /**
     * Display the specified resource.
     *
     * @param  \App\Models\Disease  $disease
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $disease = Disease::findOrFail($id);
        $hospital = Hospital::first(); // Lấy bản ghi đầu tiên từ bảng Hospital
        return view('diseases.show', compact('disease', 'hospital'));
    }
     /* Show the form for editing the specified resource.
     *
     * @param  \App\Models\Disease  $disease
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $disease = Disease::findOrFail($id);
        $patients = Patient::all();
        $doctors = Doctor::with('employee')->get();
        return view('diseases.edit', compact('disease', 'patients', 'doctors'));
    }


     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Disease  $disease
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
        ]);
        $disease = Disease::findOrFail($id);
        $disease->update($request->all());

        return redirect()->route('diseases.index')
                         ->with('success', 'Kết quả khám được cập nhật thành công.');
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Disease  $disease
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $disease = Disease::findOrFail($id);
        $disease->delete();

        return redirect()->route('disease.index')
                         ->with('success', 'Kết quả khám được xóa thành công.');
    }
}