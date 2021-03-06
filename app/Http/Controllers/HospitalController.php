<?php

namespace App\Http\Controllers;

use App\Hospital;
use App\HospitalRoom;
use App\Http\Requests\HospitalRequest\DestroyHospitalRequest;
use App\Http\Requests\HospitalRequest\IndexHospitalRequest;
use App\Http\Requests\HospitalRequest\ShowHospitalRequest;
use App\Http\Requests\HospitalRequest\StoreHospitalRequest;
use App\Http\Requests\HospitalRequest\UpdateHospitalRequest;
use App\Http\Resources\HospitalResource;
use App\User;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexHospitalRequest $request)
    {
        //
        $hospital = Hospital::with('user')->get();

        return HospitalResource::collection($hospital);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHospitalRequest $request)
    {
        $user = User::create(array_merge($request->validated(), ['role' => 'HOSPITAL']));
        $hospital = Hospital::create( array_merge($request->validated(),
            ['user_id' => $user->id]
        ));
        return new HospitalResource($hospital);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(ShowHospitalRequest $request, int $hospital)
    {
        $hospital = Hospital::findOrFail($hospital);

        return new HospitalResource($hospital);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


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
    public function update(UpdateHospitalRequest $request, int $hospital)
    {
        $hospital = Hospital::findOrFail($hospital);
        $hospital->update($request->validated());

        return new HospitalResource($hospital);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DestroyHospitalRequest $request, int $hospital)
    {
        $hospital = Hospital::findOrFail($hospital);
        $hospital->delete();

        return null;
    }
}
