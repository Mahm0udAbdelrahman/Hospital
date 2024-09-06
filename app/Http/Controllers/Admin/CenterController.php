<?php

namespace App\Http\Controllers\Admin;

use App\Models\Center;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\DoctorCenter;
use Illuminate\Http\Request;
use App\Models\CenterHospital;
use App\Models\HospitalCenter;
use App\Models\HospitalTranslation;
use App\Http\Controllers\Controller;
use App\Models\DoctorTranslation;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class CenterController extends Controller
{
    public function index()
    {

        $data = Center::latest()->get();
        return view('admin.dashboard.centers.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hospitals = Hospital::all();
        $doctors = Doctor::all();
        return view('admin.dashboard.centers.create',compact('hospitals','doctors'));
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

        $allDataExceptImages = $request->except(['image','hospital_id','doctor_id']);
        $centers = Center::create($allDataExceptImages);
        if ($request->file('image')) {
            $uploadedlogo = $centers->addMediaFromRequest('image')->toMediaCollection('image');
            $centers->update([
                'image' => $uploadedlogo->getUrl()
            ]);
        }

        $hospitals = $request->hospital_id;
        if($hospitals)
        {
            for($i=0 ; $i<sizeof($hospitals) ; $i++)
            {
                HospitalCenter::create([
                    'center_id' => $centers->id,
                    'hospital_id' => $hospitals[$i],
                ]);
            }
        }

        $doctors = $request->doctor_id;
        if($doctors)
        {
            for($i=0 ; $i<sizeof($doctors) ;$i++ )
            {
                DoctorCenter::create([
                    'center_id' =>$centers->id,
                    'doctor_id' => $doctors[$i],
                ]);
            }
        }



        return redirect()->route('centers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show() {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Center $center)
    {
        $hospitals = Hospital::all();
        $doctors = Doctor::all();
        $lang = app()->getLocale();
        $hosp = HospitalCenter::where('center_id',$center->id)->pluck('hospital_id');
        $hospitalsTranslation = HospitalTranslation::whereIn('hospital_id',$hosp)->where('locale',$lang)->get();
        $HospitalCenters = HospitalCenter::where('center_id',$center->id)->get();


        $doc = DoctorCenter::where('center_id', $center->id)->pluck('doctor_id');
        $langDoctor = DoctorTranslation::whereIn('doctor_id',$doc)->where('locale',$lang)->get();
        $doctorCenters =DoctorCenter::where('center_id', $center->id)->get();
        return view('admin.dashboard.centers.edit', compact('center','doctors','doctorCenters','hospitals','HospitalCenters'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Center $center)
    {
        $locales = LaravelLocalization::getSupportedLocales();

        $rules = 
        [
            'time' => 'nullable',
            'date' => 'nullable',
            'status' => 'required|string',
        ];

        foreach ($locales  as $localeCode => $properties) {
            $rules["{$localeCode}.name"] = 'required|string';
            $rules["{$localeCode}.description"] = 'required|string';
        }
        $request->validate($rules);

        $allCentersWithoutImages = $request->except(['image','hospital_id']);
        $center->update($allCentersWithoutImages);

        if ($request->file('image')) {
            $oldData = $center->media;
            $oldData[0]->delete();
            $uploadedimage = $center->addMediaFromRequest('image')
                ->toMediaCollection('image');

            $center->update([
                'image' => $uploadedimage->getUrl()
            ]);
        }

        $hospitals = $request->hospital_id;
        if($hospitals)
        {
            HospitalCenter::where('center_id',$center->id)->delete();  
            for($i=0 ; $i<sizeof($hospitals) ; $i++)
            {
                HospitalCenter::create([
                    'center_id' => $center->id,
                    'hospital_id' => $hospitals[$i],
                ]);
            }
        }
        $doctors = $request->doctor_id;
        if($doctors)
        {
            DoctorCenter::where('center_id',$center->id)->delete(); 
            
            for($i= 0; $i<sizeof($doctors) ; $i++)
            {
                DoctorCenter::create([
                    'center_id' => $center->id,
                    'doctor_id' => $doctors[$i],
                ]);
            }
        }


        return redirect()->route('centers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $centers = Center::findOrFail($id);
        $centers->clearMediaCollection('image');
        $centers->delete();
        return redirect()->route('centers.index');
    }
}
