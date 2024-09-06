<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\Clinic;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class ClinicController extends Controller
{
    public function index()
    {
        $data = Clinic::latest()->get();
        return view('admin.dashboard.clinics.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $countries = Country::all();
        return view('admin.dashboard.clinics.create',compact('countries'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $locales = LaravelLocalization::getSupportedLocales();

        $rules = [

           'country_id' => 'required|string',
            'city_id' => 'required|string',
             'status'=> 'required|string',
        ];

        foreach($locales  as $localeCode => $properties) {
            $rules["{$localeCode}.name"] = 'required|string';
            $rules["{$localeCode}.description"] = 'required|string';


        }

        $request->validate($rules);

            $allDataExceptImages = $request->except(['image','logo']);
            $clinics = Clinic::create($allDataExceptImages);
            if($request->file('logo'))
            {
                $uploadedlogo = $clinics->addMediaFromRequest('logo')->toMediaCollection('logo');
                $clinics->update([
                    'logo' => $uploadedlogo->getUrl()
                ]);
            }
            if($request->file('image'))
            {
                $uploadedlogo = $clinics->addMediaFromRequest('image')->toMediaCollection('image');
                $clinics->update([
                    'image' => $uploadedlogo->getUrl()
                ]);
            }
    return redirect()->route('clinics.index');

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
    public function edit(Clinic $clinic)
    {

        $countries = Country::all();
        $selectedCountryId = $clinic->country_id;
        $selectedCityId = $clinic->city_id;

        return view('admin.dashboard.clinics.edit',compact('clinic','countries','selectedCountryId','selectedCityId'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Clinic $clinics)
    {
        $locales = LaravelLocalization::getSupportedLocales();

        $rules = [

            'country_id' => 'required|string',
            'city_id' => 'required|string',
            'status'=> 'required|string',
       ];

       foreach($locales  as $localeCode => $properties) {
           $rules["{$localeCode}.name"] = 'required|string';
           $rules["{$localeCode}.description"] = 'required|string';


       }
        $request->validate($rules);

        $allCategoriesWithoutImages = $request->except(['image','logo']);
        $clinics->update($allCategoriesWithoutImages);



        if ($request->hasFile('logo')) {
            // حذف الوسائط القديمة للشعار
            $oldlogo = $clinics->getFirstMedia('logo');
            if ($oldlogo) {
                $oldlogo->delete();
            }

            // رفع الشعار الجديد
            $uploadedlogo = $clinics->addMediaFromRequest('logo')->toMediaCollection('logo');

            // تحديث حقل الشعار في قاعدة البيانات
            $clinics->update([
                'logo' => $uploadedlogo->getUrl(),
            ]);
        }

        if ($request->hasFile('image')) {
            // حذف الوسائط القديمة للشعار
            $oldimage = $clinics->getFirstMedia('image');
            if ($oldimage) {
                $oldimage->delete();
            }

            // رفع الشعار الجديد
            $uploadedimage = $clinics->addMediaFromRequest('image')->toMediaCollection('image');

            // تحديث حقل الشعار في قاعدة البيانات
            $clinics->update([
                'image' => $uploadedimage->getUrl(),
            ]);
        }

        return redirect()->route('clinics.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        $clinics = Clinic::findOrFail($id);
        $clinics->clearMediaCollection('image');
        $clinics->clearMediaCollection('logo');
        $clinics->delete();
        return redirect()->route('clinics.index');


    }


    public function getCities($country_id)
    {
        $cities = City::where('country_id', $country_id)->get();
        return response()->json($cities);
    }
}
