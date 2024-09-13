<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prescription;
use App\Models\PrescriptionDetail;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Medicine;
use App\Models\Hospital;

class PrescriptionController extends Controller
{
    public function index()
    {
        $prescriptions = Prescription::all();
        $patients = Patient::all();
        $hospitals = Hospital::all();
        $doctors = Doctor::all();
        $medicines = Medicine::all(); // Đảm bảo rằng biến $medicines được truy vấn
        return view('prescriptions.index', compact('prescriptions', 'patients', 'doctors','hospitals', 'medicines')); // Truyền biến $medicines đến view
    }

    public function add(Request $request, $patient_id = null)
    {
        $patients = Patient::all();
        $doctors = Doctor::all();
        $medicines = Medicine::all();
        return view('prescriptions.add', compact('patients', 'doctors', 'medicines', 'patient_id'));
    }

    public function store(Request $request)
    {
        $prescription = Prescription::create([
            'patient_id' => $request->patient_id,
            'doctor_id' => $request->doctor_id
        ]);

        $prescription_details = [];
        foreach ($request->medicine_id as $key => $medicine_id) {
            $prescription_details[] = [
                'prescription_id' => $prescription->id,
                'medicine_id' => $medicine_id,
                'quantity' => $request->quantity[$key],
                'description' => $request->description[$key]
            ];
        }

        PrescriptionDetail::insert($prescription_details);

        return redirect()->route('prescriptions.index')->with('message', 'Tạo đơn thuốc thành công');
    }

    public function storeForPatient(Request $request, $patient_id)
    {
        $prescription = Prescription::create([
            'patient_id' => $patient_id,
            'doctor_id' => $request->doctor_id
        ]);

        $prescription_details = [];
        foreach ($request->medicine_id as $key => $medicine_id) {
            $prescription_details[] = [
                'prescription_id' => $prescription->id,
                'medicine_id' => $medicine_id,
                'quantity' => $request->quantity[$key],
                'description' => $request->description[$key]
            ];
        }

        PrescriptionDetail::insert($prescription_details);

        return redirect()->route('prescriptions.index')->with('message', 'Tạo đơn thuốc thành công');
    }

    public function show($id)
{
    $prescription = Prescription::findOrFail($id);
    $prescription_details = PrescriptionDetail::where('prescription_id', $id)->get();
    $hospital = Hospital::first(); // Lấy bản ghi đầu tiên từ bảng Hospital
    return view('prescriptions.show', compact('prescription', 'prescription_details', 'hospital'));
}


    public function edit($id)
    {
        $prescription = Prescription::findOrFail($id);
        $patients = Patient::all();
        $doctors = Doctor::all();
        $medicines = Medicine::all();
        $prescription_details = PrescriptionDetail::where('prescription_id', $id)->get();
        return view('prescriptions.edit', compact('prescription', 'patients', 'doctors', 'medicines', 'prescription_details'));
    }

    public function update(Request $request, $id)
    {
        $prescription = Prescription::findOrFail($id);
        $prescription->update([
            'patient_id' => $request->patient_id,
            'doctor_id' => $request->doctor_id
        ]);

        PrescriptionDetail::where('prescription_id', $id)->delete();

        $prescription_details = [];
        foreach ($request->medicine_id as $key => $medicine_id) {
            $prescription_details[] = [
                'prescription_id' => $prescription->id,
                'medicine_id' => $medicine_id,
                'quantity' => $request->quantity[$key],
                'description' => $request->description[$key]
            ];
        }

        PrescriptionDetail::insert($prescription_details);

        return redirect()->route('prescriptions.index')->with('message', 'Sửa đơn thuốc thành công');
    }

    public function destroy($id)
    {
        $prescription = Prescription::findOrFail($id);
        $prescription_details = PrescriptionDetail::where('prescription_id', $id);
        $prescription_details->delete();
        $prescription->delete();
        return redirect()->route('prescriptions.index')->with('message', 'Xóa đơn thuốc thành công');
    }
}