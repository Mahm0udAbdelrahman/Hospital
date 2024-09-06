<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\MedicalTechnology;
use App\Http\Controllers\Controller;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class MedicalTechnologyController extends Controller
{
      /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medical_technologies = MedicalTechnology::latest()->get();
        return view('admin.dashboard.medical_technologies.index',compact('medical_technologies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        
        return view('admin.dashboard.medical_technologies.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $locales = LaravelLocalization::getSupportedLocales();

        $rules = [

           
             'status'=> 'required|string',
        ];

        foreach($locales  as $localeCode => $properties) {
            $rules["{$localeCode}.name"] = 'required|string';
            $rules["{$localeCode}.description"] = 'required|string';


        }

        $request->validate($rules);

            $allDataExceptImages = $request->except('image');
            $medical_technologies = MedicalTechnology::create($allDataExceptImages);
            if($request->file('image'))
            {
                $uploadedlogo = $medical_technologies->addMediaFromRequest('image')->toMediaCollection('image');
                $medical_technologies->update([
                    'image' => $uploadedlogo->getUrl()
                ]);
            }
    return redirect()->route('medical_technologies.index');

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
    public function edit(MedicalTechnology $medical_technology)
    {

       

        return view('admin.dashboard.medical_technologies.edit',compact('medical_technology'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MedicalTechnology $medical_technology)
    {
        $locales = LaravelLocalization::getSupportedLocales();

        $rules = [

            
            'status'=> 'required|string',
       ];

       foreach($locales  as $localeCode => $properties) {
           $rules["{$localeCode}.name"] = 'required|string';
           $rules["{$localeCode}.description"] = 'required|string';


       }
        $request->validate($rules);

        $allCategoriesWithoutImages = $request->except(['image']);
        $medical_technology->update($allCategoriesWithoutImages);

        if ($request->hasFile('image')) {
            // حذف الوسائط القديمة للشعار
            $oldimage = $medical_technology->getFirstMedia('image');
            if ($oldimage) {
                $oldimage->delete();
            }

            // رفع الشعار الجديد
            $uploadedimage = $medical_technology->addMediaFromRequest('image')->toMediaCollection('image');

            // تحديث حقل الشعار في قاعدة البيانات
            $medical_technology->update([
                'image' => $uploadedimage->getUrl(),
            ]);
        }

        return redirect()->route('medical_technologies.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        $medical_technology = MedicalTechnology::findOrFail($id);
        $medical_technology->clearMediaCollection('image');
        $medical_technology->delete();
        return redirect()->route('medical_technologies.index');


    }
}
