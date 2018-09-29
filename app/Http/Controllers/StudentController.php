<?php

namespace App\Http\Controllers;
use App\Student;
use Illuminate\Http\Request;
use Validator;

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
        // $validator = Validator::make($request->all(), [
            // 			'first_name'               =>  'required|max:20',
            // 			'middle_name'          =>  'required|max:20',
            // 			'last_name'               =>   'required|max:20',
            // 			'guardian_name'      =>   'required|max:20',
            // 			'roll_number'           =>   'required|unique',
            // 			'gender'              	    =>   'required',
            // 			'dob'                         =>   'required|date',
            // 			'is_active'                 =>   'required|unique',
            // 			'contact_number'     =>   'required|digits:15',
            // 			'address'                   =>   'required|max:300',
            //          'graduated_year'      =>   'year'
            // ]);
    
            // if ($validator->fails()) {
            //     return redirect('/student')
            //                 ->withErrors($validator)
            //                 ->withInput();
            // }
            
            $student = new Student;
            $student->first_name =  Input::get('first_name');
            $student->middle_name =  Input::get('middle_name');
            $student->last_name =  Input::get('last_name');
            $student->guardian_name =  Input::get('guardian_name');
            $student->gender =  Input::get('gender');
            $student->dob =  Input::get('dob');
            $student->is_active =  Input::get('is_active');
            $student->contact_number = Input::get('contact_number');
            $student->address =  Input::get('address');
            $student->graduated_year =  Input::get('graduated_year');
            
            $student->save();
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

        $student = new Student;
        $student->first_name =  Input::get('first_name');
        $student->middle_name =  Input::get('middle_name');
        $student->last_name =  Input::get('last_name');
        $student->guardian_name =  Input::get('guardian_name');
        $student->gender =  Input::get('gender');
        $student->dob =  Input::get('dob');
        $student->is_active =  Input::get('is_active');
        $student->contact_number = Input::get('contact_number');
        $student->address =  Input::get('address');
        $student->graduated_year =  Input::get('graduated_year');
        
        $student->save();
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
    protected function ResultFormatter($student) {
		return [
			'Id' => $student->id,
			'First Name' => $student->first_name,
			'Middle Name' => $student->middle_name,
            'Last Name' => $student->last_name,
            'Gaurdian Name' => $student->guardian_name,
			'Roll Number' => $student->roll_number,
			'Gender' => $student->gender,
			'Date of Birth' => $student->dob,
			'is_active' => $student->is_active,
			'Contact Number' => $student->contact_number,
			'Address' => $student->address,
			'Graduated Year' => $student->graduated_year
		];
	}
}