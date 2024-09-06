<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\PatientsRight;
use App\Http\Controllers\Controller;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class PatientsRightsController extends Controller
{
    public function index()
    {

        $data = PatientsRight::all();
        return view('admin.dashboard.patients_right.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.dashboard.patients_right.create');
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
            $rules["{$localeCode}.description"] = 'required|string';
        }

        $request->validate($rules);

        $allDataExceptImages = $request->except('image');
        $medical_technologies = PatientsRight::create($allDataExceptImages);
        if ($request->file('image')) {
            $uploadedlogo = $medical_technologies->addMediaFromRequest('image')->toMediaCollection('image');
            $medical_technologies->update([
                'image' => $uploadedlogo->getUrl()
            ]);
        }
        return redirect()->route('patients_rights.index');
    }

    /**
     * Display the specified resource.
     */
    public function show() {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PatientsRight $patients_right)
    {
        return view('admin.dashboard.patients_right.edit', compact('patients_right'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PatientsRight $patients_right)
    {
        $locales = LaravelLocalization::getSupportedLocales();

        $rules = [

            'time' => 'nullable',
            'date' => 'nullable',
            'status' => 'required|string',
        ];

        foreach ($locales  as $localeCode => $properties) {
            $rules["{$localeCode}.name"] = 'required|string';
            $rules["{$localeCode}.description"] = 'required|string';
        }
        $request->validate($rules);

        $allCategoriesWithoutImages = $request->except('image');
        $patients_right->update($allCategoriesWithoutImages);

        if ($request->file('image')) {
            $oldData = $patients_right->media;
            $oldData[0]->delete();
            $uploadedimage = $patients_right->addMediaFromRequest('image')
                ->toMediaCollection('image');

            $patients_right->update([
                'image' => $uploadedimage->getUrl()
            ]);
        }


        return redirect()->route('patients_rights.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $patients_right = PatientsRight::findOrFail($id);
        $patients_right->clearMediaCollection('image');
        $patients_right->delete();
        return redirect()->route('patients_rights.index');
    }
}
