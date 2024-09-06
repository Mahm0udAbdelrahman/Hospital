<?php

namespace App\Http\Controllers\Admin;

use App\Models\InfoHealth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class InfoHealthController extends Controller
{
    public function index()
    {

        $data = InfoHealth::all();
        return view('admin.dashboard.info_health.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.dashboard.info_health.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $locales = LaravelLocalization::getSupportedLocales();

        $rules = [
             
            'status' => 'required|string',
        ];

        foreach ($locales  as $localeCode => $properties) {
            $rules["{$localeCode}.name"] = 'required|string';
            $rules["{$localeCode}.description"] = 'required|string';
        }

        $request->validate($rules);

        $allDataExceptImages = $request->except('image');
        $info_healths = InfoHealth::create($allDataExceptImages);
        if ($request->file('image')) {
            $uploadedlogo = $info_healths->addMediaFromRequest('image')->toMediaCollection('image');
            $info_healths->update([
                'image' => $uploadedlogo->getUrl()
            ]);
        }
        return redirect()->route('info_healths.index');
    }

    /**
     * Display the specified resource.
     */
    public function show() {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InfoHealth $info_health)
    {
        return view('admin.dashboard.info_health.edit', compact('info_health'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InfoHealth $info_health)
    {
        $locales = LaravelLocalization::getSupportedLocales();

        $rules = [

            
            'status' => 'required|string',
        ];

        foreach ($locales  as $localeCode => $properties) {
            $rules["{$localeCode}.name"] = 'required|string';
            $rules["{$localeCode}.description"] = 'required|string';
        }
        $request->validate($rules);

        $allCategoriesWithoutImages = $request->except(['image']);
        $info_health->update($allCategoriesWithoutImages);

        if ($request->file('image')) {
            $oldData = $info_health->media;
            $oldData[0]->delete();
            $uploadedimage = $info_health->addMediaFromRequest('image')
                ->toMediaCollection('image');

            $info_health->update([
                'image' => $uploadedimage->getUrl()
            ]);
        }


        return redirect()->route('info_healths.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $info_health = InfoHealth::findOrFail($id);
        $info_health->clearMediaCollection('image');
        $info_health->delete();
        return redirect()->route('info_healths.index');
    }
}
