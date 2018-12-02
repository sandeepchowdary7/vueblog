<?php

namespace App\Http\Controllers;
use Validator;
use App\CourseSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

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
            $result []= $this->ResultFormatter($courseSection);
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
       $this->validate ($request,  [
            'section_name'               =>  'required',
        ]);

        $courseSection->update($request->all());
        return ['message' => 'Section Data Updated'];
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
			'SectionName' => $courseSection->section_name
		];
	}
}
