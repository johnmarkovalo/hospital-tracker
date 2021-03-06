<?php

namespace App\Http\Controllers;

use App\Http\Requests\OccupantRequest\DestroyOccupantRequest;
use App\Http\Requests\OccupantRequest\IndexOccupantRequest;
use App\Http\Requests\OccupantRequest\ShowOccupantRequest;
use App\Http\Requests\OccupantRequest\StoreOccupantRequest;
use App\Http\Requests\OccupantRequest\UpdateOccupantRequest;
use App\Http\Resources\OccupantResource;
use App\Occupant;
use App\RoomRequest;
use App\User;
use Illuminate\Http\Request;

class OccupantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexOccupantRequest $request)
    {
        //
        $occupant = Occupant::with('room')->get();
        return OccupantResource::collection($occupant);
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
    public function store(StoreOccupantRequest $request)
    {

        $user = User::create(array_merge($request->validated(), ['role' => 'OCCUPANT']));
        $occupant = Occupant::create(
            array_merge($request->validated(), ['user_id' => $user->id])
        );
        return new OccupantResource($occupant);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ShowOccupantRequest $request, int $occupant)
    {
        //
        $occupant = Occupant::findOrFail($occupant);
        return new OccupantResource($occupant);
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
    public function update(UpdateOccupantRequest $request, int $occupant)
    {
        //
        $occupant = Occupant::findOrFail($occupant);
        $occupant->update($request->validated());

        return new OccupantResource($occupant);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DestroyOccupantRequest $request, int $occupant)
    {
        //
        $occupant = Occupant::findOrFail($occupant);
        $occupant->delete();

        return null;
    }
}
