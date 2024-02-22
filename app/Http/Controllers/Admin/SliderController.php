<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class SliderController extends Controller
{
    public function index()
    {
        $slide = Slider::latest()->get();
        return view('admin.slider.index', ['title' => 'Slider'], compact('slide'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.slider.create', ['title' => 'Create Slider']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg|max:3048',
        ]);

        if ($request->hasFile('image')) {
            $name = $request->file('image');
            $fileName = 'slide' . time() . '.' . $name->getClientOriginalExtension();
            Storage::putFileAs('/public/images_slide', $request->file('image'), $fileName);
        }

        Slider::create([
            'caption' => $request->caption,
            'status' => $request->status,
            'image' => $fileName,
        ]);

        Alert::success('Success', 'Slider Successfully Added');

        return redirect()->route('slider.index');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Slider $slider)
    {
        return view('admin.slider.edit', ['title' => 'Edit Slide'], compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'image' => 'image|mimes:jpg,png,jpeg|max:3048',
        ]);

        if ($request->hasFile('image')) {
            // Menghapus file lama dari storage
            Storage::delete('public/images_slide/' . $slider->image);

            // Upload file baru dengan format nama ditentukan
            $name = $request->file('image');
            $fileName = 'slider_' . time() . '.' . $name->getClientOriginalExtension();
            $request->file('image')->storeAs('public/images_slide', $fileName);

            // Update file di database
            $slider->update([
                'caption' => $request->caption,
                'status' => $request->status,
                'image' => $fileName,
            ]);

            Alert::success('Sukses', 'Data berhasil di Update!!');
            return redirect()->route('slider.index');
        } else {

            $slider->update([
                'caption' => $request->caption,
                'status' => $request->status,
            ]);

            Alert::success('Success', 'Slider Success Updated');
            return redirect()->route('slider.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $slider)
    {
        $slider->delete();
        return redirect()->route('slider.index');
    }
}
