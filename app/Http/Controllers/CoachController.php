<?php

namespace App\Http\Controllers;

use App\Models\Coach;
use App\Models\CoachLanguage;
use App\Models\CoachLanguagePivot;
use App\Models\CoachQualification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CoachController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $coaches = new Coach;

        if ($request->locale_id) {
            $coaches = $coaches->where('locale_id', $request->locale_id);
        } else {
            $coaches = $coaches->where('locale_id', 1);
        }


        return view('coaches.index', [
            'coaches' => $coaches->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('coaches.create', [
            'coach' => null
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        DB::transaction(function () use ($request) {

            $request->merge([
                'password' => Hash::make($request->password),
                'user_type' => 'coach',
                'locale_id' => ($request->locale_id) ? $request->locale_id : 1
            ]);

            if ($request->locale_parent_id) {
                $user = User::whereHas('coach', function ($q) use ($request) {
                    return $q->where('id', $request->locale_parent_id);
                })->first();
            } else {
                $user = User::create($request->only(['email', 'password']));
            }

            $request->merge(['user_id' => $user->id]);

            $coach = Coach::create($request->only([
                'user_id', 'designation', 'specialization',
                'website_url', 'mobile_no', 'content', 'status',
                'country_id', 'state_id', 'city_id', 'gender',
                'first_name', 'last_name',
                'locale_id', 'locale_parent_id'
            ]));

            if ($request->qualifiactions && count($request->qualifiactions) > 0) {
                foreach ($request->qualifiactions as $qualification) {
                    CoachQualification::create([
                        'qualification' => $qualification['qualification'],
                        'coach_id' => $coach->id
                    ]);
                }
            }

            if ($request->coach_langauges  &&  count($request->coach_langauges) > 0) {
                foreach ($request->coach_langauges as $coach_langauge) {
                    CoachLanguagePivot::create([
                        'coach_languages_id' => $coach_langauge,
                        'coach_id' => $coach->id
                    ]);
                }
            }
        });


        return redirect()->route('coaches.index', ['locale_id' => $request->locale_id])->with('class', 'success')->with('message', 'Coach add successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coach  $coach
     * @return \Illuminate\Http\Response
     */
    public function show(Coach $coach)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coach  $coach
     * @return \Illuminate\Http\Response
     */
    public function edit(Coach $coach)
    {
        $coach =  Coach::whereId($coach->id)->with('user', 'coach_languages', 'coach_qualification', 'country', 'state', 'city')->first();

        return view('coaches.edit', ['coach' => $coach]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coach  $coach
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coach $coach)
    {

        DB::transaction(function ()  use ($request, $coach) {

            $coach_id =  $coach->id;
            if ($request->password) {
                $request->merge(['password' => Hash::make($request->password), 'user_type' => 'coach']);
            }

            $coach->user()->update($request->only(['email', 'password']));

            $coach->update($request->only([
                'user_id', 'designation', 'specialization',
                'website_url', 'mobile_no', 'content', 'status',
                'country_id', 'state_id', 'city_id', 'gender',
                'first_name', 'last_name', 'locale_id', 'locale_parent_id'
            ]));

            if ($request->qualifiactions && count($request->qualifiactions) > 0) {

                CoachQualification::where('coach_id', $coach_id)->delete();

                foreach ($request->qualifiactions as $qualification) {
                    CoachQualification::create([
                        'qualification' => $qualification['qualification'],
                        'coach_id' => $coach_id
                    ]);
                }
            }

            if ($request->coach_langauges  &&  count($request->coach_langauges) > 0) {

                CoachLanguagePivot::where('coach_id', $coach_id)->delete();

                foreach ($request->coach_langauges as $coach_langauge) {
                    CoachLanguagePivot::create([
                        'coach_languages_id' => $coach_langauge,
                        'coach_id' => $coach_id
                    ]);
                }
            }
        });

        return redirect()->route('coaches.index', ['locale_id' => $request->locale_id])->with('class', 'success')->with('message', 'Coach update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coach  $coach
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coach $coach)
    {
        //
    }
}
