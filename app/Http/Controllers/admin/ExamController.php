<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Skill;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExamController extends Controller
{
    public function index(){
        $data['exams'] = Exam::select('id', 'name', 'skill_id', 'img', 'questions_no', 'active')->orderBy('id', 'DESC')->paginate(10);
        // ->orderBy('id', 'DESC')
        return view('admin.exams.index')->with($data);
    }

    public function show(Exam $exam){
        $data['exam'] = $exam;
        return view('admin.exams.show')->with($data);
    }

    public function showQuestions(Exam $exam){
        $data['exam'] = $exam;
        return view('admin.exams.show-questions')->with($data);
    }

    public function create(){
        $data['skills'] = Skill::select('id', 'name')->get();
        return view('admin.exams.create')->with($data);
    }

    public function store(Request $request){
        $request->validate([
            'nameEn' => 'required|string|max:50',
            'nameAr' => 'required|string|max:50',
            'descEn' => 'required|string',
            'descAr' => 'required|string',
            'skill_id' => 'required|exists:skills,id',
            'img' => 'required|image|max:2048',
            'questionsNo' => 'required|integer|min:1',
            'difficulty' => 'required|integer|min:1|max:5',
            'durationMins' => 'required|integer|min:1' ,
        ]);

        $imgPath = Storage::putFile("exams", $request->file('img'));

        $exam = Exam::create([
            'name' => json_encode([
                'en' => $request->nameEn,
                'ar' => $request->nameAr,
            ]),
            'desc' => json_encode([
                'en' => $request->descEn,
                'ar' => $request->descAr,
            ]),
            'skill_id' => $request->skill_id,
            'img' => $imgPath,
            'questions_no' => $request->questionsNo,
            'difficulty' => $request->difficulty,
            'duration_mins' => $request->durationMins,
            'active' => 0, //Don't be active till the admin add questions to this exam and has the same number of questions

        ]);

        $request->session()->flash('prev', "exam/$exam->id");

        return redirect(url("dashboard/exams/create-questions/{$exam->id}"));
    }

    public function createQuestions(Exam $exam)
    {
        if (session('prev') !== "exam/$exam->id" and session('current') !== "exam/$exam->id") {
            return redirect(url('dashboard/exams'));
        }

        $data['exam_id'] = $exam->id;
        $data['questionsNo'] = $exam->questions_no; //the inputs in create-questions page must be equal question numbers

        return view('admin.exams.create-questions')->with($data);
    }

    public function storeQuestions (Exam $exam, Request $request)
    {
        $request->session()->flash('current', "exam/$exam->id");

        $request->validate([
            'titles' => 'required|array',
            'titles.*' => 'required|string|max:500',
            'rightAns' => 'required|array',
            'rightAns.*' => 'required|in:1,2,3,4',
            'options1' => 'required|array',
            'options1.*' => 'required|string|max:255',
            'options2' => 'required|array',
            'options2.*' => 'required|string|max:255',
            'options3' => 'required|array',
            'options3.*' => 'required|string|max:255',
            'options4' => 'required|array',
            'options4.*' => 'required|string|max:255',
        ]);

        for ($i=0; $i < $exam->questions_no ; $i++) { 
            Question::create([
                'exam_id' => $exam->id,
                'title' => $request->titles[$i],
                'option_1' => $request->options1[$i],
                'option_2' => $request->options2[$i],
                'option_3' => $request->options3[$i],
                'option_4' => $request->options4[$i],
                'right_ans' => $request->rightAns[$i],
            ]);
        }

        $exam->update([
            'active' => 1,
        ]);
        return redirect(url('dashboard/exams'));
    }

    public function edit(Exam $exam){
        $data['skills'] = Skill::select('id', 'name')->get();
        $data['exam'] = $exam;
        return view('admin.exams.edit')->with($data);
    }

    public function update(Exam $exam, Request $request)
    {
        $request->validate([
            'nameEn' => 'required|string|max:50',
            'nameAr' => 'required|string|max:50',
            'descEn' => 'required|string',
            'descAr' => 'required|string',
            'skill_id' => 'required|exists:skills,id',
            'img' => 'nullable|image|max:2048',
            'difficulty' => 'required|integer|min:1|max:5',
            'durationMins' => 'required|integer|min:1' ,
        ]);

        $imgPath = $exam->img;

        if ($request->hasFile('img')) {
            Storage::delete($imgPath);
            $imgPath = Storage::putFile("exams", $request->file('img'));
        }

        $exam->update([
            'name' => json_encode([
                'en' => $request->nameEn,
                'ar' => $request->nameAr,
            ]),
            'desc' => json_encode([
                'en' => $request->descEn,
                'ar' => $request->descAr,
            ]),
            'skill_id' => $request->skill_id,
            'img' => $imgPath,
            'difficulty' => $request->difficulty,
            'duration_mins' => $request->durationMins,
        ]);

        $request->session()->flash('msg', 'Data updated successfully');
        return redirect(url('dashboard/exams'));
              
    }

    public function editQuestions(Exam $exam, Question $question)
    {
        $data['exam'] = $exam;
        $data['question'] = $question;
        return view('admin.exams.edit-questions')->with($data); 
    }

    public function updateQuestions(Exam $exam, Question $question, Request $request)
    {
        // $data =
         $request->validate([
            'titles' => 'required|string|max:500',
            'rightAns' => 'required|in:1,2,3,4',
            'options1' => 'required|string|max:255',
            'options2' => 'required|string|max:255',
            'options3' => 'required|string|max:255',
            'options4' => 'required|string|max:255',
        ]);

        // $question->update($data);

        $question->update([
            'title' => $request->titles,
            'right_ans' => $request->rightAns,
            'option_1' => $request->options1,
            'option_2' => $request->options2,
            'option_3' => $request->options3,
            'option_4' => $request->options4,
        ]);

        return redirect(url("dashboard/exams/show/$exam->id/questions"));
    }

    public function delete(Exam $exam, Request $request){
        try{
            $imgPath = $exam->img;
            $exam->questions()->delete();
            $exam->delete();
            Storage::delete($imgPath);
            $msg = "Data deleted successfully"; 
        }
        catch(Exception){
            $msg = "Data can't deleted successfully"; 

        }

       $request->session()->flash('msg', $msg);
    
        return back();
    }

    public function toggle(Exam $exam){
        if ($exam->questions_no == $exam->questions()->count()) {
            $exam->update([
                'active' => ! $exam->active,
            ]);
        }

        return back();
    }
}
