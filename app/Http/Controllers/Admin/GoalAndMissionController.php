<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\GoalAndMission;
use App\Http\Controllers\Controller;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class GoalAndMissionController extends Controller
{
    public function index()
    {
        $data = GoalAndMission::latest()->get();
        return view('admin.dashboard.goal_and_mission.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        
        return view('admin.dashboard.goal_and_mission.create');

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
            $goal_and_mission = GoalAndMission::create($allDataExceptImages);
            if($request->file('image'))
            {
                $uploadedlogo = $goal_and_mission->addMediaFromRequest('image')->toMediaCollection('image');
                $goal_and_mission->update([
                    'image' => $uploadedlogo->getUrl()
                ]);
            }
    return redirect()->route('goal_and_mission.index');

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
    public function edit(GoalAndMission $goal_and_mission)
    {

       

        return view('admin.dashboard.goal_and_mission.edit',compact('goal_and_mission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GoalAndMission $goal_and_mission)
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
        $goal_and_mission->update($allCategoriesWithoutImages);

        if ($request->hasFile('image')) {
            // حذف الوسائط القديمة للشعار
            $oldimage = $goal_and_mission->getFirstMedia('image');
            if ($oldimage) {
                $oldimage->delete();
            }

            // رفع الشعار الجديد
            $uploadedimage = $goal_and_mission->addMediaFromRequest('image')->toMediaCollection('image');

            // تحديث حقل الشعار في قاعدة البيانات
            $goal_and_mission->update([
                'image' => $uploadedimage->getUrl(),
            ]);
        }

        return redirect()->route('goal_and_mission.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        $goal_and_mission = GoalAndMission::findOrFail($id);
        $goal_and_mission->clearMediaCollection('image');
        $goal_and_mission->delete();
        return redirect()->route('goal_and_mission.index');


    }
}
