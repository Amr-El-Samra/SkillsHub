<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function index(){
        $data['contact'] = Setting::select('email', 'phone')->first();
        return view('web.contact.index')->with($data);
    }

    // public function send(Request $request){
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|email|max:255',
    //         'subject' => 'nullable|string|max:255',
    //         'body' => 'required|string',
    //     ]);

    //     if($validator->fails()){
    //         return redirect(url('/contact'))->withErrors($validator->errors());
    //     }
    //     Message::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'subject' => $request->subject,
    //         'body' => $request->body,
    //     ]);
    //     $request->session()->flash('success', 'Your Message Sent Successfully');
    //     return back();
    // }

    public function send(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'body' => 'required|string',
        ]);
        Message::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'body' => $request->body,
        ]);
        $data = ['success'=> 'Your Message Sent Successfully'];
        return Response::json($data);
    }
}
