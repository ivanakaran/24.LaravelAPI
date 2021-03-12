<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehicleFormRequest;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicles = Vehicle::all();

        return response()->json(['vehicles' => $vehicles], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VehicleFormRequest $request)
    {

        $vehicle = new Vehicle;
        $vehicle->brand = $request->get('brand');
        $vehicle->model = $request->get('model');
        $vehicle->plate_number = $request->get('plate_number');
        $vehicle->insurance_date = $request->get('insurance_date');

        if ($vehicle->save()) {
            return response()->json(['success' => 'Vehicle saved!'], 200);
        }

        return response()->json(['error' => 'An error occurred!'], 500);
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
    public function update(VehicleFormRequest $request)
    {
        $id = $request->get('id');
        $vehicle = Vehicle::findOrFail($id);

        if (!$vehicle) {
            return response()->json(['error' => 'Vehicle does not exist!'], 404);
        }

        $vehicle->brand = $request->get('brand');
        $vehicle->model = $request->get('model');
        $vehicle->plate_number = $request->get('plate_number');
        $vehicle->insurance_date = $request->get('insurance_date');

        if ($vehicle->save()) {
            return response()->json(['success' => 'Vehicle updated!'], 200);
        }

        return response()->json(['error' => 'An error occurred!'], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->get('id');
        $vehicle = Vehicle::where('id', $id)->first();

        if (!$vehicle) {
            return response()->json(['error' => 'Vehicle does not exist!']);
        }

        $vehicle->delete();

        return response()->json(['success' => 'Vehicle deleted']);
    }
}