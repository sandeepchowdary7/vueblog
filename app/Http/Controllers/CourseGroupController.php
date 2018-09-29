<?php

namespace App\Http\Controllers;
use App\CourseGroup;
use Illuminate\Http\Request;

class CourseGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courseGroup = CourseGroup::all();
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
     * Give you the specific reponse from resource.
     *
     * @param  \App\CourseGroup  $courseGroup
     * @return \Illuminate\Http\Response
     */
    protected function ResultFormatter($courseGroup) {
		return [
			'Id' => $courseGroup->id,
			'Year' => $courseGroup->group_name
		];
	}
}
