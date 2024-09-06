<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = Setting::latest()->get();
        return view('admin.dashboard.settings.index', compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.dashboard.settings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $locales = LaravelLocalization::getSupportedLocales();

        $rules = [
            'language' => 'required|string',
            'logo' => 'nullable|image',
            'favicon' => 'nullable|image',
            'phone' => 'required|string',
            'email' => 'required|string',
            'location' => 'required|string',
            'whatsapp' => 'required|string',
            'facebook' => 'required|string',
            'twitter' => 'required|string',
            'Instagram' => 'required|string',
            'youtube' => 'required|string',
            'linkedin' => 'required|string',
            'video' => 'required|string',
            'number_of_consultants' => 'required|string',
            'number_of_medical_team' => 'required|string',
            'number_of_beds' => 'required|string',
            'number_of_patients' => 'required|string',
            'sustainability_report' => 'nullable|file',
            'whistleblowing_policy' => 'nullable|file',
            'internal_rules_of_conduct' => 'nullable|file',
            'supplier_code_of_conduct' => 'nullable|file',
         
        ];

        foreach ($locales  as $localeCode => $properties) {
            $rules["{$localeCode}.name"] = 'required|string';
            $rules["{$localeCode}.address"] = 'required|string';
            $rules["{$localeCode}.description"] = 'required|string';
            $rules["{$localeCode}.words_guide"] = 'required|string';
            $rules["{$localeCode}.about"] = 'required|string';
            $rules["{$localeCode}.privacy"] = 'required|string';
            $rules["{$localeCode}.terms"] = 'required|string';
            $rules["{$localeCode}.why_hospital"] = 'required|string';
            $rules["{$localeCode}.path_to_success"] = 'required|string';
            $rules["{$localeCode}.sustainability"] = 'required|string';
            $rules["{$localeCode}.hospital_policies"] = 'required|string';
            $rules["{$localeCode}.management_team"] = 'required|string';
        }

        $request->validate($rules);

        $allDataExceptImages =  $request->except(['logo', 'favicon' , 'sustainability_report' , 'whistleblowing_policy' ,'supplier_code_of_conduct' ,'internal_rules_of_conduct']);
        $setting = Setting::create($allDataExceptImages);
        if ($request->file('logo')) {
            $uploadedlogo = $setting->addMediaFromRequest('logo')->toMediaCollection('logo');
            $setting->update([
                'logo' => $uploadedlogo->getUrl()
            ]);
        }
        if ($request->file('favicon')) {
            $uploadedfavicon = $setting->addMediaFromRequest('favicon')->toMediaCollection('favicon');
            $setting->update([
                'favicon' => $uploadedfavicon->getUrl()
            ]);
        }
    
        if ($request->hasFile('sustainability_report')) {
            $uploadedsustainability_report = $setting->addMediaFromRequest('sustainability_report')->toMediaCollection('sustainability_report');
            $setting->update(['sustainability_report' => $uploadedsustainability_report->getUrl()]);
        }

        // تحميل وتحديث الصورة إذا تم إرسال ملف الصورة
        if ($request->hasFile('whistleblowing_policy')) {
            $uploadedwhistleblowing_policy = $setting->addMediaFromRequest('whistleblowing_policy')->toMediaCollection('whistleblowing_policy');
            $setting->update(['whistleblowing_policy' => $uploadedwhistleblowing_policy->getUrl()]);
        }
        if ($request->hasFile('internal_rules_of_conduct')) {
            $uploadedinternal_rules_of_conduct = $setting->addMediaFromRequest('internal_rules_of_conduct')->toMediaCollection('internal_rules_of_conduct');
            $setting->update(['internal_rules_of_conduct' => $uploadedinternal_rules_of_conduct->getUrl()]);
        }

        if ($request->hasFile('supplier_code_of_conduct')) {
            $uploadedsupplier_code_of_conduct = $setting->addMediaFromRequest('supplier_code_of_conduct')->toMediaCollection('supplier_code_of_conduct');
            $setting->update(['supplier_code_of_conduct' => $uploadedsupplier_code_of_conduct->getUrl()]);
        }

        return redirect()->route('settings.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting)
    {
        return view('admin.dashboard.settings.edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Setting $setting)
    {
        $locales = LaravelLocalization::getSupportedLocales();

        $rules = [
            'language' => 'required|string',
            'logo' => 'nullable|image',
            'favicon' => 'nullable|image',
            'phone' => 'required|string',
            'email' => 'required|string',
            'location' => 'required|string',
            'whatsapp' => 'required|string',
            'facebook' => 'required|string',
            'twitter' => 'required|string',
            'instagram' => 'required|string',
            'linkedin' => 'required|string',
            'video' => 'required|string',
            'number_of_consultants' => 'required|string',
            'number_of_medical_team' => 'required|string',
            'number_of_beds' => 'required|string',
            'number_of_patients' => 'required|string',
            'sustainability_report' => 'nullable|file',
            'whistleblowing_policy' => 'nullable|file',
            'internal_rules_of_conduct' => 'nullable|file',
            'supplier_code_of_conduct' => 'nullable|file',
         
        ];

        foreach ($locales  as $localeCode => $properties) {
            $rules["{$localeCode}.name"] = 'required|string';
            $rules["{$localeCode}.address"] = 'required|string';
            $rules["{$localeCode}.description"] = 'required|string';
            $rules["{$localeCode}.words_guide"] = 'required|string';
            $rules["{$localeCode}.about"] = 'required|string';
            $rules["{$localeCode}.privacy"] = 'required|string';
            $rules["{$localeCode}.terms"] = 'required|string';
            $rules["{$localeCode}.why_hospital"] = 'required|string';
            $rules["{$localeCode}.path_to_success"] = 'required|string';
            $rules["{$localeCode}.sustainability"] = 'required|string';
            $rules["{$localeCode}.hospital_policies"] = 'required|string';
            $rules["{$localeCode}.management_team"] = 'required|string';
        }

        $request->validate($rules);
        $allDataExceptImages = $request->except(['logo', 'favicon' , 'sustainability_report' , 'whistleblowing_policy' ,'supplier_code_of_conduct' ,'internal_rules_of_conduct']);
        $setting->update($allDataExceptImages);
        if ($request->hasFile('logo')) {
            // حذف الوسائط القديمة للشعار
            $oldlogo = $setting->getFirstMedia('logo');
            if ($oldlogo) {
                $oldlogo->delete();
            }

            // رفع الشعار الجديد
            $uploadedlogo = $setting->addMediaFromRequest('logo')->toMediaCollection('logo');

            // تحديث حقل الشعار في قاعدة البيانات
            $setting->update([
                'logo' => $uploadedlogo->getUrl(),
            ]);
        }

        if ($request->hasFile('favicon')) {
            // حذف الوسائط القديمة للشعار
            $oldfavicon = $setting->getFirstMedia('favicon');
            if ($oldfavicon) {
                $oldfavicon->delete();
            }

            // رفع الشعار الجديد
            $uploadedfavicon = $setting->addMediaFromRequest('favicon')->toMediaCollection('favicon');

            // تحديث حقل الشعار في قاعدة البيانات
            $setting->update([
                'favicon' => $uploadedfavicon->getUrl(),
            ]);
        }


        if ($request->hasFile('sustainability_report')) {
            // حذف الوسائط القديمة للشعار
            $oldsustainability_report = $setting->getFirstMedia('sustainability_report');
            if ($oldsustainability_report) {
                $oldsustainability_report->delete();
            }

            // رفع الشعار الجديد
            $uploadedsustainability_report = $setting->addMediaFromRequest('sustainability_report')->toMediaCollection('sustainability_report');

            // تحديث حقل الشعار في قاعدة البيانات
            $setting->update([
                'sustainability_report' => $uploadedsustainability_report->getUrl(),
            ]);
        }

        if ($request->hasFile('whistleblowing_policy')) {
            // حذف الوسائط القديمة للصورة
            $oldwhistleblowing_policy = $setting->getFirstMedia('whistleblowing_policy');
            if ($oldwhistleblowing_policy) {
                $oldwhistleblowing_policy->delete();
            }

            // رفع الصورة الجديدة
            $uploadedwhistleblowing_policy = $setting->addMediaFromRequest('whistleblowing_policy')->toMediaCollection('whistleblowing_policy');

            // تحديث حقل الصورة في قاعدة البيانات
            $setting->update([
                'whistleblowing_policy' => $uploadedwhistleblowing_policy->getUrl(),
            ]);
        }

        if ($request->hasFile('internal_rules_of_conduct')) {
            // حذف الوسائط القديمة للصورة
            $oldinternal_rules_of_conduct = $setting->getFirstMedia('internal_rules_of_conduct');
            if ($oldinternal_rules_of_conduct) {
                $oldinternal_rules_of_conduct->delete();
            }

            // رفع الصورة الجديدة
            $uploadedinternal_rules_of_conduct = $setting->addMediaFromRequest('internal_rules_of_conduct')->toMediaCollection('internal_rules_of_conduct');

            // تحديث حقل الصورة في قاعدة البيانات
            $setting->update([
                'internal_rules_of_conduct' => $uploadedinternal_rules_of_conduct->getUrl(),
            ]);
        }

        if ($request->hasFile('supplier_code_of_conduct')) {
            // حذف الوسائط القديمة للصورة
            $oldsupplier_code_of_conduct = $setting->getFirstMedia('supplier_code_of_conduct');
            if ($oldsupplier_code_of_conduct) {
                $oldsupplier_code_of_conduct->delete();
            }

            // رفع الصورة الجديدة
            $uploadedsupplier_code_of_conduct = $setting->addMediaFromRequest('supplier_code_of_conduct')->toMediaCollection('supplier_code_of_conduct');

            // تحديث حقل الصورة في قاعدة البيانات
            $setting->update([
                'supplier_code_of_conduct' => $uploadedsupplier_code_of_conduct->getUrl(),
            ]);
        }


       





        return redirect()->back()->with('success','تم تحديث بالنحاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {

        $setting->delete();
        return redirect()->route('settings.index');
    }

    public function restore(Setting $setting)
    {
        $setting->restore();
        return redirect()->route('settings.index');
    }
    public function erase(Setting $setting)
    {
        $setting->clearMediaCollection('logo');
        $setting->clearMediaCollection('favicon');
        $setting->forceDelete();
        return redirect()->route('settings.index');
    }

    public function switchLang($lang)
    {
        App::setLocale($lang);
        Session::put('locale', $lang);
        App::getlocale();

        return redirect()->back();
    }
}
