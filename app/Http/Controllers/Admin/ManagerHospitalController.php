<?php

namespace App\Http\Controllers\Admin;

use App\Models\Hospital;
use Illuminate\Http\Request;
use App\Models\ManagerHospital;
use App\Http\Controllers\Controller;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class ManagerHospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = ManagerHospital::latest()->get();
        return view('admin.dashboard.manager_hospitals.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hospitals = Hospital::all();

        return view('admin.dashboard.manager_hospitals.create', compact('hospitals'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $locales = LaravelLocalization::getSupportedLocales();

        $rules = [

            'hospital_id' => 'required|string',
            'position_type' => 'required|string',
            'status' => 'required|string',
        ];

        foreach ($locales  as $localeCode => $properties) {
            $rules["{$localeCode}.name"] = 'required|string';
            $rules["{$localeCode}.position"] = 'required|string';
            $rules["{$localeCode}.description"] = 'required|string';
        }

        $request->validate($rules);

        $allDataExceptImages = $request->except('image');
        $manager_hospitals = ManagerHospital::create($allDataExceptImages);
        if ($request->file('image')) {
            $uploadedlogo = $manager_hospitals->addMediaFromRequest('image')->toMediaCollection('image');
            $manager_hospitals->update([
                'image' => $uploadedlogo->getUrl()
            ]);
        }
        return redirect()->route('manager_hospitals.index');
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
    public function edit(ManagerHospital $manager_hospital)
    {



        $hospitals = Hospital::all();

        return view('admin.dashboard.manager_hospitals.edit', compact('hospitals', 'manager_hospital'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ManagerHospital $manager_hospital)
    {
        $locales = LaravelLocalization::getSupportedLocales();

        $rules = [

            'hospital_id' => 'required|string',

            'position_type' => 'required|string',
            'status' => 'required|string',
        ];

        foreach ($locales  as $localeCode => $properties) {
            $rules["{$localeCode}.name"] = 'required|string';
            $rules["{$localeCode}.position"] = 'required|string';
            $rules["{$localeCode}.description"] = 'required|string';
        }
        $request->validate($rules);

        $allCategoriesWithoutImages = $request->except(['image']);
        $manager_hospital->update($allCategoriesWithoutImages);

        if ($request->hasFile('image')) {
            // حذف الوسائط القديمة للشعار
            $oldimage = $manager_hospital->getFirstMedia('image');
            if ($oldimage) {
                $oldimage->delete();
            }

            // رفع الشعار الجديد
            $uploadedimage = $manager_hospital->addMediaFromRequest('image')->toMediaCollection('image');

            // تحديث حقل الشعار في قاعدة البيانات
            $manager_hospital->update([
                'image' => $uploadedimage->getUrl(),
            ]);
        }

        return redirect()->route('manager_hospitals.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $manager_hospital = ManagerHospital::findOrFail($id);
        $manager_hospital->clearMediaCollection('image');
        $manager_hospital->delete();
        return redirect()->route('manager_hospitals.index');
    }
}
