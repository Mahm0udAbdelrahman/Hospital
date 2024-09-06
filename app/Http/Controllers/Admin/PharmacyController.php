<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\Country;
use App\Models\Pharmacy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class PharmacyController extends Controller
{
    public function index()
    {
        $data = Pharmacy::latest()->get();
        return view('admin.dashboard.pharmacies.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $countries = Country::all();
        return view('admin.dashboard.pharmacies.create',compact('countries'));

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
            $Pharmacys = Pharmacy::create($allDataExceptImages);
            if($request->file('logo'))
            {
                $uploadedlogo = $Pharmacys->addMediaFromRequest('logo')->toMediaCollection('logo');
                $Pharmacys->update([
                    'logo' => $uploadedlogo->getUrl()
                ]);
            }
            if($request->file('image'))
            {
                $uploadedlogo = $Pharmacys->addMediaFromRequest('image')->toMediaCollection('image');
                $Pharmacys->update([
                    'image' => $uploadedlogo->getUrl()
                ]);
            }
    return redirect()->route('pharmacies.index');

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
    public function edit(Pharmacy $pharmacy)
    {      
        $countries = Country::all();
        $selectedCountryId = $pharmacy->country_id;
        $selectedCityId = $pharmacy->city_id;

        return view('admin.dashboard.pharmacies.edit',compact('pharmacy','countries','selectedCountryId','selectedCityId'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pharmacy $pharmacy)
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
        $pharmacy->update($allCategoriesWithoutImages);



        if ($request->hasFile('logo')) {
            // حذف الوسائط القديمة للشعار
            $oldlogo = $pharmacy->getFirstMedia('logo');
            if ($oldlogo) {
                $oldlogo->delete();
            }

            // رفع الشعار الجديد
            $uploadedlogo = $pharmacy->addMediaFromRequest('logo')->toMediaCollection('logo');

            // تحديث حقل الشعار في قاعدة البيانات
            $pharmacy->update([
                'logo' => $uploadedlogo->getUrl(),
            ]);
        }

        if ($request->hasFile('image')) {
            // حذف الوسائط القديمة للشعار
            $oldimage = $pharmacy->getFirstMedia('image');
            if ($oldimage) {
                $oldimage->delete();
            }

            // رفع الشعار الجديد
            $uploadedimage = $pharmacy->addMediaFromRequest('image')->toMediaCollection('image');

            // تحديث حقل الشعار في قاعدة البيانات
            $pharmacy->update([
                'image' => $uploadedimage->getUrl(),
            ]);
        }

        return redirect()->route('pharmacies.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        $pharmacy = Pharmacy::findOrFail($id);
        $pharmacy->clearMediaCollection('image');
        $pharmacy->clearMediaCollection('logo');
        $pharmacy->delete();
        return redirect()->route('pharmacies.index');


    }


    public function getCities($country_id)
    {
        $cities = City::where('country_id', $country_id)->get();
        return response()->json($cities);
    }
}
