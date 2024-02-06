<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Slider;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders=Slider::latest()->get();
        return view('admin.slider.index',compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $this->validate($request,[
            'title'=>'required',
            'description'=>'required',
            'image'=>'required|mimes:png,jpg,jpeg'
        ]);

        // Get Form Image
        $image = $request->file('image');
        if (isset($image)) {

            // Make Unique Name for Image
            $currentDate = Carbon::now()->toDateString();
            $imagename = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            // Check slider Dir is exists
            if (!Storage::disk('public')->exists('slider')) {
                Storage::disk('public')->makeDirectory('slider');
            }

            // Resize Image for brand and upload
            $slider = Image::make($image)->resize(1920,1088)->stream();
            Storage::disk('public')->put('slider/' . $imagename, $slider);

        } else {
            $imagename = 'default.png';
        }

       $slider=new Slider();
       $slider->title=$request->title;
       $slider->description=$request->description;
       $slider->image=$imagename;
       $slider->save();
       return redirect()->route('home.slider')
              ->with('success','slider insert successfully');
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
    public function edit(string $id)
    {
        $slider=Slider::findOrFail($id);
        return view('admin.slider.edit',compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request,[
            'title'=>'required',
            'description'=>'required',
            'image'=>'required|mimes:jpg,jpeg,png'
        ]);

         // Get Form Image
         $image = $request->file('image');
         $slider=Slider::find($id);
         if (isset($image)) {

             // Make Unique Name for Image
             $currentDate = Carbon::now()->toDateString();
             $imagename = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

             // Check Brand Dir is exists
             if (!Storage::disk('public')->exists('slider')) {
                 Storage::disk('public')->makeDirectory('slider');
             }

             // Delete Old Image
            if (Storage::disk('public')->exists('slider/' . $slider->image)) {
                Storage::disk('public')->delete('slider/' . $slider->image);
            }

             // Resize Image for brand and upload
             $slider = Image::make($image)->resize(1920,1088)->stream();
             Storage::disk('public')->put('slider/' . $imagename, $slider);

         } else {
            $imagename = $slider->image;
         }


        $slider=Slider::find($id);
        $slider->title=$request->title;
        $slider->description=$request->description;
        $slider->image=$imagename;
        $slider->save();
        return redirect()->route('home.slider')
               ->with('success','slider updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $slider = Slider::find($id);

       // Delete Old Image
          if (Storage::disk('public')->exists('slider/'.$slider->image)) {
              Storage::disk('public')->delete('slider/'.$slider->image);
            }

            $slider->delete();
             return redirect()->route('home.slider')
             ->with('alert','slider deleted successfully');
    }
}
