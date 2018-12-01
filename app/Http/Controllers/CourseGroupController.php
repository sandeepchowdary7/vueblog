<?php

namespace App\Http\Controllers;
use Validator;
use App\Student;
use App\CourseYear;
use App\CourseGroup;
use App\StudentGroupDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class CourseGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courseGroups = CourseGroup::all();
        $result = [];

        foreach ($courseGroups as $courseGroup) {
            $result [] = $this->ResultFormatter($courseGroup);
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
        //
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
            	'group_name'   =>  'required',
        ]);
        // CourseGroup::create($request->all());
        // return redirect()->route('courseGroups.index')
        //                 ->with('success','courseGroup created successfully.');

        $courseGroup = new CourseGroup;
        $courseGroup->group_name =  Input::get('group_name');
        
        $courseGroup->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CourseGroup  $courseGroup
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $courseGroup = CourseGroup::findOrFail($id);

        return $this->ResultFormatter($courseGroup);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CourseGroup  $courseGroup
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $courseGroup = CourseGroup::findOrFail($id);

        $courseGroup = new CourseGroup;
        $courseGroup->group_name =  Input::get('group_name');
        $courseGroup->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CourseGroup  $courseGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $courseGroup = CourseGroup::findOrFail($id);
        $courseGroup->delete();

        return response()->json([
			"message" => "Success"
		]);
    }
    
    /**
     * Dispaly the students by selection of course group.
     */
    public function getStudents()
    {
        $group = Input::get();

        $courseGroupId = CourseGroup::where('group_name', $group)->first()->id;
        $studentGroupDetails = StudentGroupDetail::where('course_group_id', $courseGroupId)->orderBy('student_id')->get()->toArray();
        $studentIds = array_column($studentGroupDetails, 'student_id');
        $courseYearIds = array_column($studentGroupDetails, 'course_year_id');

        foreach (array_combine($studentIds, $courseYearIds) as $studentId => $courseYearId) {
           $student = Student::find($studentId);
           $courseYear = CourseYear::find($courseYearId);
           $result [] = $this->GetStudentResultFormatter($student, $courseYear);
        }
        return $result;
    }

     /**
     * Give you the specific reponse from resource.
     *
     * @param  \App\CourseGroup  $courseGroup
     * @return \Illuminate\Http\Response
     */
    protected function ResultFormatter($courseGroup) {
		return [
			'Id' => $courseGroup->id,
			'Group' => $courseGroup->group_name
		];
    }
    
     /**
     * Give you the specific reponse from resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    protected function GetStudentResultFormatter($student, $courseYear) {
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
            'GraduatedYear' => $student->graduated_year,
            'CourseYear'     => $courseYear->year
		];
	}
}
