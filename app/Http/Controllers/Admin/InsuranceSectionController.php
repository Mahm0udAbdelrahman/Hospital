<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\InsuranceSection;
use App\Http\Controllers\Controller;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class InsuranceSectionController extends Controller
{
    public function index()
    {

        $data = InsuranceSection::all();
        return view('admin.dashboard.InsuranceSections.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.dashboard.InsuranceSections.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $locales = LaravelLocalization::getSupportedLocales();

        $rules =
            [
                'status' => 'required|string',
            ];

        foreach ($locales  as $localeCode => $properties) {
            $rules["{$localeCode}.name"] = 'required|string';
             
        }

        $request->validate($rules);

        $allDataExceptImages = $request->except('image');
        $InsuranceSections = InsuranceSection::create($allDataExceptImages);
        if ($request->file('image')) {
            $uploadedlogo = $InsuranceSections->addMediaFromRequest('image')->toMediaCollection('image');
            $InsuranceSections->update([
                'image' => $uploadedlogo->getUrl()
            ]);
        }
        return redirect()->route('InsuranceSections.index');
    }

    /**
     * Display the specified resource.
     */
    public function show() {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InsuranceSection $InsuranceSection)
    {
        return view('admin.dashboard.InsuranceSections.edit', compact('InsuranceSection'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InsuranceSection $InsuranceSection)
    {
        $locales = LaravelLocalization::getSupportedLocales();

        $rules = [

         
            'status' => 'required|string',
        ];

        foreach ($locales  as $localeCode => $properties) {
            $rules["{$localeCode}.name"] = 'required|string';
           
        }
        $request->validate($rules);

        $allInsuranceSectionsWithoutImages = $request->except('image');
        $InsuranceSection->update($allInsuranceSectionsWithoutImages);

        if ($request->file('image')) {
            $oldData = $InsuranceSection->media;
            $oldData[0]->delete();
            $uploadedimage = $InsuranceSection->addMediaFromRequest('image')
                ->toMediaCollection('image');

            $InsuranceSection->update([
                'image' => $uploadedimage->getUrl()
            ]);
        }


        return redirect()->route('InsuranceSections.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $InsuranceSections = InsuranceSection::findOrFail($id);
        $InsuranceSections->clearMediaCollection('image');
        $InsuranceSections->delete();
        return redirect()->route('InsuranceSections.index');
    }
}
