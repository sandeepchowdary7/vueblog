<?php

namespace App\Http\Controllers;
use App\CourseSection;
use Illuminate\Http\Request;
use Validator;

class CourseSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courseSections = CourseSection::all();
        $result = [];

        foreach ($courseSections as $courseSection) {
            $result = $this->ResultFormmater($courseSection);
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
            'section_name'   =>  'required'
        ]);
        // CourseYear::create($request->all());
        // return redirect()->route('courseSection.index')
        //                 ->with('success','courseSection created successfully.');

        $courseSection = new CourseSection;
        $courseSection->section_name =  Input::get('section_name');
        
        $courseSection->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CourseSection  $courseSection
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $courseSection = CourseSection::findOrFail($id);

       return $this->ResultFormatter($courseSection);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CourseSection  $courseSection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $courseSection =  CourseSection::findOrFail($id);

       $courseSection = new CourseSection;
       $courseSection->section_name = $request('section_name');

       $courseSection->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CourseSection  $courseSection
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $courseSection = CourseSection::findOrFail($id);
       $courseSection->delete();

       return response()->json([
        "message" => "Success"
    ]);
    }

     /**
     * Give you the specific reponse from resource.
     *
     * @param  \App\CourseSection  $courseSection
     * @return \Illuminate\Http\Response
     */
    protected function ResultFormatter($courseSection) {
		return [
			'Id' => $courseSection->id,
			'Year' => $courseSection->section_name
		];
	}
}
