<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\MedicalTourism;
use Illuminate\Http\Request;

class MedicalTourismController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $medical_tourisms = MedicalTourism::latest()->get();
       return view("admin.dashboard.medical_tourism.index", compact("medical_tourisms"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Country::all();
        return view("admin.dashboard.medical_tourism.create", compact("countries"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
       
            'name' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email|unique:medical_tourisms,email',
            'type' => 'required|string',
            'country_id' => 'required|string',
            'date' => 'required|string',
            'medical_report' => 'required|file',
            'case_details' => 'required|string',
            'status' => 'required|string',
        ]);


        $validateExceptReport = $request->except('medical_report');

        $data = MedicalTourism::create($request->all());
        if ($request->hasFile('medical_report')) {
            $uploadedmedical_report = $data->addMediaFromRequest('medical_report')->toMediaCollection('medical_report');
            $data->update(['medical_report' => $uploadedmedical_report->getUrl()]);
        }

        return redirect()->route('medical_tourisms.index')->with('success','تم انشاء بنجاح');
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
        $medical_tourism = MedicalTourism::find($id);
        $countries = Country::all();
        return view("admin.dashboard.medical_tourism.edit", compact("countries",'medical_tourism'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email',
            'type' => 'required|string',
            'country_id' => 'required|string',
            'date' => 'required|string',
            'medical_report' => 'nullable',
            'case_details' => 'required|string',
            'status' => 'required|string',
        ]);


        $validateExceptReport = $request->except('medical_report');
        $medical_tourism = MedicalTourism::find($id);
        $medical_tourism->update($validateExceptReport);
        if ($request->hasFile('medical_report')) {
            // حذف الوسائط القديمة للشعار
            $oldmedical_report = $medical_tourism->getFirstMedia('medical_report');
            if ($oldmedical_report) {
                $oldmedical_report->delete();
            }

            // رفع الشعار الجديد
            $uploadedmedical_report = $medical_tourism->addMediaFromRequest('medical_report')->toMediaCollection('medical_report');

            // تحديث حقل الشعار في قاعدة البيانات
            $medical_tourism->update([
                'medical_report' => $uploadedmedical_report->getUrl(),
            ]);
        }

        return redirect()->route('medical_tourisms.index')->with('success','تم تعديل بنجاح');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $medical_tourism = MedicalTourism::find($id);
        $medical_tourism->clearMediaCollection('medical_report');
        $medical_tourism->delete(); 
        return redirect()->route('medical_tourisms.index')->with('success','تم حذف بنجاح');

    }
}
