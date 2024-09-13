<?php

namespace App\Http\Controllers;

use App\Models\Register;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Hospital;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $registers = Register::with(['patient', 'doctor.employee'])->get();
        return view('registers.index', compact('registers'));
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
        return view('registers.add', compact('patients', 'doctors'));
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
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
        ]);

        Register::create($request->all());

        return redirect()->route('register.index')
                         ->with('success', 'Phiếu đăng ký khám bệnh được tạo thành công.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Register  $register
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $register = Register::findOrFail($id);
        $register->load(['patient', 'doctor.employee']);
        $hospital = Hospital::first(); // Lấy bản ghi đầu tiên từ bảng Hospital
        return view('registers.show', compact('register', 'hospital'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Register  $register
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $register = Register::findOrFail($id);
        $patients = Patient::all();
        $doctors = Doctor::with('employee')->get();
        return view('registers.edit', compact('register', 'patients', 'doctors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Register  $register
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
        ]);
        $register = Register::findOrFail($id);
        $register->update($request->all());

        return redirect()->route('register.index')
                         ->with('success', 'Phiếu đăng ký khám bệnh được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Register  $register
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $register = Register::findOrFail($id);
        $register->delete();

        return redirect()->route('register.index')
                         ->with('success', 'Phiếu đăng ký khám bệnh được xóa thành công.');
    }
}
