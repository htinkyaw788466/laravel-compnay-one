<?php

namespace App\Http\Controllers;

use App\Models\HomeAbout;
use App\Models\MultiImage;
use Illuminate\Http\Request;

class HomeAboutController extends Controller
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
        $homeabouts=HomeAbout::latest()->get();
        return view('admin.home-about.index',compact('homeabouts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.home-about.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
            'short_dis'=>'required',
            'long_dis'=>'required'
        ]);

        $about=new HomeAbout();
        $about->title=$request->title;
        $about->short_dis=$request->short_dis;
        $about->long_dis=$request->long_dis;
        $about->save();
        return redirect()->route('home.about')->with('success','success added');
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
        $about=HomeAbout::findOrFail($id);
        return view('admin.home-about.edit',compact('about'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $about=HomeAbout::find($id);
        $about->title=$request->title;
        $about->short_dis=$request->short_dis;
        $about->long_dis=$request->long_dis;
        $about->save();
        return redirect()->route('home.about')->with('success','update success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $about=HomeAbout::find($id);
        $about->delete();
        return redirect()->route('home.about')->with('success','delete success');
    }

    public function Portfolio()
    {
        $images=MultiImage::all();
        return view('pages.portfolio',compact('images'));
    }
}
