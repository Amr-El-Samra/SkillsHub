<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Cat;
use Exception;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class CatController extends Controller
{
    public function index(){
        $data['cats'] = Cat::orderBy('id', 'DESC')->paginate(10);
        return view('admin.cats.index')->with($data);
    }

    public function store(Request $request){
        $request->validate([
            'nameEn' => 'required|string|max:50',
            'nameAr' => 'required|string|max:50',
        ]);

        Cat::create([
            'name' => json_encode([
                'en' => $request->nameEn,
                'ar' => $request->nameAr
            ])
        ]);

        $request->session()->flash('msg', 'Data added successfully');

        return back();
    }

    public function update(Request $request){
        $request->validate([
            'id' => 'required|exists:cats,id',
            'nameEn' => 'required|string|max:50',
            'nameAr' => 'required|string|max:50',
        ]);

        Cat::findOrFail($request->id)->update([
            'name' => json_encode([
                'en' => $request->nameEn,
                'ar' => $request->nameAr
            ])
        ]);

        $request->session()->flash('msg', 'Data updated successfully');

        return back();
    }

    public function delete(Cat $cat, Request $request){
        try{
            $cat->delete();
            $msg = "Data deleted successfully"; 
        }
        catch(Exception){
            $msg = "Data can't deleted successfully"; 

        }

       $request->session()->flash('msg', $msg);
    
        return back();
    }

    public function toggle(Cat $cat){
        $cat->update([
            'active' => ! $cat->active,
        ]);

        return back();
    }
}
