<?php

namespace App\Http\Controllers;
use App\CourseYear;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Input;
use App\StudentGroupDetail;
use App\Student;

class CourseYearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courseYears = CourseYear::all();
        $result = [];

        foreach ($courseYears as $courseYear) {
            $result [] = $this->ResultFormatter($courseYear);
        }
        return $result;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('courseYear.create');
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
            	'year'   =>  'required|year',
        ]);

        $courseYear = new CourseYear;
        $courseYear->year =  Input::get('year');
        
        $courseYear->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CourseYear  $courseYear
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $courseYear = CourseYear::findOrFail($id);

        return $this->ResultFormatter($courseYear);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\CourseYear  $courseYear
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $courseYear = CourseYear::findOrFail($id);

        $courseYear = new CourseYear;
        $courseYear->year =  Input::get('year');
        
        $courseYear->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CourseYear  $courseYear
     * @return \Illuminate\Http\Response
     */
    public function destroy(CourseYear $courseYear)
    {
        $courseYear = CourseYear::findOrFail($id);
	    $courseYear->delete();

		return response()->json([
			"message" => "Success"
		]);
    }

    /**
     * Dispaly the students by selection of course year.
     */
    public function getStudents()
    {
        $year = Input::get();

        //TODO FIX MEEEEE
        if (!ctype_digit( $year['year']) && strlen($year['year']) !== 4) 
            return "Please Enter a valid year.";

        $courseYearId = CourseYear::where('year', $year)->first()->id;
        $studentGroupDetails = StudentGroupDetail::where('course_year_id', $courseYearId)->orderBy('student_id')->get()->toArray();
        $studentIds = array_column($studentGroupDetails, 'student_id');

        foreach ($studentIds as $studentId) {
           $student [] = Student::find($studentId);
        }
        return $student;
    }

    /**
     * Give you the specific reponse from resource.
     *
     * @param  \App\CourseYear  $courseYear
     * @return \Illuminate\Http\Response
     */
    protected function ResultFormatter($courseYear) {
		return [
			'Id' => $courseYear->id,
			'Year' => $courseYear->year
		];
	}
}
