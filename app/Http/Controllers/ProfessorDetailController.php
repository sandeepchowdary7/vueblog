<?php

namespace App\Http\Controllers;
use App\ProfessorDetail;
use App\Professor;
use Illuminate\Http\Request;
use Validator;

class ProfessorDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $professorDetails = ProfessorDetail::all();
        $result = [ ];

        foreach ($professorDetails as  $professorDetail) {
            $result [ ] = $this->ResultFormatter($professorDetail);
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
            'role' => 'required',
            'salary' => 'required',
            'is_active' => 'required',
            'joined_on' => 'timestamp',
            'resigned_at' => 'timestamp'
    ]);

    if ($validator->fails()) {
        return redirect('/professorDetail')
                    ->withErrors($validator)
                    ->withInput();
    }

    $professorDetail = new professorDetail;
    $professorDetail->role = $request['role'];
    $professorDetail->salary = $request['salary'];
    $professorDetail->is_active = $request['is_active'];
    $professorDetail->joined_on = $request['joined_on'];
    $professorDetail->resigned_at = $request('resigned_at');

    $professor->save();
        }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProfessorDetail  $professorDetail
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $professorDetail = ProfessorDetail::findOrFail($id);

       return $this->ResultFormatter($professorDetail);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProfessorDetail  $professorDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $professorDetail = ProfessorDetail::findOrFail($id);
		
        $professorDetail = new professorDetail;
        $professorDetail->role = $request['role'];
        $professorDetail->salary = $request['salary'];
        $professorDetail->is_active = $request['is_active'];
        $professorDetail->joined_on = $request['joined_on'];
        $professorDetail->resigned_at = $request('resigned_at');

		$professorDetail->update();
		
		return $this->ResultFormatter($professorDetail);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProfessorDetail  $professorDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $professorDetail = ProfessorDetail::findOrFail($id);
        $professorDetail->delete();

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
    protected function ResultFormatter($professorDetail) {
		return [
			'Id' => $professorDetail->professor->id,
			'First Name' => $professorDetail->professor->first_name,
			'Middle Name' => $professorDetail->professor->middle_name,
			'Last Name' => $professorDetail->professor->last_name,
			'Roll Num' => $professorDetail->professor->roll_number,
			'Gender' => $professorDetail->professor->gender,
			'Date of Birth' => $professorDetail->professor->dob,
			'Email' => $professorDetail->professor->email,
			'Phone Number' => $professorDetail->professor->phone_number,
            'Address' => $professorDetail->professor->address,
            [ 
                'Id' => $professorDetail->id,
                'role' => $professorDetail->role,
                'salary' => $professorDetail->salary,
                'is_active' => $professorDetail->is_active,
                'joined_on' => $professorDetail->joined_on,
                'resigned_at' => $professorDetail->resigned_at
            ]
		];
	}
}
