<?php

namespace App\Http\Controllers;
use Validator;
use App\Student;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all();
        $result = [ ];

        foreach ($students as  $student) {
            $result [ ] = $this->ResultFormatter($student);
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
        $this->validate ($request,  [
            'first_name'               =>  'required',
            'last_name'               =>   'required',
            'guardian_name'      =>   'required',
            // 'roll_number'           =>   'required|unique',
            'gender'              	    =>   'required',
            'dob'                         =>   'required|date',
            'contact_number'     =>   'required|max:12',
            'address'                   =>   'required|max:300',
            'graduated_year'      =>   'required'
        ]);

            $student = new Student;
            $student->first_name =  Input::get('first_name');
            $student->middle_name =  Input::get('middle_name');
            $student->last_name =  Input::get('last_name');
            $student->guardian_name =  Input::get('guardian_name');
            $student->gender =  Input::get('gender');
            $student->dob =  Input::get('dob');
            $student->contact_number = Input::get('contact_number');
            $student->address =  Input::get('address');
            $student->graduated_year =  Input::get('graduated_year');
            $student->save();

            return $student;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::findOrFail($id);
	   
	    return $this->ResultFormatter($student);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        
        $this->validate ($request,  [
            'first_name'               =>  'required',
            'last_name'               =>   'required',
            'guardian_name'      =>   'required',
            'gender'              	    =>   'required',
            'dob'                         =>   'required|date',
            'contact_number'     =>   'required',
            'address'                   =>   'required|max:300',
            'graduated_year'      =>   'required'
        ]);

        $student->update($request->all());
        return ['message' => 'Student Data Updated'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        
        return ['message' => 'Student Deleted'];
    }


    public function getDownload()
    {
        FIXME:
        //PDF file is stored under project/public/download/info.pdf
    //    $download_path = ( storage_path() . '/download/students_'.date('m-d-Y_hia').'.pdf' );
        return response()->download(public_path() . '/1.pdf' );
    }

     /**
     * Give you the specific reponse from resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    protected function ResultFormatter($student) {
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
			'GraduatedYear' => $student->graduated_year
		];
	}
}