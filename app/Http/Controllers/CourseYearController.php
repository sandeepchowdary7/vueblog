<?php

namespace App\Http\Controllers;
use Validator;
use App\Student;
use ArrayObject;
use App\CourseYear;
use App\CourseGroup;
use App\StudentGroupDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

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
        $year = Input::all();

        //TODO FIX MEEEEE
        // if (!ctype_digit( $year['year']) && strlen($year['year']) !== 4) 
        //     return "Please Enter a valid year.";

        $courseYearId = CourseYear::where('year', $year)->first()->id;
        $studentGroupDetails = StudentGroupDetail::where('course_year_id', $courseYearId)->orderBy('student_id')->get()->toArray();
        $studentIds = array_column($studentGroupDetails, 'student_id');
        $courseGroupIds = array_column($studentGroupDetails, 'course_group_id');

        foreach (array_combine($studentIds, $courseGroupIds) as $studentId => $courseGroupId) {
           $student = Student::find($studentId);
           $courseGroup = CourseGroup::find($courseGroupId);
           $result [] = $this->GetStudentResultFormatter($student, $courseGroup);
        }
        return $result;
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
    
     /**
     * Give you the specific reponse from resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    protected function GetStudentResultFormatter($student, $courseGroup) {
		return [
			'Id' => $student->id,
			'FirstName' => $student->first_name,
			'MiddleName' => $student->middle_name,
            'LastName' => $student->last_name,
            'GaurdianName' => $student->guardian_name,
			'RollNumber' => $student->roll_number,
			'Gender' => $student->gender,
			'DateofBirth' => $student->dob,
			'is_active' => $student->is_active,
			'ContactNumber' => $student->contact_number,
			'Address' => $student->address,
            'GraduatedYear' => $student->graduated_year,
            'GroupName'     => $courseGroup->group_name
		];
	}
}
