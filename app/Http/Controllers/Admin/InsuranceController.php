<?php

namespace App\Http\Controllers\Admin;

use App\Models\Hospital;
use App\Models\Language;
use App\Models\Insurance;
use App\Models\Translation;
use Illuminate\Http\Request;
use App\Models\InsuranceSection;
use App\Models\InsuranceHostipal;
use App\Models\HospitalTranslation;
use App\Http\Controllers\Controller;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class InsuranceController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        $insurances = Insurance::latest()->get();

        return view('admin.dashboard.insurances.index', compact('insurances'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sections = InsuranceSection::all();
        $hospitals = Hospital::all();
        return view('admin.dashboard.insurances.create', compact('sections', 'hospitals'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $locales = LaravelLocalization::getSupportedLocales();

        $rules = [
            'insurance_section_id' => 'required|string',
            'status' => 'required|string',
        ];

        foreach ($locales  as $localeCode => $properties) {
            $rules["{$localeCode}.name"] = 'nullable';
        }

        $validation = $request->validate($rules);



        $allDataExceptImages = $request->except(['image', 'hospital_id']);

        $Insurance = Insurance::create($allDataExceptImages);

        if ($request->file('image')) {
            $uploadedlogo = $Insurance->addMediaFromRequest('image')->toMediaCollection('image');
            $Insurance->update([
                'image' => $uploadedlogo->getUrl()
            ]);
        }

        $hospitals = $request->hospital_id;
        if($hospitals)
        {
            for ($i = 0; $i < sizeof($hospitals); $i++) {

                InsuranceHostipal::create([
                    'insurance_id' => $Insurance->id,
                    'hospital_id' => $hospitals[$i]
                ]);
            }
        }






        return redirect()->route('insurances.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Insurance $insurance) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Insurance $insurance)
    {

        $sections = InsuranceSection::all();
        $hospitals = Hospital::all();
        $lang = app()->getLocale();

        $hospitalIds = InsuranceHostipal::where('insurance_id', $insurance->id)->pluck('hospital_id');

        // $subs = HospitalTranslation::whereIn('hospital_id', $hospitalIds)->where('locale', $lang)->get();

        $insuranceHostipal = InsuranceHostipal::where('insurance_id', $insurance->id)->get();

        return view('admin.dashboard.insurances.edit', compact('insurance', 'sections', 'hospitals', 'insuranceHostipal', 'hospitalIds', 'lang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $locales = LaravelLocalization::getSupportedLocales();

        $rules = [
            'insurance_section_id' => 'required|string',
            'status' => 'required|string',
        ];

        foreach ($locales  as $localeCode => $properties) {
            $rules["{$localeCode}.name"] = 'nullable';
        }

        $insurance = Insurance::findOrFail($id);
        $request->validate($rules);
        $allDataExceptImages = $request->except(['image', 'hospital_id']);
        $insurance->update($allDataExceptImages);

        if ($request->hasFile('image')) {
            // حذف الوسائط القديمة للشعار
            $oldimage = $insurance->getFirstMedia('image');
            if ($oldimage) {
                $oldimage->delete();
            }

            // رفع الشعار الجديد
            $uploadedimage = $insurance->addMediaFromRequest('image')->toMediaCollection('image');

            // تحديث حقل الشعار في قاعدة البيانات
            $insurance->update([
                'image' => $uploadedimage->getUrl(),
            ]);
        }

        $hospitals = $request->hospital_id;
        if(isset($hospitals)) {
            InsuranceHostipal::where('insurance_id',$insurance->id)->delete();

            for($i = 0; $i < sizeof($hospitals); $i++) {
                InsuranceHostipal::create([
                    'insurance_id' => $insurance->id,
                    'hospital_id' => $hospitals[$i],
                ]);
            }
        }




        return redirect()->route('insurances.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Insurance $insurance)
    {
        $insurance->delete();

        return redirect()->route('insurances.index');
    }
}
