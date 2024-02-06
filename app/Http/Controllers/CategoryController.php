<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    protected $limited=5;
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$categories=DB::table('categories')->latest()->get();

        // $categories=DB::table('categories')
        //             ->join('users','categories.user_id','users.id')
        //             ->select('categories.*','users.name')
        //             ->latest()->paginate($this->limited);

        //$categories=Category::all();

        $categories=Category::latest()->paginate(6);
        $trashCategory=Category::onlyTrashed()->latest()->paginate(3);
        return view('admin.category.index',compact('categories','trashCategory'));
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
        //validate error message one
        // $this->validate($request,[
        //     'category_name'=>'required|unique:categories|max:255'
        // ],['category_name'=>'please input category name']);



        //validate error message two
        $this->validate($request,[
            'category_name'=>'required|unique:categories|max:255'
        ],['category_name.max'=>'category less then 255 char']);

        //validate data array one
        // $data=array();
        // $data['category_name']=$request->category_name;
        // $data['user_id']=Auth::user()->id;
        // DB::table('categories')->insert($data);

        //insert method two with query
        // Category::insert([
        //     'category_name'=>$request->category_name,
        //     'user_id'=>Auth::user()->id,
        //     'created_at'=>Carbon::now()
        // ]);

        //insert method three with laravel model
        $category=new Category();
        $category->category_name=$request->category_name;
        $category->user_id=Auth::user()->id;
        $category->save();
        return redirect()->back()->with('success','category created successfully');
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
        $category=Category::findOrFail($id);
        return view('admin.category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //update method one
        // $updateCategory=Category::find($id)->update([
        //     'category_name'=>$request->category_name,
        //     'user_id'=>Auth::user()->id
        // ]);

        //update with array data two
        // $data=array();
        // $data['category_name']=$request->category_name;
        // $data['user_id']=Auth::user()->id;
        // DB::table('categories')->where('id',$id)->update($data);

        //update method three
        $category=Category::find($id);
        $category->category_name=$request->category_name;
        $category->user_id=Auth::user()->id;
        $category->save();
        return redirect()->route('all.category')->with('success','category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function softDestroy(string $id)
    {
        $category=Category::findOrFail($id);
        $category->delete();
        return redirect()->back()->with('alert',' category soft delete successfully');
    }

    public function restore($id){
        $store=Category::withTrashed()->find($id)->restore();
        return redirect()->route('all.category')->with('success','category restored successfully');
    }

    public function perDestroy($id){
        $delete=Category::withTrashed()->find($id)->forceDelete();
        return redirect()->back()->with('warning',' category  delete successfully');
    }
}
