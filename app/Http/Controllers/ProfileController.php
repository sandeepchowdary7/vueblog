<?php

namespace App\Http\Controllers;
use App\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profiles = Profile::all();
        $result = [ ];

        foreach ($profiles as  $profile) {
            $result [ ] = $this->ResultFormatter($profile);
        }
        return $result;
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
            'name'               =>  'required',
            'email'               =>   'required|unique',
            'bio'                   =>   'required',
            'photo'                =>   'optional'
        ]);

            $profile = new Profile;
            $profile->name =  Input::get('name');
            $profile->email =  Input::get('email');
            $profile->bio =  Input::get('bio');
            $profile->type =  Input::get('type');
            $profile->photo =  Input::get('photo');
            $profile->save();

            return $profile;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }

    public function profile()
    {
        return auth('api')->user();
    }

     /**
     * Give you the specific reponse from resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    protected function ResultFormatter($profile) {
		return [
			'Id' => $profile->id,
			'Name' => $profile->name,
			'Email' => $profile->email,
            'Bio' => $profile->bio,
            'Type' => $profile->type,
			'Photo' => $profile->photo
		];
	}
}
