<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    public function show($id){
        $data['exam'] = Exam::findOrFail($id);
        $data['canViewStartExamBtn'] = true;
        $user = Auth::user();
        
        if ($user !== null) {
            
            $pivotRow = $user->exams()->where('exam_id', $id)->active()->first();

            if ($pivotRow !== null and $pivotRow->pivot->status == 'closed') {
                $data['canViewStartExamBtn'] = false;
            }
            
        }

        return view('web.exams.show')->with($data);
    }

    public function start($examId, Request $request){
        $user = Auth::user();
        $user->exams()->attach($examId);
        $request->session()->flash('prevPage', "start/$examId");
        return redirect(url("/exams/questions/$examId"));
    }

    
    public function questions($examId, Request $request){
        if (session('prevPage') !== "start/$examId") {
            return redirect(url("exams/show/$examId"));
        }
        $data['exam'] = Exam::findOrFail($examId);
        $request->session()->flash('prevPage', "questions/$examId");
        $data['questions'] = $data['exam']->questions;
        return view('web.exams.questions')->with($data);
    }


    public function submit($examId, Request $request){

        if (session('prevPage') !== "questions/$examId") {
            return redirect(url("exams/show/$examId"));
        }
        // Calculating Score

        $exam = Exam::findOrFail($examId);
        $points = 0;
        $totalQuesNum = $exam->questions()->count();

        foreach( $exam->questions as $question){
            if(isset($request->answers[$question->id])){
                $userAns = $request->answers[$question->id];
                $rightAns = $question->right_ans;

                if ($userAns == $rightAns) {
                    $points += 1;
                }
            }
        }
        $score = ($points / $totalQuesNum) * 100;
        
        // Calculating TimeMins
        
        $user = Auth::user();
        $pivotRow = $user->exams()->where('exam_id', $examId)->first();
        $startTime = $pivotRow->pivot->created_at;
        $submitTime = Carbon::now();
        $timeMins = $submitTime->diffInMinutes($startTime);
        if ($timeMins > $pivotRow->duration_mins) {
            $score = 0;
        }

        // Update Pivot Table
        $user->exams()->updateExistingPivot($examId, [
            'score' => $score,
            'time_mins' => $timeMins,
        ]);
        $request->session()->flash("success", "You finished exam successfully with score $score%");
        return redirect(url("exams/show/$examId"));
    }

}
