<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\Country;
use App\Models\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Patient::latest()->get();

        return view("admin.dashboard.patients.index", compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Country::all();
        return view("admin.dashboard.patients.create", compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name"=> "required|string",
            "email"=> "required|email|unique:patients,email",
            "phone"=> "required|string|unique:patients,phone",
            "date"=> "required|string",
            "status"=> "required|string",
            "type"=> "required|string",
            "country_id"=> "required|string",
            "city_id"=> "required|string",
             
        ]);
        $allDataExceptImages = $request->except('image');
        $medical_technologies = Patient::create($allDataExceptImages);
        if ($request->file('image')) {
            $uploadedlogo = $medical_technologies->addMediaFromRequest('image')->toMediaCollection('image');
            $medical_technologies->update([
                'image' => $uploadedlogo->getUrl()
            ]);
        }

        return redirect()->route('patients.index')->with('success','تم انشاء بالنحاح');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
       $patient = Patient::find($id);
       $countries = Country::all();
       $selectedCountryId = $patient->country_id;
       $selectedCityId = $patient->city_id;

       return view('admin.dashboard.patients.edit', compact('patient', 'selectedCountryId','selectedCityId','countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Patient $patient)
    {
        $request->validate([
            "name"=> "required|string",
            "email"=> "required|email",
            "phone"=> "required|string",
            "date"=> "required|string",
            "status"=> "required|string",
            "type"=> "required|string",
            "country_id"=> "required|string",
            "city_id"=> "required|string",
        ]);
        $allCategoriesWithoutImages = $request->except(['image']);
        $patient->update($allCategoriesWithoutImages);
        if ($request->hasFile('image')) 
        {
            // حذف الوسائط القديمة للشعار
            $oldimage = $patient->getFirstMedia('image');
            if ($oldimage) {
                $oldimage->delete();
            }

            // رفع الشعار الجديد
            $uploadedimage = $patient->addMediaFromRequest('image')->toMediaCollection('image');

            // تحديث حقل الشعار في قاعدة البيانات
            $patient->update([
                'image' => $uploadedimage->getUrl(),
            ]);
        }

        return redirect()->route('patients.index')->with('success','تم تعديل بالنحاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $patients = Patient::findOrFail($id);
        $patients->clearMediaCollection('image');
        $patients->delete();
        return redirect()->route('patients.index')->with('success','تم حذف بالنحاح');
    }
    public function getCities($country_id)
    {
        $cities = City::where('country_id', $country_id)->get();
        return response()->json($cities);
    }
}
