<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Question;
use App\Models\Skill;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    public function makeProfileVisible()
    {
        $exams = Exam::all();
        $skills = Skill::all();
        return view('users.makeVisibleprofile', compact('exams','skills'));
    }

    public function SkillExam($id)
    {
        $exam = Exam::find($id);
        $questions = Question::where('exam_id', $id)->get();
        // Assuming you want to pass $exam to the view
        return view('users.SkillExam', compact('exam', 'questions'));
    }


    public function submitAnswers(Request $request)
    {
        try {
            // Retrieve and process the submitted answers
            $examId = $request->input('examId');
            $selectedOptions = $request->input('selectedOptions');
    
            // Retrieve correct answers from the database using the Question model
            $correctAnswers = Question::where('exam_id', $examId)
                ->pluck('correct_option', 'question_id');
    
            // Initialize total score
            $totalScore = 0;
    
            // Loop through each selected option
            foreach ($selectedOptions as $selectedOption) {
                $questionId = $selectedOption['questionId'];
                $selectedValue = $selectedOption['optionValue'];
    
                // Check if the questionId exists in both arrays
                if (isset($correctAnswers[$questionId])) {
                    // Check if the selected option is correct
                    $questionScore = ($selectedValue == $correctAnswers[$questionId]) ? 1 : 0;
                    
                    // Accumulate individual question scores to the total score
                    $totalScore += $questionScore;
                }
            }
    
            return response()->json(['totalScore' => $totalScore]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Model not found'], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
}
