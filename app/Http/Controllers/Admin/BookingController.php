<?php

namespace App\Http\Controllers\Admin;

use App\Models\Day;
use App\Models\Clinic;
use App\Models\Doctor;
use App\Models\Booking;
use App\Models\Hospital;
use App\Models\DoctorClinic;
use Illuminate\Http\Request;
use App\Models\DoctorHospital;
use App\Models\ClinicTranslation;
use App\Models\HospitalTranslation;
use App\Http\Controllers\Controller;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::latest()->get();
        $doctors = Doctor::all();
        return view('admin.dashboard.bookings.index', compact('bookings', 'doctors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hospitals = Hospital::all();
        $doctors = Doctor::all();
        $days = Day::all();

        return view('admin.dashboard.bookings.create', compact('hospitals', 'doctors', 'days'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = $request->validate([
            'doctor_id' => 'required|string',
            'doctor_hospital_id' => 'nullable',
            'doctor_clinic_id' => 'nullable',
            'day_id' => 'required|string',
            'date' => 'required|string',
            'form' => 'required|string',
            'to' => 'required|string',
            'status' => 'required|string',
        ]);



        Booking::create($data);

        return redirect()->route('bookings.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        $hospitals = Hospital::all();
        $clinics = Clinic::all();
        $doctors = Doctor::all();
        $days = Day::all();
        $selectedDoctorId = $booking->doctor_id;
        $selectedHospitalId = $booking->doctor_hospital_id;
        $selectedClinicId = $booking->doctor_clinic_id;
        return view('admin.dashboard.bookings.edit', compact('booking','selectedHospitalId', 'clinics','selectedDoctorId', 'selectedClinicId', 'hospitals', 'doctors', 'days'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {

        $data = $request->validate([
            'doctor_id' => 'required|string',
            'doctor_hospital_id' => 'nullable',
            'doctor_clinic_id' => 'nullable',
            'day_id' => 'required|string',
            'date' => 'required|string',
            'form' => 'required|string',
            'to' => 'required|string',
            'status' => 'required|string',
        ]);
        if ($request->typeBooking == "hospital") {
            $data['doctor_clinic_id'] = null;
            $data['doctor_hospital_id'] = $request->doctor_hospital_id;
            $booking->update($data);
        }else{
            $data['doctor_clinic_id'] = $request->doctor_clinic_id;
            $data['doctor_hospital_id'] = null;
            $booking->update($data);
        }




        return redirect()->route('bookings.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('bookings.index');
    }

    public function getHospitals($doctor_id)
    {
        $lang = app()->getLocale();
        $hosp = DoctorHospital::where('doctor_id', $doctor_id)->pluck('hospital_id');
        $HospitalTranslation = HospitalTranslation::whereIn('hospital_id', $hosp)->where('locale', $lang)->get();
        return response()->json($HospitalTranslation);
    }

    public function getClinics($doctor_id)
    {
        $lang = app()->getLocale();
        $clin = DoctorClinic::where('doctor_id', $doctor_id)->pluck('clinic_id');
        $clinicTranslation = ClinicTranslation::whereIn('clinic_id', $clin)->where('locale', $lang)->get();
        return response()->json($clinicTranslation);
    }
}
