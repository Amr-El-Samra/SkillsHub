<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Cat;
use App\Models\Skill;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SkillController extends Controller
{
    public function index(){
        $data['skills'] = Skill::orderBy('id', 'DESC')->paginate(10);
        $data['cats'] = Cat::select('id', 'name')->get();
        return view('admin.skills.index')->with($data);
    }

    public function store(Request $request){
        $request->validate([
            'nameEn' => 'required|string|max:50',
            'nameAr' => 'required|string|max:50',
            'img' => 'required|image|max:2048',
            'cat_id' => 'required|exists:cats,id'
        ]);

        $imgPath = Storage::putFile("skills", $request->file('img'));

        Skill::create([
            'name' => json_encode([
                'en' => $request->nameEn,
                'ar' => $request->nameAr,
            ]),
            'img' => $imgPath,
            'cat_id' => $request->cat_id,
        ]);

        $request->session()->flash('msg', 'Data added successfully');

        return back();
    }

    public function update(Request $request){
        $request->validate([
            'id' => 'required|exists:skills,id',
            'nameEn' => 'required|string|max:50',
            'nameAr' => 'required|string|max:50',
            'img' => 'nullable|image|max:2048',
            'cat_id' => 'required|exists:cats,id'
        ]);

        $skill = Skill::findOrFail($request->id);
        $imgPath = $skill->img;

        if ($request->hasFile('img')) {
            Storage::delete($imgPath);
            $imgPath = Storage::putFile("skills", $request->file('img'));
        }

        $skill->update([
            'name' => json_encode([
                'en' => $request->nameEn,
                'ar' => $request->nameAr
            ]),
            'img' => $imgPath,
            'cat_id' => $request->cat_id,
        ]);

        $request->session()->flash('msg', 'Data updated successfully');

        return back();
    }

    public function delete(Skill $skill, Request $request){
        try{
            $imgPath = $skill->img;
            $skill->delete();
            Storage::delete($imgPath);
            $msg = "Data deleted successfully"; 
        }
        catch(Exception){
            $msg = "Data can't deleted successfully"; 

        }

       $request->session()->flash('msg', $msg);
    
        return back();
    }

    public function toggle(Skill $skill){
        $skill->update([
            'active' => ! $skill->active,
        ]);

        return back();
    }
}
