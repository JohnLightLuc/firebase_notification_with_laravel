<?php

namespace App\Http\Controllers;

use App\Models\CustomerDevice;
use Illuminate\Http\Request;

class CustomerDeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $devices = CustomerDevice::all();
        return response()->json($devices);
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
        $customerDevice = CustomerDevice::create($request->all());
        return response()->json($customerDevice);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomerDevice  $customerDevice
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerDevice $customerDevice)
    {
        $customer = CustomerDevice::where("id", $customerDevice)->first();
        return response()->json($customer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CustomerDevice  $customerDevice
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomerDevice $customerDevice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CustomerDevice  $customerDevice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomerDevice $customerDevice)
    {
        $customerDevice = CustomerDevice::where("id", $customerDevice)->first();
        if(!empty($customerDevice)){
            $customerDevice->update($request->all());
        }
        return response()->json($customerDevice);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomerDevice  $customerDevice
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerDevice $customerDevice)
    {
        $customerDevice = CustomerDevice::where("id", $customerDevice)->first();
        if(!empty($customerDevice)){
            $customerDevice->delete();
        }
        return response()->json(["message" => "Customer Device deleted with succès"]);
    }
}
