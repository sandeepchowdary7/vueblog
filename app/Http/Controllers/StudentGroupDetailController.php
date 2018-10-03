<?php

namespace App\Http\Controllers;
use App\StudentGroupDetail;
use Illuminate\Http\Request;
use App\Student;

class StudentGroupDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $studentGroupDetails = StudentGroupDetail::all();
        $result = [];

        foreach ($studentGroupDetails as $studentGroupDetail) {
            $result [] = $this->ResultFormatter($studentGroupDetail);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StudentGroupDetail  $studentGroupDetail
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $studentGroupDetail = StudentGroupDetail::findOrFail($id);
       
        return $this->ResultFormatter($studentGroupDetail);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StudentGroupDetail  $studentGroupDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentGroupDetail $studentGroupDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StudentGroupDetail  $studentGroupDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $studentGroupDetail = StudentGroupDetail::findOrFail($id);
        $studentGroupDetail->delete();
 
         return response()->json([
             "message" => "Success"
         ]);
    }

     /**
     * Give you the specific reponse from resource.
     *
     * @param  \App\ProfessorDetail  $professorDetail
     * @return \Illuminate\Http\Response
     */
    protected function ResultFormatter($studentGroupDetail) {
		return [
			'Id' => $studentGroupDetail->id,
            [ 
                'Id'                     => $studentGroupDetail->student->id,
                'first_name'        => $studentGroupDetail->student->first_name,
                'middle_name'   => $studentGroupDetail->student->middle_name,
                'last_name'         => $studentGroupDetail->student->last_name,
                'guardian_name' => $studentGroupDetail->student->guardian_name,
                'roll_number'      => $studentGroupDetail->student->roll_number,
                'gender'               => $studentGroupDetail->student->gender,
                'is_active'            => $studentGroupDetail->student->is_active,
                'contact_number' => $studentGroupDetail->student->contact_number,
                'address'               => $studentGroupDetail->student->address,
                'graduated_year'  => $studentGroupDetail->student->graduated_year,
            ],
            [
                'Id'                        => $studentGroupDetail->course_year->id,
                'Course Year'        => $studentGroupDetail->course_year->year,
            ],
            [
                'Id'                        => $studentGroupDetail->course_group->id,
                'Course Group'     => $studentGroupDetail->course_group->group_name,
            ],
            [
                'Id'                                       => $studentGroupDetail->course_section->id,
                'Course Section Name'       => $studentGroupDetail->course_section->section_name,
            ],
            [
                'Id'                        => $studentGroupDetail->subject->id,
                'Subject Name'        => $studentGroupDetail->subject->subject_name,
            ],
            [
                'Id'                        => $studentGroupDetail->course_year->id,
                'Course Year'        => $studentGroupDetail->course_year->year,
            ],
            [
                'Id' => $studentGroupDetail->professor->id,
                'First Name' => $studentGroupDetail->professor->first_name,
                'Middle Name' => $studentGroupDetail->professor->middle_name,
                'Last Name' => $studentGroupDetail->professor->last_name,
                'Roll Num' => $studentGroupDetail->professor->roll_number,
                'Gender' => $studentGroupDetail->professor->gender,
                'Date of Birth' => $studentGroupDetail->professor->dob,
                'Email' => $studentGroupDetail->professor->email,
                'Phone Number' => $studentGroupDetail->professor->phone_number,
                'Address' => $studentGroupDetail->professor->address,
                [ 
                    'Id' => $studentGroupDetail->professor->professor_detail->id,
                    'Role' => $studentGroupDetail->professor->professor_detail->Role,
                    'Salary' => $studentGroupDetail->professor->professor_detail->salary,
                    'Is_active' => $studentGroupDetail->professor->professor_detail->is_active,
                    'Joined On' => $studentGroupDetail->professor->professor_detail->joined_on,
                    'Resigned At' => $studentGroupDetail->professor->professor_detail->resigned_at
                ],
            ]
		];
	}
}