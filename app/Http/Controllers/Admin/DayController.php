<?php

namespace App\Http\Controllers\Admin;

use App\Models\Day;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class DayController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Day::latest()->get();
        return view('admin.dashboard.days.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        
        return view('admin.dashboard.days.create' );

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

        }

       $validation = $request->validate($rules);

        $data = $request->all();

        Day::create($data);








        return redirect()->route('days.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Day $day)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Day $day)
    {
         
        return view('admin.dashboard.days.edit', compact('day'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Day $day)
    {


        $locales = LaravelLocalization::getSupportedLocales();

        $rules = [
             
            'status' => 'required|string',
        ];

        foreach($locales  as $localeCode => $properties) {
            $rules["{$localeCode}.name"] = 'required|string';

        }

         $request->validate($rules);
         $data = $request->all();

        $day->update($data);
       return redirect()->route('days.index');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Day $day)
    {
        $day->delete();
       return redirect()->route('days.index');

    }
}
