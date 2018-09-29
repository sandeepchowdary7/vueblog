<?php

namespace App\Http\Controllers;
use App\Subject;
use Illuminate\Http\Request;
use Validator;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::all();
        $result = [];

        foreach ($subjects as $subject) {
            $result [] = $this->ResultFormatter($subject);
        }
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
            'subject_name'   =>  'required'
        ]);
        // Subject::create($request->all());
        // return redirect()->route('subject.index')
        //                 ->with('success','subject created successfully.');

        $subject = new Subject;
        $subject->subject_name =  Input::get('subject_name');
        
        $subject->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $subject = Subject::findOrFail($id);

       return $this->ResultFormatter($subject);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $subject = Subject::findOrFail($id);

       $subject = new Subject;
       $subject->subject_name = $request('subject_name');

       $subject->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subject = Subject::findOrFail($id);
        $subject->delete();

        return response()->json([
            "message" => "Success"
        ]);
    }

     /**
     * Give you the specific reponse from resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    protected function ResultFormatter($subject) {
		return [
			'Id' => $subject->id,
			'Subject Name' => $subject->subject_name
		];
	}
}
