<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\Doctor;
use App\Models\Country;
use App\Models\Hospital;
use App\Models\Specialty;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Clinic;
use App\Models\ClinicTranslation;
use App\Models\DoctorClinic;
use App\Models\DoctorHospital;
use App\Models\HospitalTranslation;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::latest()->get();
        
        return view('admin.dashboard.doctor.index', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {


        $hospitals = Hospital::all();
        $specialties = Specialty::all();
        $countries = Country::all();
        $clinics = Clinic::all();
   
        return view('admin.dashboard.doctor.create', compact('hospitals','clinics','specialties', 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $locales = LaravelLocalization::getSupportedLocales();

        $rules =
            [
                'year_of_experience' => 'required|string',
                'email' => 'required|email|unique:doctors,email',
                'phone' => 'required|string',
                'country_id' => 'required|string',
                'city_id' => 'required|string',
                'company_id' => 'nullable',
                'specialty_id' => 'required|string',
                'status' => 'required|string',

            ];

        foreach ($locales as $localeCode => $properties) {
            $rules["{$localeCode}.doctor_name"] = 'nullable';
            $rules["{$localeCode}.doctor_address"] = 'nullable';
        }

        $request->validate($rules);

        $allDataExceptImages = $request->except(['image','hospital_id','clinic_id']);
        $allDataExceptImages['membership_no'] = rand(10000000, 99999999);
        $doctor = Doctor::create($allDataExceptImages);
        if ($request->file('image')) {
            $uploadedlogo = $doctor->addMediaFromRequest('image')->toMediaCollection('image');
            $doctor->update([
                'image' => $uploadedlogo->getUrl()
            ]);
        }


        $hospitals = $request->hospital_id;

        if(isset($hospitals))
        {
            for( $i = 0; $i <sizeof($hospitals); $i++ ) 
            {
                 DoctorHospital::create([
                    'doctor_id' => $doctor->id,
                    'hospital_id' => $hospitals[$i],
                 ]);
    
            }
        }

       
        $clinics = $request->clinic_id;
        if(isset($clinics))
        {
            for($i = 0 ; $i<sizeof($clinics) ; $i++)
            {
                DoctorClinic::create([
                    'doctor_id' => $doctor->id,
                    'clinic_id'=> $clinics[$i],
    
                ]);
            }
        }
       

 

        return redirect()->route('doctors.index');
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
    public function edit($id)
    {
        $doctor = Doctor::find($id);
        $hospitals = Hospital::all();
        $specialties = Specialty::all();
        $countries = Country::all();
        $selectedCountryId = $doctor->country_id;
        $selectedCityId = $doctor->city_id;
        $lang = app()->getLocale();
        $hosp = DoctorHospital::where('doctor_id',$doctor->id)->pluck('hospital_id');
        $HospitalTranslation= HospitalTranslation::whereIn('hospital_id',$hosp)->where('locale',$lang)->get();
        $doctorHospital = DoctorHospital::where('doctor_id',$doctor->id)->get();

        $clinics = Clinic::all();
        $clin = DoctorClinic::where('doctor_id', $doctor->id)->pluck('clinic_id');
        $clinicTranslation = ClinicTranslation::whereIn('clinic_id',$clin)->where('locale',$lang)->get();
        $doctorClinic = DoctorClinic::where('doctor_id',$doctor->id)->get();

        
        return view('admin.dashboard.doctor.edit', compact('doctorClinic','doctorHospital','specialties','clinics', 'hospitals', 'doctor', 'countries', 'selectedCountryId', 'selectedCityId'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {



        $locales = LaravelLocalization::getSupportedLocales();

        $rules = [
            'year_of_experience' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'country_id' => 'required|string',
            'city_id' => 'required|string',
            'company_id' => 'nullable',
            'specialty_id' => 'required|string',
            'status' => 'required|string',
        ];

        foreach ($locales as $localeCode => $properties) {
            $rules["{$localeCode}.doctor_name"] = 'nullable';
            $rules["{$localeCode}.doctor_address"] = 'nullable';
        }

        $request->validate($rules);

        $allCategoriesWithoutImages =  $request->except(['image','hospital_id','clinic_id']);
        $doctor = Doctor::find($id);
        $doctor->update($allCategoriesWithoutImages);

        if ($request->hasFile('image')) {
            // حذف الوسائط القديمة للشعار
            $oldimage = $doctor->getFirstMedia('image');
            if ($oldimage) {
                $oldimage->delete();
            }

            // رفع الشعار الجديد
            $uploadedimage = $doctor->addMediaFromRequest('image')->toMediaCollection('image');

            // تحديث حقل الشعار في قاعدة البيانات
            $doctor->update([
                'image' => $uploadedimage->getUrl(),
            ]);
        }

        $hospitals = $request->hospital_id;
        if(isset($hospitals)) {
            DoctorHospital::where('doctor_id',$doctor->id)->delete();
            for( $i = 0; $i <sizeof($hospitals); $i++ ) 
            {
                DoctorHospital::create([
                    'doctor_id' => $doctor->id,
                    'hospital_id' => $hospitals[$i],
                 ]);
    
            }
        }

        $clinics = $request->clinic_id;
        if(isset($clinics))
        {
            DoctorClinic::where('doctor_id',$doctor->id)->delete();
           for($i=0 ;$i <sizeof($clinics);$i++)
           {
            DoctorClinic::create([
                'doctor_id'=>$doctor->id,
                'clinic_id'=> $clinics[$i],
                
            ]);
           }
        }


       



        return redirect()->route('doctors.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $doctor = doctor::find($id);
        $doctor->clearMediaCollection('image');
        $doctor->delete();
        return redirect()->route('doctors.index');
    }

    public function getCities($country_id)
    {
        $cities = City::where('country_id', $country_id)->get();
        return response()->json($cities);
    }


   
}
