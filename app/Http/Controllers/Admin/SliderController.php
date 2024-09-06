<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Slider::latest()->get();
        return view("admin.dashboard.sliders.index", compact("data"));
         
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.dashboard.sliders.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "status"=> "required",
        ]);
        $allDataExceptImages = $request->except('images');
        $slider = Slider::create($allDataExceptImages);
        // if($request->hasFile('images')) 
        // {
        //     $imageUrls = [];
        //     foreach ($request->file('images') as $image) {
        //         $uploadedImage = $slider->addMedia($image)->toMediaCollection('images');
        //         $imageUrls[] = $uploadedImage->getUrl();
        //     }

        //     // يمكنك تخزين الروابط كأرشف فردي أو مصفوفة JSON في عمود قاعدة البيانات
        //     $slider->update(['images' => json_encode($imageUrls)]);
        // }


        if ($request->file('images')) {
            $uploadedlogo = $slider->addMediaFromRequest('images')->toMediaCollection('images');
            $slider->update([
                'images' => $uploadedlogo->getUrl()
            ]);
        }


        

        return redirect()->route('sliders.index')->with('success','تم انشاء بالنجاح');


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
    public function edit(Slider $slider)
    {
        return view("admin.dashboard.sliders.edit" , compact("slider"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            "status"=> "required",
        ]);
        $allDataExceptImages = $request->except('images');
        $slider->update($allDataExceptImages);
        // if ($request->hasFile('images')) {
        //     // حذف الوسائط القديمة
        //     $slider->clearMediaCollection('images');

        //     $imageUrls = [];
        //     foreach ($request->file('images') as $image) {
        //         $uploadedImage = $slider->addMedia($image)->toMediaCollection('images');
        //         $imageUrls[] = $uploadedImage->getUrl();
        //     }

        //     // تحديث حقل الصورة في قاعدة البيانات
        //     $slider->update([
        //         'images' => json_encode($imageUrls),
        //     ]);
        // }


        if ($request->hasFile('images')) {
            // حذف الوسائط القديمة للشعار
            $oldimages = $slider->getFirstMedia('images');
            if ($oldimages) {
                $oldimages->delete();
            }

            // رفع الشعار الجديد
            $uploadedimages = $slider->addMediaFromRequest('images')->toMediaCollection('images');

            // تحديث حقل الشعار في قاعدة البيانات
            $slider->update([
                'images' => $uploadedimages->getUrl(),
            ]);
        }

        return redirect()->route('sliders.index')->with('success','تم تعديل بالنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);
        $slider->clearMediaCollection('images');
        $slider->delete();
        return redirect()->route('sliders.index')->with('success','تم الحذف بالنجاح');
    }
}
