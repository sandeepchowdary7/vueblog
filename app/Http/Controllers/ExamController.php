<?php

namespace App\Http\Controllers;
use App\Exam;
use Validator;
use App\Subject;
use App\CourseYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exams = Exam::all();
        $result = [];

        foreach ($exams as $exam) {
            $result [] = $this->ResultFormatter($exam);
        }
        return $result;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'exam_date'   =>  'required|year',
        ]);

        $subject = Subject::where('subject_name', Input::get('subject_name'))->first()->id;
        $course = CourseYear::where('year', Input::get('course_year'))->first()->id;

        $exam = new Exam;
        $exam->exam_date =  Input::get('exam_date');
        $exam->subject_id =  $subject;
        $exam->course_year_id =  $course;
        $exam->created_by =  Auth::user()->id;
        $exam->updated_by =  Auth::user()->id;
        
        $exam->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $exam = Exam::findOrFail($id);

        return $this->ResultFormatter($exam);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $exam = Exam::findOrFail($id);
        if($exam) {
            $subject = Subject::where('subject_name', Input::get('subject_name'))->first()->id;
            $course = CourseYear::where('year', Input::get('course_year'))->first()->id;
        } else {
            return "Please contact Admin";
        }

        $exam = new Exam;
        $exam->exam_date =  Input::get('exam_date');
        $exam->subject_id = $subject;
        $exam->course_year_id =  $course;

        $exam->update();
        return $this->ResultFormatter($exam);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $exam = Exam::findOrFail($id);
	    $exam->delete();

		return response()->json([
			"message" => "Success"
		]);
    }

     /**
     * Give you the specific reponse from resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    protected function ResultFormatter($exam) {
		return [
			'Id' => $exam->id,
            'ExamDate' => $exam->exam_date,
            'Subject' => [
                'SubjectId' => $exam->subject->id,
                'SubjectName' => $exam->subject->subject_name,
            ],
            'CourseYear' => [
                'CourseYearId' => $exam->CourseYear->id,
                'CourseYearYear' => $exam->CourseYear->year,
            ],
            'CreatedBy' => $exam->created_by,
			'UpdatedBy' => $exam->updated_by,
			'CreatedAt' => (string) $exam->created_at,
			'UpdatedAt' => (string) $exam->updated_at,
		];
	}
}
