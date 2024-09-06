<?php

namespace App\Http\Controllers\Admin;

use App\Models\Hospital;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Center;
use App\Models\CenterHospital;
use App\Models\CenterTranslation;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class HospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $hospitals = Hospital::latest()->get();


        return view('admin.dashboard.hospitals.index',compact('hospitals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $countries = Country::all();
        $centers = Center::all();

        return view('admin.dashboard.hospitals.create',compact('countries','centers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request )
    {

        $locales = LaravelLocalization::getSupportedLocales();

        $rules = [
            'country_id'=> 'required|string',
             'phone'=> 'required|string',
             'email'=> 'required|email|unique:hospitals,email',
             'case_treated'=> 'required|string',
             'surgery'=> 'required|string',
             'medical_staff'=> 'required|string',
             'bed'=> 'required|string',
             'status'=> 'required|string',
        ];

        foreach($locales  as $localeCode => $properties)
        {
            $rules["{$localeCode}.name"] = 'nullable';
            $rules["{$localeCode}.address"] = 'nullable';
            $rules["{$localeCode}.description"] = 'nullable';

        }

        $request->validate($rules);

        $allDataExceptImages = $request->except(['image']);

        $hospital = Hospital::create($allDataExceptImages);




        // تحميل وتحديث الشعار إذا تم إرسال ملف الشعار
        if ($request->hasFile('image')) {
            $uploadedimage =  $hospital->addMediaFromRequest('image')->toMediaCollection('image');
           $hospital->update(['image' => $uploadedimage->getUrl()]);
        }
        $centers = $request->center_id;
        if($centers)
        {
            for($i=0 ; $i < sizeof($centers) ; $i++)
            {
                CenterHospital::create([
                    'hospital_id'=> $hospital->id,
                    'center_id'=> $centers[$i],
                ]);
            }
        }








       return redirect()->route('hospitals.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Hospital $hospital)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hospital $hospital)
    {


        $countries = Country::all();
        $centers = Center::all();
        $lang = app()->getLocale();

        $hospitalId = CenterHospital::where('hospital_id',$hospital->id)->pluck('center_id');
        // $CenterTranslation =  CenterTranslation::whereIn('center_id',$hospitalId)->where('locale',$lang)->get();
        $centerHoptials =   CenterHospital::where('hospital_id',$hospital->id)->get();
        return view('admin.dashboard.hospitals.edit',compact('countries' , 'hospital','centers' ,'hospitalId' ,'centerHoptials'));


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hospital $hospital)
    {

        $locales = LaravelLocalization::getSupportedLocales();

        $rules = [
            'country_id'=> 'required|string',
            'phone'=> 'required|string',
            'email'=> 'required|email',
            'case_treated'=> 'required|string',
            'surgery'=> 'required|string',
            'medical_staff'=> 'required|string',
            'bed'=> 'required|string',
            'status'=> 'required|string',
        ];

        foreach($locales  as $localeCode => $properties) {
            $rules["{$localeCode}.name"] = 'nullable';
            $rules["{$localeCode}.address"] = 'nullable';
            $rules["{$localeCode}.description"] = 'nullable';

        }

        $request->validate($rules);
        $allDataExceptImages = $request->except(['image']);
        $hospital->update($allDataExceptImages);

        if ($request->hasFile('image')) {
            // حذف الوسائط القديمة للشعار
            $oldimage = $hospital->getFirstMedia('image');
            if ($oldimage) {
                $oldimage->delete();
            }

            // رفع الشعار الجديد
            $uploadedimage = $hospital->addMediaFromRequest('image')->toMediaCollection('image');

            // تحديث حقل الشعار في قاعدة البيانات
            $hospital->update([
                'image' => $uploadedimage->getUrl(),
            ]);
        }

        $centers = $request->center_id;
        if(isset($centers)) {
            CenterHospital::where('hospital_id', $hospital->id)->delete();
            for($i = 0; $i < sizeof($centers); $i++) {
                CenterHospital::create([
                    'hospital_id'=> $hospital->id,
                    'center_id'=> $centers[$i],

                ]);
            }
        }
        return redirect()->route('hospitals.index')->with('success', 'Translations updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // $hospital = Hospital::find($id);
        $hospital = Hospital::where('id', $id)->first();
        // dd($hospital);
        $hospital->delete();

       return redirect()->route('hospitals.index');


    }
    // public function restore(Hospital $hospital)
    // {
    //     $hospital->restore();
    //     return redirect()->route('hospitals.index');

    // }

    // public function erase(Hospital $hospital)
    // {
    //     $hospital->forceDelete();
    //     return redirect()->route('hospitals.index');

    // }
}
