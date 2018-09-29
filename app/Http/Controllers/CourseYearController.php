<?php

namespace App\Http\Controllers;
use App\CourseYear;
use Illuminate\Http\Request;

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
        // CourseYear::create($request->all());
        // return redirect()->route('courseYears.index')
        //                 ->with('success','courseYear created successfully.');

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
