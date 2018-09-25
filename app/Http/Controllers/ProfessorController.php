<?php

namespace App\Http\Controllers;
use App\Professor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Professor  $professor
     * @return \Illuminate\Http\Response
     */
    public function show($Id)
    {
	   $professor = Professor::findOrFail($Id);
	   
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
		$professor = Album::findOrFail($id);
		
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

    protected function ResultFormatter($professor) {
		return [
			'Id' => $professor->id,
			'First Name' => $professor->first_name,
			'Middle Name' => $professor->middle_name,
			'Last Name' => $professor->last_name,
			'Roll Num' => $professor->roll_number,
			'Gender' => $professor->gender,
			'Date of Birth' => $professor->dob,
			'Email' => $professor->email,
			'Phone Number' => $professor->phone_number,
			'Address' => $professor->address
		];
	}
}