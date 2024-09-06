<?php

namespace App\Http\Controllers\Admin;

use App\Models\Competency;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class CompetencyController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Competency::latest()->get();
        return view('admin.dashboard.competencies.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {


        return view('admin.dashboard.competencies.create');
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

        $data = $request->validate($rules);
        if (isset($request->image)) {
            $data['image'] = $request->image;
        }


        $competency = Competency::create($data);

         

   

        return redirect()->route('competencies.index');
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
    public function edit(Competency $competency)
    {
        return view('admin.dashboard.competencies.edit', compact('competency'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Competency $competency)
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
        $data = $request->validate($rules);
        if (isset($request->image)) {
            $data['image'] = $request->image;
        }

        $competency->update($data);


        return redirect()->route('competencies.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $competency = Competency::findOrFail($id);
         
        $competency->delete();

        return redirect()->route('competencies.index');
    }
}
