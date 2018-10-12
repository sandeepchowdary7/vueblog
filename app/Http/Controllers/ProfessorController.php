<?php

namespace App\Http\Controllers;
use App\Professor;
use App\ProfessorDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;

class ProfessorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $professors = Professor::all();
        $result = [ ];
        
        foreach ($professors as  $professor) {
            $result [ ] = $this->ResultFormatter($professor);
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
        //write here
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
		$valid = $this->validate($request, [
					'first_name'            =>  'required|max:20',
					'middle_name'       =>  'required|max:20',
					'last_name'             =>   'required|max:20',
					'gender'              	  =>   'required',
					'dob'                       =>   'required|date',
					'email'                    =>   'required',
					'phone_number'     =>   'required',
					'address'                 =>   'required|max:300'
		]);
        
		$professor = new Professor;
		$professor->first_name =  Input::get('first_name');
		$professor->middle_name =  Input::get('middle_name');
        $professor->last_name =  Input::get('last_name');
		$professor->gender =  Input::get('gender');
		$professor->dob =  Input::get('dob');
		$professor->email =  Input::get('email');
		$professor->phone_number = Input::get('phone_number');
		$professor->address =  Input::get('address');
        $professor->save();

        return $professor;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Professor  $professor
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
	   $professor = Professor::findOrFail($id);
	   
	   return $this->ResultFormatter($professor);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Professor  $professor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		$professor = Professor::findOrFail($id);
		
		$professor = new Professor;
        $professor->first_name = $request['first_name'];
        $professor->middle_name = $request['middle_name'];
        $professor->last_name = $request['last_name'];
        $professor->gender = $request['gender'];
        $professor->dob = $request('dob');
        $professor->email = $request('email');
        $professor->phone_number = $request('phone_number');
		$professor->address = $request('address');
		$professor->update();
		
		return $this->ResultFormatter($professor);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Professor  $professor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Id $id)
    {
	   $professor = Prefessor::findOrFail($id);
	   $professor->delete();

		return response()->json([
			"message" => "Success"
		]);
    }

    /**
     * Give you the specific reponse from resource.
     *
     * @param  \App\Professor  $professor
     * @return \Illuminate\Http\Response
     */
    protected function ResultFormatter($professor) {
		return [
			'Id'                      => $professor->id,
			'FirstName'       => $professor->first_name,
			'MiddleName'   => $professor->middle_name,
            'LastName'        => $professor->last_name,
			'RollNumber'     => $professor->roll_number,
			'Gender'             => $professor->gender,
			'DateofBirth'      => $professor->dob,
			'Email'                => $professor->email,
			'PhoneNumber'  => $professor->phone_number,
            'Address'            => $professor->address,
            // [ 
            //     'professorDetail' => [
            //         'Id' => $professor->professor_detail->id,
            //         'Role' => $professor->professor_detail->Role,
            //         'Salary' => $professor->professor_detail->salary,
            //         'IsActive' => $professor->professor_detail->is_active,
            //         'JoinedOn' => $professor->professor_detail->joined_on,
            //         'ResignedAt' => $professor->professor_detail->resigned_at
            //     ]
            // ]
		];
	}
}