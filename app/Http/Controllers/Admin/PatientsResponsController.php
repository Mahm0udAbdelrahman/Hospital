<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\PatientsRespon;
use App\Http\Controllers\Controller;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class PatientsResponsController extends Controller
{
    public function index()
    {

        $data = PatientsRespon::all();
        return view('admin.dashboard.patients_respon.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.dashboard.patients_respon.create');
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
        $medical_technologies = PatientsRespon::create($allDataExceptImages);
        if ($request->file('image')) {
            $uploadedlogo = $medical_technologies->addMediaFromRequest('image')->toMediaCollection('image');
            $medical_technologies->update([
                'image' => $uploadedlogo->getUrl()
            ]);
        }
        return redirect()->route('patients_respons.index');
    }

    /**
     * Display the specified resource.
     */
    public function show() {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PatientsRespon $patients_respon)
    {
        return view('admin.dashboard.patients_respon.edit', compact('patients_respon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PatientsRespon $patients_respon)
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

        $allCategoriesWithoutImages = $request->except(['image']);
        $patients_respon->update($allCategoriesWithoutImages);

        if ($request->file('image')) {
            $oldData = $patients_respon->media;
            $oldData[0]->delete();
            $uploadedimage = $patients_respon->addMediaFromRequest('image')
                ->toMediaCollection('image');

            $patients_respon->update([
                'image' => $uploadedimage->getUrl()
            ]);
        }


        return redirect()->route('patients_respons.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $patients_respon = PatientsRespon::findOrFail($id);
        $patients_respon->clearMediaCollection('image');
        $patients_respon->delete();
        return redirect()->route('patients_respons.index');
    }
}
