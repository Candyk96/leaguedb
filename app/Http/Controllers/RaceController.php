<?php

namespace App\Http\Controllers;

use App\Models\Race;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Monolog\Logger;

class RaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        Validator::make($request->toArray(), [
            'league' => ['required'],
            'tier' => ['required'],
            'round' => ['required'],
            'track' => ['required'],
            'qualifying_position' => ['required'],
            'race_position' => ['required'],
            'penalties' => ['required'],
            'game' => ['required'],
            'date' => ['required']
        ])->validate();
        try {
            $race = new Race();
            $race->league = $request['league'];
            $race->tier = $request['tier'];
            $race->round = $request['round'];
            $race->track = $request['track'];
            $race->qualifying_position = $request['qualifying_position'];
            $race->race_position = $request['race_position'];
            $race->penalties = $request['penalties'];
            $race->game = $request['game'];
            $race->date = $request['date'];
            $race->details = $request['details'];
            $race->save();
            $status['status'] = "Race added successfully!";
            return Redirect::route('races')->with($status);
        } catch(Exception $e) {
            $status['status'] = "Failed to add a race!";
            Logger()->error('Failed to add a race!');
            return Redirect::route('races')->withErrors($status);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
