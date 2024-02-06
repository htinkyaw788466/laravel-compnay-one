<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Brand;
use App\Models\MultiImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
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
        $brands=Brand::latest()->paginate(5);
        return view('admin.brand.index',compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'brand_name'=>'required|unique:brands',
            'brand_image'=>'required|mimes:jpg,jpeg,png'
        ]);

         // Get Form Image
         $image = $request->file('brand_image');
         if (isset($image)) {

             // Make Unique Name for Image
             $currentDate = Carbon::now()->toDateString();
             $imagename = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

             // Check Brand Dir is exists
             if (!Storage::disk('public')->exists('brand')) {
                 Storage::disk('public')->makeDirectory('brand');
             }

             // Resize Image for brand and upload
             $brand = Image::make($image)->resize(300,200)->stream();
             Storage::disk('public')->put('brand/' . $imagename, $brand);

         } else {
             $imagename = 'default.png';
         }

        $brand=new Brand();
        $brand->brand_name=$request->brand_name;
        $brand->brand_image=$imagename;
        $brand->save();
        $notification = array(
            'message' => 'Brand Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()
               ->with($notification);
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
        $brand=Brand::find($id);
        return view('admin.brand.edit',compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request,[
            'brand_name'=>'required',
            'brand_image'=>'required|mimes:jpg,jpeg,png'
        ]);

         // Get Form Image
         $image = $request->file('brand_image');
         $brand=Brand::find($id);
         if (isset($image)) {

             // Make Unique Name for Image
             $currentDate = Carbon::now()->toDateString();
             $imagename = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

             // Check Brand Dir is exists
             if (!Storage::disk('public')->exists('brand')) {
                 Storage::disk('public')->makeDirectory('brand');
             }

             // Delete Old Image
            if (Storage::disk('public')->exists('brand/' . $brand->brand_image)) {
                Storage::disk('public')->delete('brand/' . $brand->brand_image);
            }

             // Resize Image for brand and upload
             $brand = Image::make($image)->resize(300,200)->stream();
             Storage::disk('public')->put('brand/' . $imagename, $brand);

         } else {
            $imagename = $brand->brand_image;
         }


        $brand=Brand::find($id);
        $brand->brand_name=$request->brand_name;
        $brand->brand_image=$imagename;
        $brand->save();
        $notification = array(
            'message' => 'Brand Updated Successfully',
            'alert-type' => 'info'
        );
        return redirect()->route('all.brand')
               ->with($notification);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::find($id);

       // Delete Old Image
          if (Storage::disk('public')->exists('brand/'.$brand->brand_image)) {
              Storage::disk('public')->delete('brand/'.$brand->brand_image);
            }

            $brand->delete();
            $notification = array(
                'message' => 'Brand Delete Successfully',
                'alert-type' => 'error'
            );
             return redirect()->route('all.brand')
             ->with($notification);
    }

    public function multiImage(){
        $images=MultiImage::all();
        return view('admin.multipic.index',compact('images'));
    }

    public function multiStore(Request $request){

        $this->validate($request,[
            'image'=>'required'
        ]);

        $image=$request->file('image');
        foreach($image as $multiImg){
            if (isset($multiImg)) {

                // Make Unique Name for Image
                $currentDate = Carbon::now()->toDateString();
                $imagename = $currentDate . '-' . uniqid() . '.' . $multiImg->getClientOriginalExtension();

                // Check Brand Dir is exists
                if (!Storage::disk('public')->exists('multi/image')) {
                    Storage::disk('public')->makeDirectory('multi/image');
                }

                // Resize Image for multi and upload
                $multiImg = Image::make($multiImg)->resize(300,300)->stream();
                Storage::disk('public')->put('multi/image/' . $imagename, $multiImg);

            } else {
                $imagename = 'default.png';
            }

           $multiImg=new MultiImage();
           $multiImg->image=$imagename;
           $multiImg->save();
        }

        return redirect()->back()
                  ->with('success','multi image created successfully');
    }

    public function Logout()
    {
        Auth::logout();
        return Redirect()->route('login')->with('success','user logout');
    }
}
