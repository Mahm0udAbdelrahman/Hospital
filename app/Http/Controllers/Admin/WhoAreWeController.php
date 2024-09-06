<?php

namespace App\Http\Controllers\Admin;

use App\Models\WhoAreWe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class WhoAreWeController extends Controller
{
    public function index()
    {
        $data = WhoAreWe::latest()->get();
        return view('admin.dashboard.who_are_we.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        
        return view('admin.dashboard.who_are_we.create');

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
            $who_are_we = WhoAreWe::create($allDataExceptImages);
            if($request->file('image'))
            {
                $uploadedlogo = $who_are_we->addMediaFromRequest('image')->toMediaCollection('image');
                $who_are_we->update([
                    'image' => $uploadedlogo->getUrl()
                ]);
            }
    return redirect()->route('who_are_we.index');

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
    public function edit(WhoAreWe $who_are_we)
    {

       

        return view('admin.dashboard.who_are_we.edit',compact('who_are_we'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WhoAreWe $who_are_we)
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
        $who_are_we->update($allCategoriesWithoutImages);

        if ($request->hasFile('image')) {
            // حذف الوسائط القديمة للشعار
            $oldimage = $who_are_we->getFirstMedia('image');
            if ($oldimage) {
                $oldimage->delete();
            }

            // رفع الشعار الجديد
            $uploadedimage = $who_are_we->addMediaFromRequest('image')->toMediaCollection('image');

            // تحديث حقل الشعار في قاعدة البيانات
            $who_are_we->update([
                'image' => $uploadedimage->getUrl(),
            ]);
        }

        return redirect()->route('who_are_we.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        $who_are_we = WhoAreWe::findOrFail($id);
        $who_are_we->clearMediaCollection('image');
        $who_are_we->delete();
        return redirect()->route('who_are_we.index');


    }
}
