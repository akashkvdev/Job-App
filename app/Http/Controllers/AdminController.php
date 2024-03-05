<?php

namespace App\Http\Controllers;

use App\Models\Additionaldata;
use App\Models\Exam;
use App\Models\Qualification;
use App\Models\Question;
use App\Models\Skill;
use App\Models\Userskill;
use App\Models\Workexperence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $exams=Exam::all();
        return view('admin.addQA',compact('questions','exams'));
        }

// Add QA
public function addQA(Request $request)
{
    try {
        // Define validation rules
        $rules = [
            'exam_id' => 'required',
            'question_text' => 'required',
            'correct_option' => 'required',
            'options.*' => 'nullable', // Allow null values for options
        ];

        // Validate the request data
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            // Validation failed, return error response
            return response()->json(['success' => false, 'msg' => $validator->errors()->first()]);
        }

        // Extract options from the request
        $inputOptions = $request->input('options', []);

        // Set default values for options if they are not present
        $options = [
            'option_1' => $inputOptions[0] ?? null,
            'option_2' => $inputOptions[1] ?? null,
            'option_3' => $inputOptions[2] ?? null,
            'option_4' => $inputOptions[3] ?? null,
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



        // public function addRestdataOfuser(Request $request){
        //     try {

        //         $validator = validator($request->all(), [
        //             'user_id' => 'required|exists:users,id', // Assuming users table and id field
        //             'degree_name' => 'required|string|max:255',
        //             'field_of_study' => 'required|string|max:255',
        //             'university' => 'required|string|max:255',
        //             'passout_year' => 'required|integer|min:1900|max:' . (date('Y') + 1), // assuming a reasonable range
        //             'grade' => 'required|string|max:255',
        //             'company_name' => 'required|string|max:255',
        //             'job_title' => 'required|string|max:255',
        //             'start_date' => 'required|date',
        //             'end_date' => 'nullable|date|after_or_equal:start_date',
        //             // 'responsibilities' => 'required|string',
        //             // 'certification' => 'required|string|max:255',
        //             'language_spoken' => 'required|string|max:255',
        //             // 'hobbies' => 'required|string|max:255',
        //             // 'cover_letter' => 'required|string',
        //             // 'user_skills1' => 'required|string|max:255',
        //             // 'user_skills2' => 'nullable|string|max:255',
        //             // 'user_skills3' => 'nullable|string|max:255',
        //             // 'user_skills4' => 'nullable|string|max:255',
        //             // 'user_skills5' => 'nullable|string|max:255',
        //         ]);


        //         if ($validator->fails()) {
        //             // Validation failed, return error response
        //             return response()->json(['success' => false, 'msg' => $validator->errors()->first()]);
        //         }
        //        $Qalification= Qualification::create([
        //             'user_id'=>$request->user_id,'degree_name'=>$request->degree_name ,'field_of_study'=>$request->field_of_study,'university'=>$request->university,'passout_year'=>$request->passout_year,'grade'=>$request->grade
        //         ]);

        //        $WorkExp= Workexperence::create([
        //             'user_id'=>$request->user_id,'company_name'=>$request->company_name,'job_title'=>$request->job_title,'start_date'=>$request->start_date,'end_date'=>$request->end_date,'responsibilities'=>$request->responsibilities
        //         ]);

        //        $Additionaldata= Additionaldata::create([
        //             'user_id'=>$request->user_id,'certification'=>$request->certification,'language_spoken'=>$request->language_spoken,'hobbies'=>$request->hobbies,'cover_letter'=>$request->cover_letter
        //         ]);

        //        $UsersSkills= Userskill::create([
        //             'user_id'=>$request->user_id,'user_skills1'=>$request->user_skills1,'user_skills2'=>$request->user_skills2,'user_skills3'=>$request->user_skills3,'user_skills4'=>$request->user_skills4,'user_skills5'=>$request->user_skills5
        //         ]);


        //         return response()->json(['success' => true, 'msg' =>'Your Data has been updated']);
        //     } catch (\Exception $e) {
        //         return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        //     }
        // }


        public function addRestdataOfuser(Request $request)
{
    try {
        $validator = validator($request->all(), [
            'user_id' => 'required|exists:users,id',
            // 'user_skills1' => 'nullable|string|max:255',
            // 'user_skills2' => 'nullable|string|max:255',
            // 'user_skills3' => 'nullable|string|max:255',
            // 'user_skills4' => 'nullable|string|max:255',
            // 'user_skills5' => 'nullable|string|max:255',
            // 'degree_name' => 'required|string|max:255',
            // 'field_of_study' => 'required|string|max:255',
            // 'university' => 'required|string|max:255',
            // 'passout_year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            // 'grade' => 'required|string|max:255',
            // 'company_name' => 'required|string|max:255',
            // 'job_title' => 'required|string|max:255',
            // // 'start_date' => 'required|date',
            // // 'end_date' => 'nullable|date|after_or_equal:start_date',
            // // 'certification' => 'required|string|max:255',
            // 'language_spoken' => 'required|string|max:255',
            // 'hobbies' => 'required|string|max:255',
            // 'cover_letter' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'msg' => $validator->errors()->first()]);
        }

        // Check if skills data exists for the user
        $existingSkills = Userskill::where('user_id', $request->user_id)->first();

        if ($existingSkills) {
            // Skills exist, update the existing skills
            $existingSkills->update([
                'user_skills1' => $request->skill1,
                'user_skills2' => $request->skill2,
                'user_skills3' => $request->skill3,
                'user_skills4' => $request->skill4,
                'user_skills5' => $request->skill5,
            ]);
        } else {
            // Skills do not exist, create new skills data
            Userskill::create([
                'user_id' => $request->user_id,
                'user_skills1' => $request->skill1,
                'user_skills2' => $request->skill2,
                'user_skills3' => $request->skill3,
                'user_skills4' => $request->skill4,
                'user_skills5' => $request->skill5,
            ]);
        }

        // Check if qualification data exists for the user
        $existingQualification = Qualification::where('user_id', $request->user_id)->first();

        if ($existingQualification) {
            // Qualification data exists, update the existing qualification
            $existingQualification->update([
                'degree_name' => $request->degree_name,
                'field_of_study' => $request->field_of_study,
                'university' => $request->university,
                'passout_year' => $request->passout_year,
                'grade' => $request->grade,
            ]);
        } else {
            // Qualification data does not exist, create new qualification data
            Qualification::create([
                'user_id' => $request->user_id,
                'degree_name' => $request->degree_name,
                'field_of_study' => $request->field_of_study,
                'university' => $request->university,
                'passout_year' => $request->passout_year,
                'grade' => $request->grade,
            ]);
        }

        // Repeat the same logic for work experience and additional data

        // Check if work experience data exists for the user
        $existingWorkExp = Workexperence::where('user_id', $request->user_id)->first();

        if ($existingWorkExp) {
            // Work experience data exists, update the existing work experience
            $existingWorkExp->update([
                'company_name' => $request->company_name,
                'job_title' => $request->job_title,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'responsibilities' => $request->responsibilities,
            ]);
        } else {
            // Work experience data does not exist, create new work experience data
            Workexperence::create([
                'user_id' => $request->user_id,
                'company_name' => $request->company_name,
                'job_title' => $request->job_title,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'responsibilities' => $request->responsibilities,
            ]);
        }

        // Check if additional data exists for the user
        $existingAdditionalData = Additionaldata::where('user_id', $request->user_id)->first();

        if ($existingAdditionalData) {
            // Additional data exists, update the existing additional data
            $existingAdditionalData->update([
                'certification' => $request->certification,
                'language_spoken' => $request->language_spoken,
                'hobbies' => $request->hobbies,
                'cover_letter' => $request->cover_letter,
            ]);
        } else {
            // Additional data does not exist, create new additional data
            Additionaldata::create([
                'user_id' => $request->user_id,
                'certification' => $request->certification,
                'language_spoken' => $request->language_spoken,
                'hobbies' => $request->hobbies,
                'cover_letter' => $request->cover_letter,
            ]);
        }

        return response()->json(['success' => true, 'msg' => 'Your Data has been updated']);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'msg' => $e->getMessage()]);
    }
}




        // Exam page Load 
        public function ExamPageLoad(){
            $exam = Exam::all();
            return view('admin.addExam',compact('exam'));
            }

        
            // Add Exam
            public function addExam(Request $request)
            {
                try {
                    // Validate the request
                    $request->validate([
                        'exam_name' => 'required',
                        'exam_date' => 'required|date',
                        'total_marks' => 'required|numeric',
                        'examImage' => 'required|image|mimes:jpeg,png,jpg,gif',
                    ]);
            
                    // Handle file upload
                    $imageExtension = $request->file('examImage')->getClientOriginalExtension();
                    $imageName = 'exam_image_' . time() . '.' . $imageExtension;
                    $imagePath = $request->file('examImage')->storeAs('exam_images', $imageName, 'public');
            
                    // Save exam details to the database
                    Exam::create([
                        'exam_name' => $request->exam_name,
                        'exam_date' => $request->exam_date,
                        'total_marks' => $request->total_marks,
                        'examImage' => $imageName,
                    ]);
            
                    return response()->json(['success' => true, 'msg' => 'Exam Added Successfully']);
                } catch (\Exception $e) {
                    return response()->json(['success' => false, 'msg' => $e->getMessage()]);
                }
            }
}
