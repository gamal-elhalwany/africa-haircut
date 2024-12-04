<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function main_slider()
    {
        return view('dashboard.sliders.main');
    }

    public function createMainSilder(Request $request)
    {
        $validate = $request->validate(
            [
                'description' => 'nullable|min:25',
                'image' => 'required|mimes:jpg,jpeg,png,gif,svg|dimensions:min_height=600,max_height=675',
            ],
            [
                'description.required' => 'حقل الوصف مطلوب',
                'description.min' => 'حقل الوصف يجب ان لا يقل عن 25 حرف.',
                'image.required' => 'حقل الصورة مطلوب.',
                'image.mimes' => 'حقل الصورة لابد وان يكون من نوع jpg, jpeg, png, gif,
            svg',
            'image.dimensions' => 'يجب ان لا تزيد ابعاد الصورة عن 675 ارتفاع و لا تقل عن 400'
            ]
        );

        $image = $request->file('image');
        $path = $image->store('images/sliders', 'public');
        $data = $request->all();
        $data['image'] = $path;
        Slider::create($data);
        toastr()->success('تم اضافه الصورة بنجاح');
        return redirect()->back();
    }
}
