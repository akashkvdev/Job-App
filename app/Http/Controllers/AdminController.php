<?php

namespace App\Http\Controllers;

use App\Models\Additionaldata;
use App\Models\Qualification;
use App\Models\Question;
use App\Models\Skill;
use App\Models\Userskill;
use App\Models\Workexperence;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //Load Skill Page
    public function skillPage(){
        $skills = Skill::all();
        return view('admin.addSkills',compact('skills'));
        }


// Add Skills
    public function addSkill(Request $request)
    {
        // return $request->all();
        try {
            Skill::create([
                'skill_name' => $request->skill_name
            ]);
            return response()->json(['success' => true, 'msg' => 'Skill Addedd Successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }
//Show Skills


    //Edit Skill
    public function editSkill(Request $request)
    {
        try {
            $skill = Skill::findOrFail($request->tech_skill_id);
    
            if ($skill) {
                $skill->skill_name = $request->skill_name;
                $skill->save();
                return response()->json(['success' => true, 'msg' => 'Skill Updated Successfully']);
            } else {
                return response()->json(['success' => false, 'msg' => 'Skill not found']);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }
    
    
// Delete Skill
    public function deleteSkill(Request $request)
    {
        try {
            $skill = Skill::where('tech_skill_id', $request->delete_skill_id)->delete();
            return response()->json(['success' => true, 'msg' => 'Skill Deleted Successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }



    // QA Part Start=============================>
     //Load Skill Page
     public function QApageLoad(){
        $questions = Question::all();
        return view('admin.addQA',compact('questions'));
        }

// Add QA
        public function addQA(Request $request)
        {
            // return $request->all();
            try {
                // Extract options from the request
                $options = [
                    'option_1' => $request->input('options')[0],
                    'option_2' => $request->input('options')[1],
                    'option_3' => $request->input('options')[2],
                    'option_4' => $request->input('options')[3],
                ];
        
                // Create the Question with options
                Question::create([
                    'exam_id' => $request->exam_id,
                    'question_text' => $request->question_text,
                    'correct_option' => $request->correct_option,
                    'option_1' => $options['option_1'],
                    'option_2' => $options['option_2'],
                    'option_3' => $options['option_3'],
                    'option_4' => $options['option_4'],
                ]);
        
                return response()->json(['success' => true, 'msg' => 'Question Added Successfully']);
            } catch (\Exception $e) {
                return response()->json(['success' => false, 'msg' => $e->getMessage()]);
            }
        }



        public function addRestdataOfuser(Request $request){
            try {

                $validator = validator($request->all(), [
                    'user_id' => 'required|exists:users,id', // Assuming users table and id field
                    'degree_name' => 'required|string|max:255',
                    'field_of_study' => 'required|string|max:255',
                    'university' => 'required|string|max:255',
                    'passout_year' => 'required|integer|min:1900|max:' . (date('Y') + 1), // assuming a reasonable range
                    'grade' => 'required|string|max:255',
                    'company_name' => 'required|string|max:255',
                    'job_title' => 'required|string|max:255',
                    'start_date' => 'required|date',
                    'end_date' => 'nullable|date|after_or_equal:start_date',
                    // 'responsibilities' => 'required|string',
                    // 'certification' => 'required|string|max:255',
                    'language_spoken' => 'required|string|max:255',
                    // 'hobbies' => 'required|string|max:255',
                    // 'cover_letter' => 'required|string',
                    // 'user_skills1' => 'required|string|max:255',
                    // 'user_skills2' => 'nullable|string|max:255',
                    // 'user_skills3' => 'nullable|string|max:255',
                    // 'user_skills4' => 'nullable|string|max:255',
                    // 'user_skills5' => 'nullable|string|max:255',
                ]);


                if ($validator->fails()) {
                    // Validation failed, return error response
                    return response()->json(['success' => false, 'msg' => $validator->errors()->first()]);
                }
               $Qalification= Qualification::create([
                    'user_id'=>$request->user_id,'degree_name'=>$request->degree_name ,'field_of_study'=>$request->field_of_study,'university'=>$request->university,'passout_year'=>$request->passout_year,'grade'=>$request->grade
                ]);

               $WorkExp= Workexperence::create([
                    'user_id'=>$request->user_id,'company_name'=>$request->company_name,'job_title'=>$request->job_title,'start_date'=>$request->start_date,'end_date'=>$request->end_date,'responsibilities'=>$request->responsibilities
                ]);

               $Additionaldata= Additionaldata::create([
                    'user_id'=>$request->user_id,'certification'=>$request->certification,'language_spoken'=>$request->language_spoken,'hobbies'=>$request->hobbies,'cover_letter'=>$request->cover_letter
                ]);

               $UsersSkills= Userskill::create([
                    'user_id'=>$request->user_id,'user_skills1'=>$request->user_skills1,'user_skills2'=>$request->user_skills2,'user_skills3'=>$request->user_skills3,'user_skills4'=>$request->user_skills4,'user_skills5'=>$request->user_skills5
                ]);


                return response()->json(['success' => true, 'msg' =>'Your Data has been updated']);
            } catch (\Exception $e) {
                return response()->json(['success' => false, 'msg' => $e->getMessage()]);
            }
        }
}
