<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\ContactForm;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Cast\String_;

class AdminContactController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
    }
    public function index()
    {
        $contacts=Contact::all();
        return view('admin.contact.index',compact('contacts'));
    }

    public function create()
    {
        return view('admin.contact.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'email'=>'required',
            'phone'=>'required',
            'address'=>'required'
        ]);

        $about=new Contact();
        $about->email=$request->email;
        $about->phone=$request->phone;
        $about->address=$request->address;
        $about->save();
        return redirect()->route('home.contact')->with('success','success added');
    }

    public function edit(string $id)
    {
        $contact=Contact::findOrFail($id);
        return view('admin.contact.edit',compact('contact'));
    }

    public function update(Request $request, string $id)
    {
        $about=Contact::find($id);
        $about->email=$request->email;
        $about->phone=$request->phone;
        $about->address=$request->address;
        $about->save();
        return redirect()->route('home.contact')->with('success','success updated');
    }

    public function destroy(string $id)
    {
        $contact=Contact::find($id);
        $contact->delete();
        return redirect()->route('home.contact')->with('success','delete success');
    }

    public function contact()
    {
        $contact=DB::table('contacts')->first();
        return view('pages.contact',compact('contact'));
    }

    public function contactForm(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required',
            'subject'=>'required',
            'message'=>'required'
        ]);

        $about=new ContactForm();
        $about->name=$request->name;
        $about->email=$request->email;
        $about->subject=$request->subject;
        $about->message=$request->message;
        $about->save();
        return redirect()->route('contact')->with('success','message sent');
    }

    public function listMessage()
    {
        $messages=ContactForm::all();
        return view('admin.contact.message',compact('messages'));
    }

    public function messageDestroy(String $id)
    {
        $message=ContactForm::findOrFail($id);
        $message->delete();
        return redirect()->route('admin.message')->with('success','delete success');
    }
}
